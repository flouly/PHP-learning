<?php

/*Il sera inclu a tout les fichiers du site, fonction sera lui meme inclu dna init.inc

-Connection ala BDD
-creation ou ouver t ure de session
-definir une constante pour oe chemin du site
-et inclusion du fichier fonction.inc.php

*/
// connexition a la BDD
$pdo = new PDO('mysql:host=localhost;dbname=site', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//Session
session_start();

// Chemin du site
define('RACINE_SITE', '/08-site/'); //indique le dosssier dans lequel se situe le site dans 'localhost'

//declaration des variables d affichage du site
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

//Autres inclucions
require_once('fonction.inc.php');

?>
