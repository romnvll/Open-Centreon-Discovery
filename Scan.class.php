<?php
class scan {

	private $ip;
	private $startip;
	private $network;
	private $endip;
	private $startipLong;
	private $endipLong;

public function __construct($ip) {
	$this->ip = $ip;
	
	require('IPv4.class.php');
	
	@$net = Net_IPv4::parseAddress($this->ip);
	$this->startipLong = ip2long($net->network)+1;
	$this->endipLong = ip2long($net->broadcast)-1;
	$this->startip = long2ip($this->startipLong);
	$this->endip = long2ip($this->endipLong);

	}

/**
 * Methode permettant de scanner le réseau en SNMP avec une communauté donnée
 * 
 */
public function scan($community) {
	require('config.php');
	$tabip=array();
	
	while ($this->startipLong <= $this->endipLong) {
	$ip=long2ip($this->startipLong++);
	
		

	$snmp = new SNMP(SNMP::VERSION_2c,$ip,$community,2000);
	if (@$snmp->get("sysDescr.0")) {
	array_push($tabip,$ip);
	
	}	
	
	
	}
	return $tabip;

}
/**
 * Méthode permettant de detecter un OS et retourner le nom 
 */
public function getOs($ip,$community) {
	$snmp = new SNMP(SNMP::VERSION_2c,$ip, $community,1000);
	@$sysdesc = $snmp->get("1.3.6.1.2.1.1.1.0");
	//echo $sysdesc;
	if (stripos($sysdesc,"windows")) {
	$os = "<i class=\"fa fa-windows\" style=\"font-size:36px\"></i>";

	}

	elseif (stripos($sysdesc,"linux")) {
	$os = "<i class=\"fa fa-linux\" style=\"font-size:36px\"></i>";
	}

	elseif (stripos($sysdesc,"ricoh")) {
	$os = "Ricoh";
	}

	elseif (stripos($sysdesc,"cisco ios")) {
	$os = "Cisco";
	}

	elseif (stripos($sysdesc,"Dell EMC Networking")) {
	$os = "Dell Networking";
	}

	elseif (stripos($sysdesc,"VMware")) {
	$os = "VMWare";
	}


	else {
	$os = "Unknown";
	}


	return @$os;



	

}

public function getName($ip,$community) {
	 $snmp = new SNMP(SNMP::VERSION_2c,$ip, $community,1000);
        @$sysname = $snmp->get("1.3.6.1.2.1.1.5.0");
	
	return @$sysname;

}



}


?>
