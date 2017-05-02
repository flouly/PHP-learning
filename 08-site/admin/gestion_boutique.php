<?php

require_once('../inc/init.inc.php');

//--------------------Traitement----------------------

//1- verification ADMIN // si le l url est trouver par erreur ou par  mauvaise intention; on redirige sur la page de connexion
if(!internautEstConnecteEtAdmin()){
    header('location:../connexion.php');// 
    exit();
}

//7-suppression d un produit
if(isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_produit'])) {

    //on selectionne en base la photo pour pouvoir supppreonef lse fichier correspondant
    $resultat = executeRequete("SELECT photo FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    $produit_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC);

    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo'];//chemin du fichier a supprimer

    if(!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)){
        unlink($chemin_photo_a_supprimer);// supprime le fichier specifie       
    }

    //Puis suppression de produit en BDD:
    executeRequete("DELETE FROM produit WHERE  id_produit = :id_produit", array('id_produit' => $_GET['id_produit']));

    $contenu .= '<div class="bg-succes">Le produit a ete supprime !</div>';
    $_GET['action'] = 'affichage';


}


//4-Enregistrement du produit en BDD
if($_POST){ //equivlent a !(empty($_POST)) Car si le $_POST est rempli il vaut TRUE = formulaire poste

        //il faudrait mettre les controles du formulaire

        $photo_bdd = ''; // la photo est traite specifiquenent en BDD. cette variable contiendra son chemin d'acces

        //9-modification dela photo(suite) :
        if(isset($_GET['action']) && $_GET['action'] == 'modification'){
            //je suis en moodefication je mets en base la photo  du champs hidden photo_actuelle du formulaire
            $photo_bdd = $_POST['photo_actuelle'];
        }



        //5-traitement de la photo:
        //echo '<pre>'; print_r($_FILES); echo '</pre>';
        if(!empty($_FILES['photo']['name'])){// une image a ete uploadee; qd $_FILES est creer il fait une copie de la photo et la met dans temp
         
            //on constitue un nom unique pour le fichier photo:
            $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];
            //On constistue le chemin de la photo enregistre en BDD
            $photo_bdd = RACINE_SITE . 'photo/' . $nom_photo; // on obtioent ici le nom et le chenim de la photo depuis la racine du site
            //on obient le chemin mais pas le fichier physique, on met ce dernier sur le serveur
            //on constitue le chemin absolu complet de la photo depuis la  racine serveur
            $Photo_dossier = $_SERVER['DOCUMENT_ROOT'] . $photo_bdd;

            //echo '<pre>'; print_r($Photo_dossier); echo '</pre>';
            copy($_FILES['photo']['tmp_name'], $Photo_dossier); //on copie le fichier temporaire de la photo stockee au chemin indique par $_FILES['photo']['tmp_name'] dans le chemin $Photo_dossier de notre serveur
        }

        //4 suite de l enregistrement en BDD
        executeRequete("REPLACE INTO Produit(id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo_bdd, :prix, :stock)", array('id_produit' => $_POST['id_produit'], 'reference' => $_POST['reference'] , 'categorie' => $_POST['categorie'] ,'titre' => $_POST['titre'], 'description' => $_POST['description'], 'couleur' => $_POST['couleur'], 'taille' => $_POST['taille'], 'public' => $_POST['public'],  ':photo_bdd' => $photo_bdd, 'prix' => $_POST['prix'], 'stock' => $_POST['stock']));

        $contenu .= '<div class"bg-succes">Le produit a ete enregitre</div>';
        $_GET['action'] = 'affichage'; // on met la valeur 'affichage' dans $_GET['action'] pour afficher  automatiquement  la table HTML  DES produits plus loin dans le script (point 6)

}
//2- les liens "affichages" et "ajout du produit":
$contenu .= '<ul class="nav nav-tabs">
                <li> <a href="?action=affichage">Affichage des produits</a>   </li>
                <li> <a href="?action=ajout">Ajout d\'un produit</a>   </li>
            </ul>';


//6-Affichage des produitd dans le back-office:

if(isset($_GET['action']) && $_GET['action'] == 'affichage'  || !isset($_GET['action'])) {//4_get contioent aicahage pu que l on arrive sur lapage pour la premiere fois ($_GET['action'] nlexiste pas


    $resultat = executeRequete("SELECT * FROM produit");

    $contenu .= '<h3>Affichage des produits</h3>';

    $contenu .= ' <p>Nombre de produits dans la boutique : ' . $resultat->rowCount() . '</p>';

    $contenu .= '<table class="table">';


        $contenu .= '<tr>';
        for ($i = 0; $i < $resultat->columnCount(); $i++){

            $colonne = $resultat->getColumnMeta($i);
            //echo '<pre>'; print_r($colonne); echo '</pre>';
            $contenu .= '<th>' . $colonne['name'] . '</th>';

        
        }
    $contenu .= '<th>Action</th>';// on ajoute une colonne action  
    $contenu .= '</tr>';
    //Affichage des lignes

    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $contenu .= '<tr>';

            foreach($ligne as $index => $data) {
                    if ($index == 'photo'){
                        $contenu .= '<td><img src="'. $data . '" width="70" height="70"></td>';
                    } else{
                        $contenu .= '<td>' . $data . '</td>';
                    }
            }
    $contenu .= '<td>
                    <a href="?action=modification&id_produit='. $ligne['id_produit'] .'">modifier</a>/
                    <a href="?action=suppression&id_produit='. $ligne['id_produit'] .'" onclick="return(confirm(\'etes vous certain de vouloir supprimer ce produits?\')) ";   
                    >supprimer</a>
                </td>';
     $contenu .= '</tr>';

    }
        
    $contenu .= '</table>';
}



//----------------------Affichage----------
require_once('../inc/haut.inc.php');
echo $contenu;

//3 formulaire html
if(isset($_GET['action']) && ($_GET['action'] == 'ajout'  || $_GET['action'] == 'modification')) :

    //3-formulaire de modification avec presaisie des infos dans le formulaire
    if(isset($_GET['id_produit'])){
        //pour preremplor le formulaire on requete  en BDD les infos du produit passe dans l url
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

        $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC);

    }
?>
<h3>Formulaire d'ajout ou de modification d'un produit</h3>
<form method="post" enctype="multipart/form-data" action=""> 
<!--"multipart/form-data"  permet d uploader unlfichier et de generer une superglobale $_FILES-->
    <input type="hidden" id="id_produit"  name="id_produit" value="<?php echo $produit_actuel['id_produit'] ?? 0; ?>" >
    <!--champ cache qui receptionne l id_produit necessaire lors de la modification d in produit existant-->

    <label for="reference">Reference</label><br>
    <input type="text" id="reference"  name="reference" value="<?php echo $produit_actuel['reference'] ?? 0; ?>" ><br><br>

     <label for="categorie">Categorie</label><br>
    <input type="text" id="categorie"  name="categorie" value="<?php echo $produit_actuel['categorie'] ?? 0; ?>"><br><br>

     <label for="titre">Titre</label><br>
    <input type="text" id="titre"  name="titre" value="<?php echo $produit_actuel['titre'] ?? 0; ?>" ><br><br>

     <label for="description">Description</label><br>
     <textarea name="description" id="description"><?php echo $produit_actuel['description'] ?? 0; ?>
     </textarea><br><br>

     <label for="couleur">Couleur</label><br>
    <input type="text" id="couleur"  name="couleur" value="<?php echo $produit_actuel['couleur'] ?? 0; ?>"  ><br><br>

    <label>Taille</label>
    <select name="taille" >
        <option value="S" selected>S</option>
        <option value="M"  <?php if(isset($produit_actuel['taille']) && $produit_actuel['taille'] == 'M') echo 'selected'; ?>)                >M</option>
        <option value="X" <?php if(isset($produit_actuel['taille']) && $produit_actuel['taille'] == 'X') echo 'selected'; ?>>X</option>
        <option value="XL" <?php if(isset($produit_actuel['taille']) && $produit_actuel['taille'] == 'XL') echo 'selected'; ?>>XL</option>
     </select><br><br>
    
     <label>Public</label><br>
     <input type="radio" name="public" value="m" checked > Homme
     <input type="radio" name="public" value="f" <?php if(isset($produit_actuel['public']) && $produit_actuel['public'] == 'f') echo 'checked'; ?>  > Femme
     <input type="radio" name="public" value="mixte" <?php if(isset($produit_actuel['public']) && $produit_actuel['public'] == 'mixte') echo 'checked'; ?>> Mixte<br><br>

     <label for="photo">Photo</label><br><br>
     <input type="file" id="photo" name="photo"><br><br><!--coupler avec l'attribut  enctype="multipart/form-data" de la blise <form>, le type "file" permet d'uploader un fichier-->

     <!--9 Modification de la photo-->
     <?php
    if(isset($produit_actuel['photo'])){
        echo '<i>vous pouvez uploade une nouvelle photo</i>';
        //afficher la photo actuelle
        echo '<img src="'. $produit_actuel['photo'] .'"  width="90"  height="90"><br>';
        //Mettre le chemin de la photo dans u n champs cache  pour l enregistre en base
        echo '<input type="hidden"   name="photo_actuelle" value="'. $produit_actuel['photo'] .'" >';
        //ce champs renseigne le $_POST['photo_actuelle']      qui va en  base quand on soumet le formulaire de modification. si on soumet le formulaire de modification . si on ne rempli pas le formulaire ici le champ photo de la base est remplace par un vide  ce qui efface  le chemin de la photo.
    }


     ?>


     <label for="prix">Prix</label><br><br>
     <input type="text" id="prix" name="prix" value="<?php echo $produit_actuel['prix'] ?? 0; ?>" > <br><br>

     <label for="stock">Stock</label><br><br>
     <input type="text" id="stock" name="stock" value="<?php echo $produit_actuel['stock'] ?? 0; ?>" > <br><br>
     
     <input type="submit"  value="valider" class="btn">



</form>


<?php
endif;







require_once('../inc/bas.inc.php');