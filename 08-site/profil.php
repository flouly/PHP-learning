<?php

require_once('inc/init.inc.php');


//-----------TRAITEMENT-----------------------
//visiteur mon connecte on l envoie sur connexion
if(!internautEstConnecte()){
    header('location:connexion.php');
    exit();

}
//echo '<pre>'; print_r($_SESSION); echo '</pre>';

 $contenu .= '<h2> Bonjour ' . $_SESSION['membre']['pseudo'] . '! <h2>';

// on affiche le statut  du membre

if($_SESSION['membre']['statut'] == 1){
    $contenu .= '<p>Vous etes  administrateur</p>';
} else{
    $contenu .= '<p>Vous etes  membre</p>';
}
$contenu .= '<div><h3>Voici vos informations de profil</div></h3>';

 $contenu .= '<p> Votre Email :  ' . $_SESSION['membre']['email'] . '</p> ';

 $contenu .= '<p> Votre adresse : ' . $_SESSION['membre']['adresse'] . '</p> ';

  $contenu .= '<p> Votre code postal :' . $_SESSION['membre']['code_postal'] . '</p> ';

  $contenu .= '<p> Votre ville :' . $_SESSION['membre']['ville'] . '</p> ';

$contenu .= '</div>';









//-----------------AFFICHAGE---------------------------
require_once('inc/haut.inc.php');

echo $contenu;

require_once('inc/bas.inc.php');






