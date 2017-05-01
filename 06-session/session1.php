<?php
// ********************
// Les sessions
// *******************

// Fichier temporaire conservé dans le serveur avec un id et envoie un cookie avec cet id ; il reste actif lors d une navigation continue; il corespond donc a un internaute et le cookie disparait avec la fin de la session
// Envoyer des informations sensibles ( conservation du panier malgre que l utilisateur change de page, le login ......) : la session est disponilble dans toutes les  pages du site
// la session s arrete avec la navigation

// Creation ou ouverture d une session :
session_start();  

// remplissage de la session :
$_SESSION['pseudo'] = 'John';
$_SESSION['mdp'] = '1234'; // super global donc un ARRAY

echo '1- la session apres remplissage : ';
echo '<pre>'; print_r($_SESSION); echo '<pre>';

// vider une partie de la session en cours
unset($_SESSION['mdp']); // nous pouvons supprimer une partie de la session avec unset

echo '2- la session apres suppression de mdp : ';
echo '<pre>'; print_r($_SESSION); echo '<pre>';

// Supprimer entierement la session
//session_destroy(); // d abord vue par l interpreteur puis execution a la fin du script; verifier que le fichier a disparu dans temp

echo '2- la session apres suppression totale : ';
echo '<pre>'; print_r($_SESSION); echo '<pre>';
