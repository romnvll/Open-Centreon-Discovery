<?php


class host
{
    private $ip;
    private $community;
    private $hostName;
    private $os;

    function __construct(String $hostName, String $ip, String $community, String $os){
        $this->hostName = $hostName;
        $this->ip = $ip;
        $this->community = $community;
        $this->os = $os;
        
        
    }


    function getIp() {
        return $this->ip;

    }

    function getHostName() {
        return $this->hostName;
    }

    function getCommunity() {
        return $this->community;
    }

    function getOs() {
        return $this->os;
    }


    function setip(String $ip) {
        $this->ip=$ip;
    }

    function setHostName(String $hostName) {
        $this->hostName = $hostName;
    }

    function setCommunity(String $community) {
        $this->community = $community;

    }

    function setOs($os) {
        $this->os = $os;
    }

    



}
