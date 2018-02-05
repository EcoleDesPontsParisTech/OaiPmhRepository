# OaiPmhRepository
OAI-PMH repository plugin for Omeka, fork for specific needs of ENPC.

# Contexte
Les modifications opérées sur le plug-in OAI-PMH Repository de Omeka ont été réalisées en 2015 par Limonade and Co dans le cadre du projet de signalement des données de la Bibliothèque numérique patrimoniale de l’École des Ponts ParisTech dans Gallica.

Les données sont exposées au format Dublin Core simple, format de description bibliographique garantissant l’interopérabilité entre les systèmes.

La structuration de l'entrepôt OAI-PMH et la normalisation des métadonnées respectent les préconisations de la Bibliothèque nationale de France et de Gallica, ainsi que celles d'Europeana.

Il est important de prendre connaissance de la documentation éditée par la BnF concernant le référencement des documents numériques dans Gallica : Guide d’interopérabilité OAI-PMH pour un référencement des documents numériques dans Gallica / Guillaume Godet, Bnf, v. 1.2., 2010 http://www.bnf.fr/documents/Guide_oaipmh.pdf

# Structuration de l’entrepôt
L'entrepôt est structuré en plusieurs jeux de données : les sets thématiques fournissent les métadonnées correspondant aux collections documentaires consultables depuis la rubrique "Collections" tandis que d'autres sets regroupent les notices par typologie documentaire (imprimés, manuscrits, cartes, dessins, périodiques, photographies, etc.).
Les sets regoupant les items par typologies documentaires s'appuient sur les valeurs renseignées dans l'élément dc:type Dublin Core.
Trois éléments dc:type doivent être créés :
- 1 élément dc:type xml:lang="fre" prenant la valeur Unimarc française ;
- 1 élément dc:type xml:lang="eng" prenant la valeur Unimarc anglaise ;
- 1 élément dc:type xml:lang="eng" prenant la valeur préconisée par Europeana.

# Normalisation des données
Le tableau ci-dessous liste les champs et les valeurs exposés tel que défini dans le cadre du projet conduit par l'École des Ponts ParisTech en 2015: L’utilisation des champs Dublin Core et la définition des valeurs respectent les préconisations de la BnF pour permettre le référencement des documents dans Gallica.

Chamsp Dublin core | Valeurs normalisées
dc:title | texte libre

| Chamsp Dublin core    |    Valeurs normalisées                                            |
| --------------------- | ----------------------------------------------------------------- |
| dc:title              | texte libre                                                       |
| dc:creator            | "Nom, Prénom (dateVie-dateMort)" respecte norme NF Z44-061        |
| dc:publisher          |"Éditeur (Ville)"                                                  |
| dc:date	              |"AAAA"                                                             | 
| dc:format             |"image/jpeg"                                                       | 
| dc:date	              |"AAAA"                                                             | 
| dc:type	              |<dc:type xml:lang="fre">valeur unimarc en français</dc:type>       | 
| dc:type               |<dc:type xml:lang="eng">valeur unimarc en anglais</dc:type>        |                                          
| dc:type               |<dc:type xml:lang="eng">valeur acceptée par Europeana</dc:type>    | 
| dc:identifier	        |id Omeka ou id perenne                                             | 
| dc:source             |"Institution de conservation, cote »                               | 
| dc:rights             |"public domain" ou "domaine public"                                | 
| dc:source             |"Institution de conservation, cote »                               | 
| dc:relation           |<dc :relation>vignette : http://adresse-image.jpg/png</dc:relation>| 
| dc:source             |"Institution de conservation, cote »                               | 
| dc:language           |<dc:language>fre</dc:language>                                     | 

Complément d'information concernant dc:relation :
*Insérer la vignette de la page de titre (formats autorisés : de 128px à 400px) : S'appuyer sur la valeur "P" contenue dans le champ Type de page de la Refnum pour connaître l'url du fichier image à déclarer.
*Si la valeur "P" n’est pas trouvée, le premier fichier image sera exposé

Tableau de correspondance des valeurs admises dans dc:type (Source BnF)
-
| <dc:type xml:lang="fre">   |    <dc:type xml:lang="eng">   |<dc:type xml:lang="eng"> Europeana|
| -------------------------- | ----------------------------- |----------------------------------|
| image fixe              | still image |image                                                  |
| texte imprimé            | text      |text
| monographie imprimée         |printed monograph | text                                               |
| manuscrit	              |manuscript |text                                                             | 
| publication en série imprimée	| printed serial	|text                            | 
| document sonore |	sound |	sound |
| images animées |	moving image |	video |
| objet	physical | object |	image   |                                 
|monnaie |	physical object |	image |
| musique imprimée |	printed music |	text                                          | 
| musique imprimée et manuscrite	| printed and manuscript music |	text                         | 
| musique manuscrite |	manuscript music |	text                       | 
| estampe |	engraving |	image         |                 | 
| dessin |	drawing	| image| 
|photographie	| photograph	| image                           | 
| document d'archives	| archival material	| text     | 
|document cartographique	| cartographic resource |	image    | 
| carte |	map |	image    | 
| atlas	|atlas |	image  | 
| diagramme	|diagram |	image    | 
| globe céleste	| globe |image   | 
| maquette	| model	| image |
| image de télédétection	| remote sensing image |	image |
| coupe |	section |	image |
|vue	| view	| image|
|plan	| plan	| image|

# Consultation de l’entrepôt
La navigation sur l’entrepôt est facilitée grâce à la création d’une feuille de style CSS qui peut être générée par le plugin. Elle est à déposer dans le thème omeka que vous utilisez.
