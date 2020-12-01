<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'scan.php';

$scan = new scan("192.168.4.0/24");
$tab = $scan->scan();
var_dump($tab);
foreach ($tab as $tab) {
	var_dump($tab);
}


?>
