
<?php

require('classes/Scan.class.php');
require('classes/Centreon.class.php');

require('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$centreonHost = new Centreon();
$getIpCentreonHost = $centreonHost->getIpHost();
//Création d'un fichier pour stocker le resultat du scan

$resultFile = fopen("resultScan", "w+") or die("Unable to open file!");
fwrite($resultFile,"nom_serveur,ip,community,os,snmpVersion" );
fwrite($resultFile,"\n");

foreach ($config['backGroundScan'] as $value) {


       $scan = new scan($value['network'], $value['community'], $value['version'], 4000);

       $result = $scan->Scan();

       foreach ($result as $host) {

              $trouve=false;
              foreach ($getIpCentreonHost as $centreonHost) {
              
                      if ($centreonHost == $host->getIP()) {
                          $trouve=true;
                          break;          
               
                      }         
              
                  } 
                  
                  if ($trouve == false) {
                      
                     //$arrayNewHost[] = new host($host->getHostName(), $host->getIP(), $host->getCommunity(), $host->getOs(), $host->getSnmpVersion());
                     $hostname=preg_replace("/STRING: /i",'',$host->getHostName()) ;
                            
                      fwrite($resultFile,$hostname ) ;
                      fwrite($resultFile,",");
                      fwrite($resultFile,$host->getIP() ) ; 
                      fwrite($resultFile,",");
                      fwrite($resultFile,$host->getCommunity() ) ;  
                      fwrite($resultFile,",");                                        
                      fwrite($resultFile,$host->getOs() ) ; 
                      fwrite($resultFile,",");
                      fwrite($resultFile,$host->getSnmpVersion() ) ;  
                      fwrite($resultFile,"\n");   
                     
                  }              

           
       }

       
       
       
}

fclose($resultFile);
echo "scan terminé" . exit(0);





?>