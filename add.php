<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!$_SESSION['isAdmin']) {

	header('Location: login.php');
	exit();
}
require ('classes/Hosts.class.php');
require ('classes/Centreon.class.php');

$centreon = new Centreon();

if ($_GET['method'] == "apply") {
	
		$data = json_decode($_POST['data'],false);

		foreach($data as $host){
		$centreon = new Centreon($host->nom_serveur,$host->hostTemplate,$host->appsTemplate1,$host->appsTemplate2,$host->ip,$host->community,null,$host->snmpVersion,$host->poller);
		$centreon->addhost($centreon);
		header( "refresh:3;url=index.php" );

		
	}
}
	
	
if ($_GET['method'] == "applyandreload") {
	$data = json_decode($_POST['data'],false);
	foreach($data as $host){

		$centreon = new Centreon($host->nom_serveur,$host->hostTemplate,$host->appsTemplate1,$host->appsTemplate2,$host->ip,$host->community,null,$host->snmpVersion,$host->poller);
		$centreon->addhost($centreon);
		
		
	}
	$centreon->applyCfg($centreon);
	header( "refresh:3;url=index.php" );
	
 
	

	
}
