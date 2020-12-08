<?php
class scan {

	private $ip;
	private $startip;
	private $network;
	private $endip;
	private $startipLong;
	private $endipLong;
	private $version_snmp;
	private $timeout_snmp;

public function __construct($ip,$version_snmp,$timeout_snmp) {
	$this->ip = $ip;
	$this->version_snmp = $version_snmp;
	$this->timeout_snmp = $timeout_snmp;
	
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
	
		
	if ($this->version_snmp == 2) {
		$snmp = new SNMP(SNMP::VERSION_2C,$ip,$community,$this->timeout_snmp);
	}
	if ($this->version_snmp  == 1) {
		$snmp = new SNMP(SNMP::VERSION_1,$ip,$community,$this->timeout_snmp);
		
	}
	
	
	
	
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
	if ($this->version_snmp == 2) {
		$snmp = new SNMP(SNMP::VERSION_2C,$ip,$community,$this->timeout_snmp);
	}
	if ($this->version_snmp  == 1) {
		$snmp = new SNMP(SNMP::VERSION_1,$ip,$community,$this->timeout_snmp);
		
	}
	
	@$sysdesc = $snmp->get("1.3.6.1.2.1.1.1.0");
	
	if (stripos($sysdesc,"windows")!==false) {
	$os = "<i class=\"fa fa-windows\" style=\"font-size:36px\"></i>";

	}

	elseif (stripos($sysdesc,"linux")!==false) {
	$os = "<i class=\"fa fa-linux\" style=\"font-size:36px\"></i>";
	}

	elseif (stripos($sysdesc,"ricoh")!==false) {
	$os = "Ricoh";
	}

	elseif (stripos($sysdesc,"cisco ios")!==false) {
	$os = "Cisco";
	}

	elseif (stripos($sysdesc,"Dell EMC Networking")!==false) {
	$os = "Dell Networking";
	}

	elseif (stripos($sysdesc,"VMware")!==false) {
	$os = "VMWare";
	}


	else {
	$os = "Unknown";
	}


	return @$os;



	

}

public function getName($ip,$community) {
	if ($this->version_snmp == 2) {
		$snmp = new SNMP(SNMP::VERSION_2C,$ip,$community,$this->timeout_snmp);
	}
	if ($this->version_snmp  == 1) {
		$snmp = new SNMP(SNMP::VERSION_1,$ip,$community,$this->timeout_snmp);
		
	}
	 
        @$sysname = $snmp->get("1.3.6.1.2.1.1.5.0");
	
	return @$sysname;

}



}


?>
