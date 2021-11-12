<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
snmp_set_quick_print(1);
error_reporting(E_ALL);


include ('vendor/autoload.php');
include ('classes/Csv.class.php');
include ('config.php');



$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
  'cache' => false,
  'debug' => true,

]);
$twig->addExtension(new \Twig\Extension\DebugExtension());



if (!$_COOKIE['isAdmin']) {
  header('Location: login.php');
  exit();
}

if ( !file_exists("resultScan")) {
 $file = false;
 $date = false;
 $hotes = false;
}

else {
$file = true;
$filename = 'resultScan';
$date = date("d-m-y H:i:s.", filemtime($filename));
$csv = new CsvImporter('resultScan',",");

$hotes = $csv->get();
}
$template = $twig->load('index.twig');
echo $template->render([
  'backGround' => $config['backGroundScanUse'],
  'date' => $date,
  'hotes' =>  $hotes,
  'file' => $file
  

]);
