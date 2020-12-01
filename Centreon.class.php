<?php


class Centreon {

private $user ;
private $password;
private $poller;

	function __construct() {
	include ('config.php');
	$this->user = $config['centreon']['user'];
	$this->password = $config['centreon']['password'];
	$this->poller = $config['pollers']['poller1'];

	}

	/**
	 * Methode permettant de recuperer les ip présentes dans centreon
	 */
	function getIpHost() {
	$out = shell_exec('/usr/bin/centreon -u ' . $this->user . ' -p ' . $this->password . '  -o HOST -a show | cut -f4 -d";" |  grep -v "address" ');
	$iptab = preg_split('/\s+/', trim($out));
	return $iptab;

	}

	function getPollerName() {
	$out = shell_exec('/usr/bin/centreon -u ' . $this->user . ' -p ' . $this->password . '   -a gettemplate ');
	return $out;
	}

	function getTemplateName() {
	 $out = shell_exec ('/usr/bin/centreon -u ' . $this->user . ' -p ' . $this->password . ' -e | egrep -e "^(HTPL)" | cut -f3 -d";" | uniq -d ');
	$templateName = preg_split('/\s+/', trim($out));
	return $templateName;
	
	}


	function addHost($ip,$nom,$poller,$template) {
	
	$addhost = shell_exec("/usr/bin/centreon -u  $this->user  -p  $this->password  -o HOST -a ADD -v \"$nom;$nom;$ip;$template;$poller;;\" ");
	$applyTpl = shell_exec("/usr/bin/centreon -u $this->user  -p  $this->password  -o HOST -a applytpl -v \"$nom\" ");
	
	}

	function setParam($nom,$community,$version) {
	shell_exec("/usr/bin/centreon -u  $this->user   -p   $this->password   -o HOST -a SETPARAM -v \"$nom;host_snmp_community;$community\"");
	shell_exec("/usr/bin/centreon -u  $this->user   -p   $this->password   -o HOST -a SETPARAM -v \"$nom;host_snmp_version;$version\"");
	}

	function applyCfg() {
	$result = shell_exec("/usr/bin/centreon -u  $this->user   -p   $this->password  -a APPLYCFG -v \"$this->poller\"");
	echo $result;
	}
	
	
}


?>
