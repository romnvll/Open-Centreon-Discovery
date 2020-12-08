# Open Centreon Discovery
Projet de découverte automatique pour centreon testé sur CES 19.10.

ATTENTION, c'est un programme en version très beta!!!

Pour le moment, ce programme fonctionne uniquement pour une solution centreon CES avec le poller sur le même serveur .

## Installation :

### prerequis

git

### mode opératoire

création dossier discovery

	mkdir /usr/share/discovery

récupération du dépôt

	git clone https://github.com/romnvll/Open-Centreon-Discovery.git

**Modification apache pour CentOS**

créer le fichier /opt/rh/httpd24/root/etc/httpd/conf.d/discovery.conf :

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

adapter le port 904x en fonction de votre configuration, doit être identique à fpm

relancer apache

systemctl restart httpd24-httpd

**Modification apache pour Debian**

créer le fichier /etc/apache2/conf-available/discovery.conf :

	###########################################
	Alias /discovery /usr/share/discovery/
	<LocationMatch ^/discovery/(.*\.php(/.*)?)$>
   		ProxyPassMatch fcgi://127.0.0.1:9042/usr/share/discovery/$1
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

adapter le port 904x en fonction de votre configuration, doit être identique à fpm

activer la configuration et relancer apache

	a2enconf discovery
	systemctl reload apache2

Copier les fichiers 

	cd Open-Centreon-Discovery
	cp -r * /usr/share/discovery

Le fichier config.php devra contenir login/mdp de votre plateforme CES + le nom de votre poller 


