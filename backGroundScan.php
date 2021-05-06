<?php
require(__DIR__ . '/config.php');
require(__DIR__ . '/classes/Scan.class.php');
require(__DIR__ . '/classes/Centreon.class.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$centreonHost = new Centreon();
$getIpCentreonHost = $centreonHost->getIpHost();
//Création d'un fichier pour stocker le resultat du scan

$file=__DIR__."/resultScan";

$resultFile = fopen($file, "w+") or die("Unable to open file!");
fwrite($resultFile,"nom_serveur,ip,community,os,snmpVersion,services" );
fwrite($resultFile,"\n");

foreach ($config['backGroundScan'] as $value) {


       $scan = new scan($value['network'], $value['community'], $value['version'], 7000);

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
                      
                                     
                      fwrite($resultFile,$host->getHostName() ) ;
                      fwrite($resultFile,",");
                      fwrite($resultFile,$host->getIP() ) ; 
                      fwrite($resultFile,",");
                      fwrite($resultFile,$host->getCommunity() ) ;  
                      fwrite($resultFile,",");                                        
                      fwrite($resultFile,$host->getOs() ) ; 
                      fwrite($resultFile,",");
                      fwrite($resultFile,$host->getSnmpVersion() ) ; 
                      fwrite($resultFile,","); 
                      fwrite($resultFile,"\""); 
                      fwrite($resultFile,implode(",", $host->getServices())) ; 
                      fwrite($resultFile,"\""); 
                      fwrite($resultFile,"\n");   
                     
                  }              

           
       }

       
       
       
}

fclose($resultFile);
echo "scan terminé" . exit(0);





?>