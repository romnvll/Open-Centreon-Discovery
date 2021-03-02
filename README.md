# Open Centreon Discovery
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

[https://github.com/romnvll/Open-Centreon-Discovery/wiki](https://github.com/romnvll/Open-Centreon-Discovery/wiki)
