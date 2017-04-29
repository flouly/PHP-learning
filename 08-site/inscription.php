<?php

//-------------------------TRAITEMENT------------------------------
require_once('inc/init.inc.php');
$inscription = false; // variable qui permet de savoir si le  membre est est inscrit pour neapas reafficher ;e formulaire d inscriptiom\n

//Traitement du post
if(!empty($_POST)){


    if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20){

        $contenu .= '<div class="bg_danger">Le pseudo doit contenir au moins 4 caracteres</div>';

    }

    if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20){

        $contenu .= '<div class="bg_danger">Le mot de passe doit contenir au moins 4 caracteres</div>';

    }

    if(strlen($_POST['prenom']) < 4 || strlen($_POST['prenom']) > 20){

        $contenu .= '<div class="bg_danger">Le prenom doit contenir au moins 4 caracteres</div>';

    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

        $contenu .= '<div class="bg_danger">Email est invalide </div>';
    }
    //filter_var()lpernmet de valide des formats de chaines de caracteres pour verifier qu  il s agit ici d 'EMAIL(on pourrai verifie un URL)

     if($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f'){
         $contenu .= '<div class="bg_danger">La civilite est incorrecte</div>';
     }

      if(strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 20){

        $contenu .= '<div class="bg_danger">La ville ne doit pas etre vide</div>';

    }

    //Validation du code postal avec une expression reguliere

    if(!preg_match('#^[0-9]{5}$#', $_POST['code_postal'])){ //preg_match retourne true si le string en deuxieme argument corespond a l expressiom reguliere 
        $contenu .= '<div class="bg_danger">Le code postal n\' est pas valide</div>';
    }
    /*expression reguliere
    # au debut er a la fin
    ^ expressiopn debute par ce qui suit
    $     "         se termine
    []intervale des caracteres autorises   ici 0 a 9
    {} quantificateur  ici 5
    */

    if(strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50){
        $contenu .= '<div class="bg_danger">L\' adresse doit contenir au moins 4 caracteres</div>';
    }

    //si aucune erreur sur le formulaire on verifie l unicite du pseudo en base
    if(empty($contenu)){ // si $contenu vide pas d erreur

        $membre = executeRequete("SELECT id_membre FROM membre WHERE pseudo = :pseudo", array(':pseudo'=>$_POST['pseudo']));//on verifie l existance du pseudo

        if ($membre->rowCount() > 0 ){// s il y a des lignes dans le resultat de la requete
             $contenu .= '<div class="bg_danger">Le pseudo est indisponible : veuillez en choisir un autre</div>';
        } else {
            //si le pseudo est unique on peut faire l inscription en BDD :

            $_POST['mdp'] = md5($_POST['mdp']);// encryption. il faudra le faire sur la  page connextion pour comparer 2 mots cryptes
        


            executeRequete("INSERT INTO membre (pseudo, mdp,nom, prenom, email, civilite, ville, code_postal, adresse, statut)  VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0) ", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp'], ':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':email' => $_POST['email'], ':civilite' => $_POST['civilite'], ':ville' => $_POST['ville'],':code_postal' => $_POST['code_postal'], ':adresse' => $_POST['adresse']));

            $contenu .= '<div class="bg_danger">vous etes inscrit . <a href="connection.php"</div>';
            $inscription = true; //Pour ne plus afficher le formlaire d inscription

        }//Fin du else de $membre->rowcount() > 0 
    }//Fin du if if(empty($contenu))

} //Fin du if(!empty($_POST))


//----------------------AFFICHAGE 
require_once('inc/haut.inc.php');
echo $contenu; //affiche les messages du site 


if(!$inscription) :
?>
<h3>Veuillez renseigner le formulaire pour vous inscrire</h3><br><br>

<form method="post" action="">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo"   name="pseudo" value=""    ><br><br>


    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp"   name="mdp"  value=""   ><br><br>

    <label for="nom">Nom</label>
    <input type="text" id="nom"   name="nom"  value=""   ><br><br>

    <label for="prenom">Prenom</label>
    <input type="text" id="prenom"   name="prenom"  value=""   ><br><br>

    <label for="email">Email</label>
    <input type="text" id="email"   name="email" value=""   ><br><br>

    <label>Civilite</label>
    <input type="radio" name="civilite" id="homme" value="m" checked >   <label for="homme" >Homme</label> 
    <input type="radio" name="civilite" id="femme" value="f" checked >   <label for="femme" >Femme</label> <br><br>


    <label for="ville">Ville</label>
    <input type="text" id="ville"   name="ville" value=""   ><br><br>

    <label for="code_postal">Code postal</label>
    <input type="text" id="code_postal"   name="code_postal" value=""   ><br><br>

    <label for="adresse">adresse</label>
    <input type="text" id="adresse"   name="adresse" value=""   ><br><br>


    <input type="submit" name="inscription"   value="S'inscrire"  class="btn"   >

</form>



<?php
endif;

require_once('inc/bas.inc.php');