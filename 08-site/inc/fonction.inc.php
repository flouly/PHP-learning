<?php
//************************Fonctions membres**********************************

function internautEstConnecte(){ //isConnected
    //Cette fonction indique si l internaute est connecte: si la session membre est defini c est que le membre est passe par la page connexion avec le bon mdp
    if(isset($_SESSION['membre'])){
        return true;
    } else {
        return false;
    } // return(isset($_SESSION['membre'])); car isset retourne deja true ou false
}



function internautEstConnecteEtAdmin(){ //isAdmin

    if(internautEstConnecte() && $_SESSION['membre']['statut'] == 1) {
        return true;
    } else{
        return false;
    }
}

//-------------

function executeRequete($req, $param = array()) { //$param est un arrray vide par default donc est optionnel

    //htmlspecialchars
    if(!empty($param)){//si  on a bien recu un array on le traite
        foreach($param as $indice => $valeur){
            $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES); //transforme en entite HTML en caracteres speciaux, dont les quotes
        }
    }

    //requete preparee:
    global $pdo; //$pdo globale dans un espace local
    $r = $pdo->prepare($req);
    $succes = $r->execute($param); //on execute la requete on lui passant  l array $param qui permet d associer chaque marqueur a sa valeur


    //Traitement erreur SQL
    if(!$succes){ //il y a une erreur sur la requete si $succes est false

        die('Erreur sur la requete SQL: ' . $r->errorInfo()[2]); //die arrete le script et affiche un message;  errorInfo renvoie un array avec un message d erreur stocker un indice 2
    }

    return $r;  //retourne un objet PSOStatement qui contient le resultat de la requete

} //Fin de la function


//*********************Fonction du panier****************************
function creationDuPanier() {
    if(!isset($_SESSION['panier'])) {
        // si n existe pas le panier  dans SESSION  on le cree
        $_SESSION['panier'] = array(); // le panier est un array vide
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();

        
    }
}

function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix){//ces argument sont en provenance de panier.php

        creationDuPanier(); //pour creer la structure si elle n existe pas

        $position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']); //array_search retourne un chifre si l'id_produit est present dans l array $SESSION['Panier'] qui correspond a l'indice auquel se situe l element. sinon retourne false

        if($position_produit === false){
          //si le produit n est pas dans le panier on l y ajoute
          $_SESSION['panier']['titre'][] =  $titre; //les crocher vide pour ajouter l element a la fin de l array ici indice [0] dans 'titre'
          $_SESSION['panier']['id_produit'][] =  $id_produit; //ici indice [0] dans  'id_produit'
          $_SESSION['panier']['quantite'][] =  $quantite;//
          $_SESSION['panier']['prix'][] =  $prix;
        } else {
            //si ;e produit existe on ajoute la quantite nouvelle a la quantite deja presente dans le panier
            $_SESSION['panier']['quantite'][$position_produit] += $quantite;
        }
 
}

function montantTotal() {
    $total = 0; //contient le montant total de la commande

    for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) {

        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];// le symbole += pour ajouter la nouvelle valeut a l ancienne sans l ecraser

    }
    return round($total, 2);
}

//----------------------
function retirerProduitDuPanier($id_produit_a_supprimer) {
    //on cherche la position du produit dans le panier
    $position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']);

    if($position_produit !== false) {

        //si produit est dans le panier on coupe la ligne
        array_splice($_SESSION['panier']['titre'], $position_produit, 1);//efface la portion du tableau a partir de l indice indique par $position_produit et sur 1 ligne

        array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
        array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
        array_splice($_SESSION['panier']['prix'], $position_produit, 1);

    }
}
  
//-----------------------
//Exercice : creer une fonction qui retourne le nombre de produits differents dans le panier et afficher le resultat a cote du lien panier dans le menu de navigation, exemple : panier(3) si le panier est vide vous afficher panier (0)

function affichagePanier(){
/*$total = 0;
        for($i = 0; $i < $_SESSION['panier']['id_produit'][$i]; $i++){
            $total +=  $_SESSION['panier']['quantite'][$i];
        }

        return $total; //return renvoie precisement ou la fonction  est appelee
        */
    if(isset($_SESSION['panier'])){
        //return count($_SESSION['panier']['id_produit']);
        return array_sum($_SESSION['panier']['quantite']); // array_sum additionne les valeurs situees a un indice
        } else {
            return 0;//apres un return les instructions ne sont pas executees
        }  
}


      

