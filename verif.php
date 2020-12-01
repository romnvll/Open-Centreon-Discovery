<?php
include 'config.php';
session_start();


if (($_POST['login'] === $config['centreon']['user']) && ($_POST['password'] === $config['centreon']['password'])) {
$_SESSION['isAdmin'] = true;

  header('Location: index.php');


}




?>