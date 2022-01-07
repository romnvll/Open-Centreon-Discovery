<?php
$centreon = new Centreon(null,null,null,null,null,null,null,null,$value['Poller']);

$map = array(
    'Unknown' => 'generic-host',
    'Ricoh' => 'htpl-os-printer-snmp',
    'HP LaserJet' => 'htpl-os-printer-snmp'

);




if ($centreonHost == $host->getIP()) {
    $trouve = true;
}



if ($trouve == false) {
     echo $host->getIp() ."\n";
    foreach ($centreon->getTemplateName() as $template) {

        //si le nom du template correspond au nom du serveur
        if (str_contains(strtolower($template), strtolower($host->getOS()))) {
            
            $host = new Centreon($host->gethostname(),$template,null,null,$host->getIp(),$host->getCommunity(),$host->getOs(),$host->getSnmpVersion(),$value['Poller']);
                
            $host->addHost($host);
            $host->setParam($host);
           
            $trouve = true;
            break;

        } else {
            if (isset($map[$host->getOs()])) {

                $template = $map[$host->getOS()];
                $host = new Centreon($host->gethostname(),$template,null,null,$host->getIp(),$host->getCommunity(),$host->getOs(),$host->getSnmpVersion(),$value['Poller']);
                
                $host->addHost($host);
                $host->setParam($host);
                
                $trouve = true;
                break;
            }
        }
    }
}


