<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
snmp_set_quick_print(1);
error_reporting(E_ALL);
*/
session_start();
if (!$_SESSION['isAdmin']) {

	header('Location: login.php');
	exit();
}
require('classes/Scan.class.php');
require('classes/Centreon.class.php');
include('vendor/autoload.php');
require('classes/Csv.class.php');


$centreon = new Centreon();
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true,

]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
//detection des hotes non présentes dans centreon
$centreonHost = new Centreon();
$getIpCentreonHost = $centreonHost->getIpHost();
$arrayNewHost = array();
// Scan BackGround
if (isset($_GET['backGroundScan'])) {
    $csv = new CsvImporter('resultScan', ",");
    $scan = $csv->get();
   

    foreach ($scan as $hote) {

        $trouve = false;
        foreach ($getIpCentreonHost as $centreonHost) {
                
            if ($centreonHost == $hote["ip"]) {
                $trouve = true;
                break;
            }
        }

        if ($trouve == false) {
            $arrayNewHost[] = new host($hote['nom_serveur'], $hote['ip'], $hote['community'], $hote['os'], $hote['snmpVersion']);
        }
        
    }
}
//fin ScanBackGround

// scan depuis un lancement manuel
else {

$scan = new Scan($_GET['hostNetwork'], $_GET['community'], $_GET['version'], $_GET['timeout']);
$scan = $scan->Scan();
// merci seb !
foreach ($scan as $hote) {

    $trouve = false;
    foreach ($getIpCentreonHost as $centreonHost) {

        if ($centreonHost == $hote->getIP()) {
            $trouve = true;
            break;
        }
    }

    if ($trouve == false) {
        $arrayNewHost[] = new host($hote->getHostName(), $hote->getIP(), $hote->getCommunity(), $hote->getOs(), $hote->getSnmpVersion());
    }
}

}



// Fin de detection des hotes


$template = $twig->load('step1.twig');
echo $template->render([

    'hotes' =>  $arrayNewHost,
    'pollers' => $centreon->getPollerName(),
    'template' => $centreon->getTemplateName(),
   // 'community' => $_GET['community'],
    //'versionSnmp' => $_GET['version'],

]);
