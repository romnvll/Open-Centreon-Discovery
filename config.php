<?php

//Vos identifiants centreon
$config['centreon']['user'] = 'admin';
$config['centreon']['password'] = 'admin';

//chemin de clapi
$config['centreon']['clapi'] = '/usr/share/centreon/bin/centreon';

//Le nom de votre poller
//centreon -u admin -p password -a POLLERLIST
$config['pollers']['poller1']='Central';

//pour le scan BackGround
//activation du scan backGround pour les /16 : true or false
$config['backGroundScan']['use'] = false;

$config['backGroundScan'][0] = array("network" => "192.168.4.0/24","community"=>"public","version"=>"2c" );
$config['backGroundScan'][1] = array("network" => "10.3.0.0/16","community"=>"public","version"=>"2c" );


		
?>
