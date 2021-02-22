<?php

		session_start();
		if (!$_SESSION['isAdmin']) {

			header('Location: login.php');
			exit();
		}
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		snmp_set_quick_print(1);
		
		error_reporting(E_ALL);
		


		require ('classes/Hosts.class.php');
		require ('classes/Centreon.class.php');
		require ('classes/Csv.class.php');

include ('vendor/autoload.php');



$data = $_POST['data'];
$data = json_decode($data,true);







$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true,
     
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$template = $twig->load('step2.twig');
echo $template->render( [
    
    'hotes' =>  $data,
    
    
]);

		
