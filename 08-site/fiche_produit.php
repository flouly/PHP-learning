<?php
require_once('inc/init.inc.php');

//--------------------Traitement----------------------
$aside = '';

//1- Controler que le produit demande existe
if(isset($_GET['id_produit'])){//si existe l indice id_produit dans l url
        // on requete en base le produit demande pout verifier son existence
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

        if ($resultat->rowCount() <= 0){
            header('location:boutique.php');
             exit();
        }

        //2-Affichage du detail du produit:
        $produit = $resultat->fetch(PDO::FETCH_ASSOC);

        $contenu .= '<div class="row">;

                        <div class="col-lg-12">
                            <h1 class="page-header">'.$produit['titre'].'</h1>
                        </div>
                    </div>';
                    
        $contenu .=  '<div class="col-md-8">
                            <img class="img-responsive" src="'.$produit['photo'].'" alt="">
                        </div>';

         $contenu .= '<div class="col-md-4">
                            <h3>Description</h3>
                            <p>'.$produit['description'].'</p>
                            <h3>Details</h3>
                            <ul>
                                <li>Categorie : '.$produit['categorie'].'</li>
                                <li>Couleur : '.$produit['couleur'].'</li>
                                <li>Taille : '.$produit['taille'].'</li>
                            </ul>

                            <p class="lead">Prix : '.$produit['prix'].'$</p>
                        </div>';

           //3-Affichage du formulaire d ajout au panier si stock > 0 :

           $contenu .= '<div class="col-md-4">';
                    if($produit['stock'] > 0){
                        // si il ya du stock. on  met le bouton d ajout du panier
                        $contenu .= '<form method="post" action="panier.php">';

                               $contenu .= ' <input type="hidden" name="id_produit"  value="'.$produit['id_produit'].'">'; 

                               $contenu .= '<select name="quantite" id="quantite" >';
                                        for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++ ){
                                                $contenu .= "<option >$i</option>"; // pas de concatenation donc ""

                                        }

                               $contenu .= '</select>';

                               $contenu .= '<input type="submit" name="ajout_panier"  value="ajouter au panier" class="bt">';

                        $contenu .= '</form>';
                    } else{
                        $contenu .= ' <p>rupture de stock</p>';
                    }

                    //4- Lien retour vers la boutique

                    $contenu .= '<p><a href="boutique.php?categorie='.$produit['categorie'].'">Retour vers votre  selection</a></p>';


           $contenu .= '</div>';

} else {
        // si l indece d_produit pas dans l url
        header('location:boutique.php');
        exit();
}


//------------------------------------
//Exercice
//------------------------------------
/*vous allez afficher des suggestions de produits: affichez 2 produits (photo et titre) aleatoire mais appartenaant al la categorie de produit affiche dans la page detail. Ces produits doivent doivent etre different du produit affiche . la photo est cliquable et amene a la fiche produit
            utiliser la variable $aside pour afficher le contenu
*/
$suggestion = executeRequete("SELECT id_produit, photo, titre  FROM produit WHERE  id_produit <>  :id_produit AND categorie = :categorie  ORDER BY RAND() LIMIT 2 ", array (':id_produit'=> $produit['id_produit'],':categorie' => $produit['categorie']));// <> ou !=

while($Produit_suggere = $suggestion->fetch(PDO::FETCH_ASSOC)){

        $aside .= '<div class="col-sm-3">
                            <a href="?id_produit='.$Produit_suggere['id_produit'].'">
                                <img src="'.$Produit_suggere['photo'].'" width="60" height="60">
                            </a>
                            <h4>'.$Produit_suggere['titre'].'</h4>
                    </div>';        
}


//----------------------Affichage----------
require_once('inc/haut.inc.php');   
echo $contenu_gauche; //recevra le pop up de confirmation d ajout au panier
?>

    <div class="row">
        <?php echo $contenu; // affiche le detail d un produit  ?>
    </div>

    <div class="row">
        <div class="col-lg-12">
        
            <h3 class="page-header">Suggestion de produits</h3>
        </div>

        <?php echo $aside; // affiche les produits  suggerees  ?>
     </div>


<?php
require_once('inc/bas.inc.php');