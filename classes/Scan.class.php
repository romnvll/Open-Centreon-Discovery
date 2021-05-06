<?php
require('HostLan.class.php');
require('IPv4.class.php');


class Scan
{
    private $network;
    private $community;
    private $snmpVersion;
    private $snmpTimeOut;
    private $snmpLogin;
    private $snmpPassword;
    private $scanBackGround;
    private $startipLong;
    private $endipLong;
    private $ipScanner = array();

    function __construct($network, $community, $snmpVersion, $snmpTimeOut, $snmpLogin = null, $snmpPassword = null)
    {
        $this->network = $network;
        $this->community = $community;
        $this->snmpVersion = $snmpVersion;
        $this->snmpTimeOut = $snmpTimeOut;
        $this->snmpLogin = $snmpLogin;
        $this->snmpPassword = $snmpPassword;
        @$net = Net_IPv4::parseAddress($this->network);
        $this->startipLong = ip2long($net->network) + 1;
        $this->endipLong = ip2long($net->broadcast) - 1;
        $this->startip = long2ip($this->startipLong);
        $this->endip = long2ip($this->endipLong);
    }

    public function Scan(): array
    {

        $arrayhostLan = array();

        while ($this->startipLong <= $this->endipLong) {
            usleep(10 * 1000);

            $ip = long2ip($this->startipLong++);


            if ($this->snmpVersion == "2") {
                $snmp = new SNMP(SNMP::VERSION_2C, $ip, $this->community, $this->snmpTimeOut, 5);
                $snmp->valueretrieval = SNMP_VALUE_PLAIN;
            }
            if ($this->snmpVersion == 1) {
                $snmp = new SNMP(SNMP::VERSION_1, $ip, $this->community, $this->snmpTimeOut, 1);
                $snmp->valueretrieval = SNMP_VALUE_PLAIN;
            }

            //si la machine repond en SNMP, on creer un tableau d'ip pour la comparaison et un tableau d'hote
            if (@$snmp->get("sysDescr.0")) {

                $os = $snmp->get("1.3.6.1.2.1.1.1.0");
                if (stripos($os, "windows") !== false) {

                    $os = "Windows";
                } elseif (stripos($os, "linux") !== false) {
                    $os = "Linux";
                } elseif (stripos($os, "ricoh") !== false) {
                    $os = "Ricoh";
                } elseif (stripos($os, "cisco ios") !== false) {
                    $os = "Cisco";
                } elseif (stripos($os, "Dell EMC Networking") !== false) {
                    $os = "Dell Networking";
                } elseif (stripos($os, "VMware") !== false) {
                    $os = "VMWare";
                } elseif (stripos($os, "3Com") !== false) {
                    $os = "Switch 3Com";
                } elseif (stripos($os, "DGS-1100") !== false) {
                    $os = "Switch Dlink";
                } elseif (stripos($os, "SF302") !== false) {
                    $os = "Cisco Small Business";
                } elseif (stripos($os, "Brother ") !== false) {
                    $os = "Brother Printer";
                } elseif (stripos($os, "LaserJet") !== false) {
                    $os = "HP LaserJet";
                } elseif (stripos($os, "HiveOS") !== false) {
                    $os = "Aerohive";
                } elseif (stripos($os, "Dell EMC Networking") !== false) {
                    $os = "Dell-Networking";
                } else {
                    $os = "Unknown";
                }


                if ($os == "Ricoh") {
                    $hostname = $snmp->get(".1.3.6.1.4.1.367.3.2.1.7.2.4.5.0");
                    $hostname = preg_replace("/STRING: /i", '', $hostname);
                } else {
                    $hostname = $snmp->get("1.3.6.1.2.1.1.5.0");
                    $hostname = preg_replace("/STRING: /i", '', $hostname);
                }

                //detection des services.
                require(__DIR__ . '/../config.php');
                if ($os == "Windows" || $os == "Linux") {

                    $servicesSNMP = $snmp->walk("1.3.6.1.2.1.25.4.2.1.2");
                    $serviceNameUnique = array_unique($servicesSNMP);
                    $services = array();

                    foreach ($config['service'] as $service => $value) {

                        foreach ($serviceNameUnique as $serviceSNMP) {

                            if ($serviceSNMP == $service) {
                                $services[] = $value;
                            }
                        }
                    }
                }
                @$hostLan = new HostLan($hostname, $ip, $this->community, $os, $this->snmpVersion, $services);
                

                array_push($arrayhostLan, $hostLan);
            }
        }

        return  $arrayhostLan;
    }

    public function getIpScanner(): array
    {
        return $this->ipScanner;
    }
}
