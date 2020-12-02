# Open Centreon Discovery
Projet de découverte automatique pour centreon testé sur CES 19.10.

ATTENTION, c'est un programme en version très beta!!!

Pour le moment, ce programme fonctionne uniquement pour une solution centreon CES avec le poller sur le même serveur .

##Installation :
cd /usr/share

git clone https://github.com/romnvll/Centreon_Discovery.git

le fichier /opt/rh/httpd24/root/etc/httpd/conf.d/discovery.conf :
###########################################
Alias /discovery /usr/share/discovery/
<LocationMatch ^/discovery/(.*\.php(/.*)?)$>
   ProxyPassMatch fcgi://127.0.0.1:9043/usr/share/discovery/$1
</LocationMatch>
ProxyTimeout 300
<Directory "/usr/share/discovery">
    DirectoryIndex index.php
    Options Indexes
    AllowOverride all
    Order allow,deny
    Allow from all
    Require all granted
    <IfModule mod_php5.c>
        php_admin_value engine Off
    </IfModule>
    AddType text/plain hbs

</Directory>


RedirectMatch ^/$ /discovery
###########################################

Le fichier config.php devra contenir login/mdp de votre plateforme CES + le nom de votre poller 


