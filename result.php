<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<table class="table">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nom</th>
			<th scope="col">IP</th>
			<th scope="col">Template Host</th>
			<th scope="col">Template APPS 1</th>
			<th scope="col">Template APPS 2</th>
		</tr>
	</thead>
	<tbody>


		<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		snmp_set_quick_print(1);
		require_once 'Scan.class.php';


		error_reporting(E_ALL);
		include 'Centreon.class.php';

		$communitySnmp = $_GET['community'];
		$snmpversion = $_GET['version'];
		$centreon = new Centreon();
		$count = 0;


		foreach ($_GET['host'] as $key => $ip) {

			$count++;
			if ($snmpversion == 2 ) {
			$snmp = new SNMP(SNMP::VERSION_2c, $ip, $communitySnmp, 4000);
			}
			if ($snmpversion == 1 ) {
			$snmp = new SNMP(SNMP::VERSION_1, $ip, $communitySnmp, 6000);
			}

			@$nom  = $snmp->get("1.3.6.1.2.1.1.5.0");
			
			
			$template = $_GET['template'][$count - 1];
			$ip = $_GET['host'][$count - 1];
			
			$templateapps1 = $_GET['templateapps1'][$count - 1];
			$templateapps2 = $_GET['templateapps2'][$count - 1];


			echo "<tr>";
			echo "<th scope=\"row\">$count</th>";
			echo "<td>$nom</td>";
			echo  "<td>$ip</td>";
			echo  "<td>$template</td>";
			echo  "<td>$templateapps1</td>";
			echo  "<td>$templateapps2</td>";
			echo  "</tr>";
			$info[$count]['nom'] = $nom;
			$info[$count]['ip'] = $ip;
			$info[$count]['template'] = $template;
			$info[$count]['templateapps1'] = $templateapps1;
			$info[$count]['templateapps2'] = $templateapps2;
			$info[$count]['communitySnmp'] = $communitySnmp;
			$info[$count]['snmpversion'] = $snmpversion;
		}

		$_SESSION['info'] = $info;
		?>

	</tbody>
</table>
<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-sm">
				<?php

				echo "<a class=\"btn btn-primary\" href=\"add.php?method=apply\" role=\"button\">Appliquer</a>";
				?>
			</div>

			<div class="col-sm">
				<?php
				echo "<a class=\"btn btn-primary\" href=\"add.php?method=applyandreload\" role=\"button\">Appliquer et redemarrer le moteur</a>";
				?>
			</div>
		</div>

	</div>
</div>