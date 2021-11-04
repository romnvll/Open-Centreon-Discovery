<?php

require 'classes/HostLan.class.php';
class Centreon extends Host {

private $user ;
private $password;
private $poller;
private $template;
private $templateApps1;
private $templateApps2;
private $clapi;




	function __construct($hostName=null,$template=null,$templateApps1=null,$templateApps2=null,$ip=null,$community=null,$os=null,$snmpVersion=null,$poller=null) {
	
		parent::__construct($hostName,$ip,$community,$os,$snmpVersion);
	include (__DIR__.'/../config.php');
	$this->user = $config['centreon']['user'];
	$this->password = $config['centreon']['password'];
    $this->clapi = $config['centreon']['clapi'];
	$this->poller = $poller;
	$this->template = $template;
	$this->templateApps1 = $templateApps1;
	$this->templateApps2 = $templateApps2;
	
	
	}

	/**
	 * Methode permettant de recuperer les ip présentes dans centreon
	 */
	function getIpHost() {
	$out = shell_exec($this->clapi. ' -u ' . $this->user . ' -p ' . $this->password . '  -o HOST -a show | cut -f4 -d";" |  grep -v "address" ');
	$iptab = preg_split('/\s+/', trim($out));
	return $iptab;

	}

	function getPollerName():array {
	$out = shell_exec($this->clapi. ' -u ' . $this->user . ' -p ' . $this->password . '   -a Pollerlist| cut -f 2 -d ";" | grep -v Return |grep -v name');
	$PollerName = preg_split('/\s+/', trim($out));
	return $PollerName;
	

	}

	function getTemplateName():array {
	 $out = shell_exec ($this->clapi. ' -u ' . $this->user . ' -p ' . $this->password . ' -e | egrep -e "^(HTPL)" | cut -f3 -d";" | uniq -d ');
	$templateName = preg_split('/\s+/', trim($out));
	return $templateName;

	
	}


	function addHost($centreonObject):void {
// ADD HHOST
 shell_exec ($this->clapi ." -u " .  $this->user  ." -p ".  $this->password  ." -o HOST -a ADD -v \"". $this->hostName .";".$this->hostName .";" . $this->ip .";" .$this->template."|".$this->templateApps1."|".$this->templateApps2 .";" .$this->poller .";;\"");

//SET TPL	
	shell_exec ("$this->clapi -u $this->user  -p  $this->password  -o HOST -a applytpl -v \"$this->hostName\" ");

	}

	function setParam($centreonObject):void {
	shell_exec("$this->clapi -u  $this->user   -p   $this->password   -o HOST -a SETPARAM -v \"$this->hostName;host_snmp_community;$this->community\"");
	shell_exec("$this->clapi -u  $this->user   -p   $this->password   -o HOST -a SETPARAM -v \"$this->hostName;host_snmp_version;$this->snmpVersion\"");
	}

	function applyCfg($centreonObject):void {
	$result = shell_exec("$this->clapi -u  $this->user   -p   $this->password  -a APPLYCFG -v \"$this->poller\"");
	echo $result;
	
	}
	//verifie que le mot de passe centreon est correct 
	function verifClapiPassword($user,$password):bool {
		$verif = exec("$this->clapi -u  $user   -p  $password --help");
		
		if ($verif === "Invalid credentials.") {
			return false;
		}
		else {
			return true;
		}
		
	}
	
	
}


?>
