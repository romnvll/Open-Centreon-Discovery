<?php

class Host  {

    protected $hostName;
    protected $ip;
    protected $community;
    protected $os;
    protected $snmpVersion;
    protected $services = array();
    

    function __construct($hostName,$ip,$community,$os,$snmpVersion,$services=null) 
    {
        $this->hostName = $hostName;
        $this->ip = $ip;
        $this->community = $community;
        $this->os = $os;
        $this->snmpVersion = $snmpVersion;
        $this->services = $services;
        
        
    }

    function getHostName():string {
        return $this->hostName;
    }

    function getIp():string {
        return $this->ip;
    }

    function getOs():string {
        return $this->os;
    }

    function getCommunity():string {
        return $this->community;
    }

    function getSnmpVersion():string {
        return $this->snmpVersion;
    }

    function getServices():?array {
        return $this->services;
    }

    

    

}

?>