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



session_start();
if (!$_SESSION['isAdmin']) {
  header('Location: login.php');
  exit();
}


$filename = 'resultScan';
$date = date("d-m-y H:i:s.", filemtime($filename));
$csv = new CsvImporter('resultScan',",");
$csv2 =  new CsvImporter('resultScan',",");
$nbr_hote =  sizeof($csv2->get());
$hotes = $csv->get();

$template = $twig->load('index.twig');
echo $template->render([
  'backGround' => $config['backGroundScanUse'],
  'date' => $date,
  'hotes' =>  $hotes,
  'nbr_hote' => $nbr_hote,

]);
