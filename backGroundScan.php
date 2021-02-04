
<?php
ob_implicit_flush(true);

require ('Scan.class.php');
require ('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$tabLan = $config['backGroundScan'];



//Création d'un fichier pour stocker le resultat du scan

$resultFile = fopen("resultScan", "w+") or die("Unable to open file!");

foreach ($tabLan as $value ) {
    
  
$network=$value["network"];
$community=$value["community"];  
$version=$value["version"];


 $scan = new scan($network,$version,4000,$community);
    $result = $scan->scan("cli");
      
 foreach ($result as $ip) {
   
         
        fwrite($resultFile, $ip);
        fwrite($resultFile,",");
        fwrite($resultFile,"$community");
        fwrite($resultFile,",");
        fwrite($resultFile,"$version");
        fwrite($resultFile,"\n");
        
              

 }   




}
fclose($resultFile);
echo "scan terminé" . exit(0);




?>