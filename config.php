<?php
//Vos identifiants centreon
$config['centreon']['user'] = 'admin';
$config['centreon']['password'] = 'admin';

//chemin de clapi
$config['centreon']['clapi'] = '/usr/share/centreon/bin/centreon';


//pour le scan BackGround



//activation du scan backGround pour les /16 et plus : true or false
$config['backGroundScanUse'] = false ;
//chemin de l'executable scanBackGround

$config['backGroundRoot'] = '/usr/share/discovery';



$config['backGroundScan'][0] = array("network" => "192.168.4.0/24",
                                    "community"=>"public",
                                    "version"=>"2" );

$config['backGroundScan'][1] = array("network" => "192.168.14.0/24",
                                     "community"=>"public",
                                    "version"=>"2" );



?>
