<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
snmp_set_quick_print(1);
error_reporting(E_ALL);

require ('Scan.class.php');
require ('Centreon.class.php');
//require ('Hosts.class.php');
$network = "192.168.4.0/24";
$scan=new Scan($network,"public","2",4000) ;
$centreonHost=new Centreon();
$getIpCentreonHost = $centreonHost->getIpHost();

$arrayNewHost = array();
foreach($scan->Scan() as $hote) {

    foreach($getIpCentreonHost as $ipCentreon) {
        
        if ($ipCentreon == $hote->getIP()){
           // echo $hote ->getIp();
            $arrayNewHost[]=new host($hote->getHostName(),$hote->getIP(),$hote->getCommunity(),$hote->getOs(),$hote->getSnmpVersion());
        }
        
    }   

}

var_dump($arrayNewHost);



?>