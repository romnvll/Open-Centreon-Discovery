<?php
require ('host.class.php')	;
class scan {


	private $ip;
	private $startip;
	private $network;
	private $endip;
	private $startipLong;
	private $endipLong;
	private $version_snmp;
	private $timeout_snmp;
	private $community;
	private $hosts = array();
	

public function __construct($ip,$version_snmp,$timeout_snmp,$community) {
	$this->ip = $ip;
	$this->version_snmp = $version_snmp;
	$this->timeout_snmp = $timeout_snmp;
	$this->community = $community;
	require('IPv4.class.php');
	
	@$net = Net_IPv4::parseAddress($this->ip);
	$this->startipLong = ip2long($net->network)+1;
	$this->endipLong = ip2long($net->broadcast)-1;
	$this->startip = long2ip($this->startipLong);
	$this->endip = long2ip($this->endipLong);

	}

function getHosts() {
	return $this->hosts;
}

/**
 * Methode permettant de scanner le réseau en SNMP avec une communauté donnée
 * @return Array tableau d'adresses ip
 * 
 */
public function scan() {
	
	

	require('config.php');	
	$tabip=array();
	
	
	while ($this->startipLong <= $this->endipLong) {
		
	$ip=long2ip($this->startipLong++);
	
	
	
	         
		
	if ($this->version_snmp == 2) {
		
		$snmp = new SNMP(SNMP::VERSION_2C,$ip,$this->community,$this->timeout_snmp,1);
		
	}
	if ($this->version_snmp  == 1) {
		$snmp = new SNMP(SNMP::VERSION_1,$ip,$this->community,$this->timeout_snmp,1);
		
	}
	

	//si la machine repond en SNMP, on creer un tableau d'ip pour la comparaison et un tableau d'hote
	if (@$snmp->get("sysDescr.0")) {
		
		$host = new host($this->getName($ip), "$ip", $this->community,$this->getOs($ip));
		
		
		array_push($this->hosts,$host);
		
		
		array_push($tabip,$host->getIp());
		
	
	}
	
	
 
	
	}
	
	return $tabip;

}
/**
 * Méthode permettant de detecter un OS et retourner le nom 
 * @ return String
 */
public function getOs($ip) {
	if ($this->version_snmp == 2) {
		$snmp = new SNMP(SNMP::VERSION_2C,$ip,$this->community,$this->timeout_snmp);
	}
	if ($this->version_snmp  == 1) {
		$snmp = new SNMP(SNMP::VERSION_1,$ip,$this->community,$this->timeout_snmp);
		
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

public function getName($ip) {
	if ($this->version_snmp == 2) {
		$snmp = new SNMP(SNMP::VERSION_2C,$ip,$this->community,$this->timeout_snmp);
	}
	if ($this->version_snmp  == 1) {
		$snmp = new SNMP(SNMP::VERSION_1,$ip,$this->community,$this->timeout_snmp);
		
	}
	 
        @$sysname = $snmp->get("1.3.6.1.2.1.1.5.0");
	
	return @$sysname;

}



}


?>
