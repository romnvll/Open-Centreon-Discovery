<?php
session_start();
include 'Centreon.class.php';
$centreon = new centreon();
$size=sizeof($_SESSION['info']);

$size = $size + 1;

//session_destroy();
if ($_GET['method'] == "apply") {
	
	for ($i=1; $i<$size; $i++) {
		echo $_SESSION['info'][$i]['nom'] . " ajouté <br>" ;

		$centreon->addhost($_SESSION['info'][$i]['ip'],$_SESSION['info'][$i]['nom'],"Central",$_SESSION['info'][$i]['template']."|".$_SESSION['info'][$i]['templateapps1']."|".$_SESSION['info'][$i]['templateapps2']);
		$centreon->setParam($_SESSION['info'][$i]['nom'],$_SESSION['info'][$i]['communitySnmp'],$_SESSION['info'][$i]['snmpversion']);
		header( "refresh:3;url=index.php" );
	}
	
	
}


if ($_GET['method'] == "applyandreload") {

 for ($i=1; $i<$size; $i++) {
                echo $_SESSION['info'][$i]['nom']. " ajouté <br>";

                $centreon->addhost($_SESSION['info'][$i]['ip'],$_SESSION['info'][$i]['nom'],"Central",$_SESSION['info'][$i]['template']."|".$_SESSION['info'][$i]['templateapps1']."|".$_SESSION['info'][$i]['templateapps2']);
                $centreon->setParam($_SESSION['info'][$i]['nom'],$_SESSION['info'][$i]['communitySnmp'],$_SESSION['info'][$i]['snmpversion']);
        }
	$centreon->applyCfg();
	header( "refresh:3;url=index.php" );

	
}

?>
