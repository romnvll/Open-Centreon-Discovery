<?php
setcookie("isAdmin","", time() - 3600);
echo $_COOKIE['isAdmin'];
header('Location: login.php');
?>
