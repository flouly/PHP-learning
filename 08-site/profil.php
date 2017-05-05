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

//exercice :
/*1 afficher le suivi des commandes du membre (s il n y en ) dans une liste ul li : id_commande,date et etat de la commande. s il n y en a pas, vous afficher "aucune commande en cours"
*/
$resultat = executeRequete("SELECT id_commande, date_enregistrement, etat  FROM  commande  WHERE  id_membre = :id_membre", array(':id_membre' => $_SESSION['membre']['id_membre']));

 $suivi = $resultat->fetch(PDO::FETCH_ASSOC);


while($suivi = $resultat->fetch(PDO::FETCH_ASSOC)){

//echo '<pre>'; print_r($suivi); echo '</pre>';



}





//-----------------AFFICHAGE---------------------------
require_once('inc/haut.inc.php');

echo $contenu;

require_once('inc/bas.inc.php');






