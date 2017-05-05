<?php
require_once('inc/init.inc.php');

//--------------------Traitement----------------------
//2. Ajouter un produit au panier :

 //echo '<pre>'; print_r($_POST); echo '</pre>';
if(isset($_POST['ajout_panier'])) { // si on a clique sur ajouter au panier , alors on selectionne en base les infos du produit ajoute(ici titre et  le prix) on va chercd\her  le prix en base plutot que sur la fiche produit en POST pour des raisons de securite(internaute peut changer le prix dans l url)
$resultat = executeRequete("SELECT id_produit, titre, prix FROM PRODUIT WHERE id_produit = :id_produit", array(':id_produit' => $_POST['id_produit'])); //Lid du produit est donne par le formulaire a d ajout au produit

$produit = $resultat->fetch(PDO::FETCH_ASSOC);

ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'],$_POST['quantite'],$produit['prix']);


//On redirige vers la fiche produit en ajoutant que le produit a bien ete ajoute au produit
header('location:fiche_produit.php?statut_produit=ajoute&id_produit=' .$_POST['id_produit']); //url a etre lu pour l affichage de la modale
exit();

}

//3 Vider le panier

if(isset($_GET['action']) && $_GET['action'] == 'vider') {

    unset($_SESSION['panier']); // unset supprime un array ou une variable
}

//4 Supprimer un article du panier:
if(isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['articleASupprimer'])) {

    retirerProduitDuPanier($_GET['articleASupprimer']);
}

//4-Validation du pannier
if(isset($_POST['valider'])) {

    $id_membre = $_SESSION['membre']['id_membre'];
    $montant_total = montantTotal();

    //le panier etant valide on inscrit la commande en BDD
    executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUE (:id_membre, :montant, NOW())", array(':id_membre' => $id_membre, ':montant' => $montant_total  ));

    //on recupere l id_commande insere ci dessus pour l utilser en cle etrangere dans la table detail_commande
    $id_commande = $pdo->lastInsertId();

    //mise ajour de la table details_commande
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++ ) {
        //parcourt la table pour enregistrerchaque produit
        $id_produit = $_SESSION['panier']['id_produit'][$i];
        $quantite = $_SESSION['panier']['quantite'][$i];
        $prix = $_SESSION['panier']['prix'][$i];

          executeRequete("INSERT INTO detail_commande(id_commande, id_produit, quantite, prix) VALUES (:id_commande, :id_produit, :quantite, :prix) " , array(':id_commande' => $id_commande, ':id_produit' => $id_produit,':quantite' => $quantite, ':prix' => $prix ));

          //decrementatuon des stock du produit
          executeRequete("UPDATE produit SET stock = stock - :quantite WHERE id_produit = :id_produit", array(':quantite' => $quantite,'id_produit' => $id_produit));
    }

    unset($_SESSION['panier']);//on supprime le panier valide

$contenu .= '<div class="bg-success">Merci pour votre commande, le numero de suivi est le  ' .$id_commande. '</div>';
   
}






 



//----------------------Affichage----------
require_once('inc/haut.inc.php');  

echo $contenu;

echo '<h2>Voici votre panier</h2>';

if(empty($_SESSION['panier']['id_produit'])) {
    echo '<p>Votre panier est vide</p>';
} else {
    echo '<table class="table">';
        echo '<tr class="info">
            <th>Titre</th>
            <th>N du produit</th>
            <th>Quantite</th>
            <th>Prix unitaire</th> 
            <th>Action</th>
            </tr>';

            //on parcourt l array $_SESSION['panier'] pour afficher les produits qui s y trouvent:
            for ($i = 0 ; $i < count($_SESSION['panier']['id_produit']); $i++) {
                echo '<tr>';
                echo    '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
                echo    '<td>' . $_SESSION['panier']['id_produit'][$i] . '</td>';
                 echo  '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
                 echo   '<td>' . $_SESSION['panier']['prix'][$i] . '</td>';
                echo   '<td>
                             <a href="?action=supprimer&articleASupprimer='.$_SESSION['panier']['id_produit'][$i].'">Supprimer article</a>
                        </td>';
                 echo '</tr>';
            }

        echo '<tr class="info">
                <th colspan="3" > Total</th>
                <th colspan="2" > '. montantTotal() .'</th>        
            </tr>';//montantTotal() est declare dans fonctiion fonction.inc.php

            //si le membre est connecte on affiche le formulaire de validation du panier
                if(internautEstConnecte()) {

                    echo'<form method="post" action="">
                            <tr class="text-center">
                                <td colspan="5">
                                    <input type="submit" name="valider" value="valider le panier">
                                </td >
                            </tr>               
                        </form>';
                } else {
                    //membre non connecte on l invite a se connecter
                    echo' <tr class="text-center">
                                <td colspan="5">
                                        veuiller vous <a href="inscription.php">inscrire</a> ou vous <<a href="connexion.php">connecter</a>afin de valider le panier
                                </td >
                         </tr>';
                }
                    echo' <tr class="text-center">
                                <td colspan="5">
                                        <a href="?action=vider">Vider le panier</a>
                                </td >
                          </tr>';
        echo '</table>';    
}//fin du else










require_once('inc/bas.inc.php');