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

# Consultation de l’entrepôt
La navigation sur l’entrepôt est facilitée grâce à la création d’une feuille de style CSS (nom feuille de style) qui peut être générée par le plugin. Elle est à déposer dans le thème omeka que vous utilisez.
