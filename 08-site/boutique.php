<?php
require_once('inc/init.inc.php');

//--------------------Traitement----------------------

//1-Affichage categories de vetements

$categories_des_produits = executeRequete("SELECT DISTINCT categorie FROM produit");

$contenu_gauche .= '<p class="lead">Vetements</p>';
$contenu_gauche .= '<div class="list-group">';

            $contenu_gauche .= '<a href="?categories=all" class="list-group-item">Toutes les categories</a> ';                    

            //boucle while qui parcoure l objet $categories_des_produits pour en faire un faire un array associatif
            while($cat = $categories_des_produits->fetch(PDO::FETCH_ASSOC)) {

                $contenu_gauche .= '  <a href="?categorie='. $cat['categorie'] .'" class="list-group-item">' . $cat['categorie'] . '</a> ';


            }

$contenu_gauche .= '</div>'; 

// 2-Affichage des produits selon la categorie choisie
if(isset($_GET['categorie']) && $_GET['categorie'] != 'all'){
    //si on choisi une autre categorie que all
    $donnees = executeRequete(" SELECT id_produit, reference, titre, photo, prix, description FROM produit WHERE categorie = :categorie", array(':categorie' => $_GET['categorie'])); 
} else {
    //si on a demande toutes les categories
    $donnees = executeRequete("SELECT id_produit, reference, titre, photo, prix, description FROM produit ");//PAs de clause WHERE CAR  ON VEUT toutes les categories
}

 while ($produit =  $donnees->fetch(PDO::FETCH_ASSOC)){

    $contenu_droite .=  ' <div class="col-sm-4 col-lg-4 col-md-4"> ';
            $contenu_droite .= '<div class="thumbnail">';
                $contenu_droite .= ' <a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img src="'. $produit['photo'] .'"   width="130"  height="100"></a> ';

                $contenu_droite .= '<div class="caption">';  
                    $contenu_droite .=  ' <h4 class="pull-right"> '. $produit['prix'] .'$</h4> ';
                    $contenu_droite .=  ' <h4> '. $produit['titre'].'</h4> ';
                    $contenu_droite .=  ' <p> '. $produit['description'].'</p> ';
                $contenu_droite .= '</div>';
            $contenu_droite .= '</div>';
    $contenu_droite .= '</div>';
 }



//----------------------Affichage----------
require_once('inc/haut.inc.php');
?>

<div class="row">   

    <div class= "col-md-3">
    
        <?php echo $contenu_gauche;?>
    </div>

    <div class= "col-md-9">
        <div class="row"> 
        <?php echo $contenu_droite;?>
        </div>
    </div>

</div>



















<?php
require_once('inc/bas.inc.php');