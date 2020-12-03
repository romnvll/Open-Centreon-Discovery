<?php

//Vos identifiants centreon
$config['centreon']['user'] = 'admin';
$config['centreon']['password'] = 'admin';

//chemin de clapi
$config['centreon']['clapi'] = '/usr/share/centreon/bin/centreon';

//Le nom de votre poller
//centreon -u admin -p password -a POLLERLIST
$config['pollers']['poller1']='Central';



		
?>
