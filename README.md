# Open Centreon Discovery


### Correction de bug 16/11/2021 ###
Correction pour PHP8 ( merci à ARRAWN777 pour ses retours ! )

### Correction de bug 06/05 ###
Correction du scan BackGround

### Nouveautés du 01/05 ###
Détection des services tounants sous Windows/Linux.

Transformation des champs deroulants en champs de recherche 

Correction d'un bug sur la partie Apply&Reload

### Correction de bugs 02/03 ###
Correction d'un bug qui affectait le bouton magie et les majuscules dans le nom des templates. Merci à M Coquard pour les tests !

### Nouveautés du 24/02 ###
Ajout d'un bouton Magie ! Ce bouton permet de detecter l'os et d'y appliquer automatiquement un template .

il est possible de completer un mappage dans le fichier js/autoTemplate.js :

exemple: pour les OS non reconnu, on applique le template generic-host :
 map.set ("Unknown", "generic-host")

### Nouveautés du 22/02 ###

Possibilité de faire du scan de votre réseau en arriere plan
___
Projet de découverte automatique pour centreon testé sur CES 19.10.

Documentation se trouve ici
[https://www.sugarbug.fr/atelier/techniques/ihmweb/open-centreon-discovery/](https://www.sugarbug.fr/atelier/techniques/ihmweb/open-centreon-discovery/)

et là 

[https://github.com/romnvll/Open-Centreon-Discovery/wiki](https://github.com/romnvll/Open-Centreon-Discovery/wiki)

