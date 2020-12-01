<?php
session_start();
if (!$_SESSION['isAdmin']) {

  header('Location: login.php');
  exit();

}
?>

<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<!-- Custom styles for this template -->
<link href="css/customsignin.css" rel="stylesheet">
<script src="http:////cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<form action="step2.php" method="get">
<body class="text-center">
    <form class="form-signin" action="verif.php" method="POST">
    <svg width="72" height="72" viewBox="0 0 16 16" class="bi bi-hdd-network" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M14 3H2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
    <path d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
  <path fill-rule="evenodd" d="M7.5 10V7h1v3a1.5 1.5 0 0 1 1.5 1.5h5.5a.5.5 0 0 1 0 1H10A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5H.5a.5.5 0 0 1 0-1H6A1.5 1.5 0 0 1 7.5 10zm0 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
  </svg>
     
      <h1 class="h3 mb-3 font-weight-normal">Scanner votre reseau en SNMP</h1>
      
      <label for="inputEmail" class="sr-only">Centreon Login</label>
      <input type="text" class="form-control"  name="hostNetwork" placeholder="network ex: 192.168.4.0/24" >
      <label for="inputPassword" class="sr-only">Password</label>
	  <input type="text" class="form-control" <?php if (isset($_GET['community'])) echo "value=" . $_GET['community']; else  echo " " ?> name="community" id="community" placeholder="La communaut&#233;">
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Scan</button>
	  <p class="mt-5 mb-3 text-muted">Centreon Host Discovery</p>
	
    </form>
  </body>













