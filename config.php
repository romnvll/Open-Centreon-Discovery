<?php
//Vos identifiants centreon
$config['centreon']['user'] = 'admin';
$config['centreon']['password'] = 'admin';

//chemin de clapi
$config['centreon']['clapi'] = '/usr/share/centreon/bin/centreon';


//pour le scan BackGround



//activation du scan backGround pour les /16 et plus : true or false
$config['backGroundScanUse'] = true ;
//chemin de l'executable scanBackGround
$config['backGroundRoot'] = '/usr/share/discovery';



$config['backGroundScan'][0] = array("network" => "192.168.x.0/24",
                                    "community"=>"public",
                                    "version"=>"2" );

$config['backGroundScan'][1] = array("network" => "192.168.x.0/24",
                                     "community"=>"public",
                                    "version"=>"2" );

$config['backGroundScan'][2] = array("network" => "192.168.x.0/24",
                                     "community"=>"Othercommunity",
                                   "version"=>"2" );

/*
Detection des services sur un hôte
*/
 $config['service']['httpd'] = "HttpApache";   
 $config['service']['apache2'] = "HttpApache";   
 $config['service']['sshd'] = "OpenSSH";                               
 $config['service']['dns.exe'] = "Dns";
 $config['service']['sqlservr.exe'] = "SqlServer"; 
 $config['service']['oracle.exe'] = "OracleServer";
 $config['service']['postgres.exe'] = "PostgresServer"; 
 $config['service']['WsusService.exe'] = "WindowsWsus"; 
 $config['service']['w3wp.exe'] = "HttpIIS";
 $config['service']['mysqld'] = "MysqlServer";
 $config['service']['tomcat'] = "HttpTomcat";
 
?>
