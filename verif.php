<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
snmp_set_quick_print(1);
error_reporting(E_ALL);


include 'config.php';
include 'classes/Centreon.class.php';

$centreon = new Centreon();
$ClapiPassword = $centreon->verifClapiPassword($config['centreon']['user'], $config['centreon']['password']);

if ($ClapiPassword == false) {
  echo "Mot de passe centreon incorrect dans le fichier de configuration";
  exit;
} else {
  session_start();

  if (($_POST['login'] === $config['centreon']['user']) && ($_POST['password'] === $config['centreon']['password'])) {
    setcookie("isAdmin", true,time() + (86400 * 15));
   

    header('Location: index.php');
  }
  
  else {
    echo "Mauvais Login/mot de passe";
    
    header('Location: index.php?login=false');
  }



}
