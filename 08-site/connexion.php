<?php
require_once('inc/init.inc.php');

//--------------------Traitement----------------------
//deconnection demandee per l unternaute

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    //si l internaute demande la deconnexion on detruit la session

    session_destroy();
}

//intternaute deja connecte
if(internautEstConnecte()) {
    header('location:profil.php'); // si internaute deja connecte on le redirige sur son profil
}

//traitement de formulaire de connection et remplissage de la session
if(!empty($_POST)){

    //controle formulaire
    if(empty($_POST['pseudo'])){
        $contenu .= '<div class="bg_danger">Le pseudo est requis</div>';

    }

    if(empty($_POST['mdp'])){

        $contenu .= '<div class="bg_danger">Le mot de passe est requis</div>';
    }

    //si le formulaire est correcte on contrele les identifiants
    if(empty($contenu)){

        $mdp = md5($_POST['mdp']);// on crypte le mdp pour le comparer avec c elui de la base

        $resultat = executeRequete(" SELECT * FROM membre WHERE pseudo = :pseudo   AND  mdp = :mdp ", array( ':pseudo' => $_POST['pseudo'], ':mdp' => $mdp));

        if ($resultat->rowCount() != 0){// s il ya un resultat dans la recherch c est que le pseudo et le mdp corresponde
            $membre = $resultat->fetch(PDO::FETCH_ASSOC); //pas de while car unicite pseudo
            //echo '<pre>'; print_r($membre); echo '</pre>';

            $_SESSION['membre'] = $membre; // nous remplissons la session avec les elements provenant de la bdd. elle permet de conserver  les infos du membre dans tout le site

            header('location:profil.php');//le membre etant connecte on l envoie vers son profil
            exit();
        } else { 
            //si les identifiants ne correspondent pas on affiche un message derreur
             $contenu .= '<div class="bg_danger">Erreur sur les identifiants</div>';
        }




    } //fin if(empty($contenu)

}//fin if(empty($_POST))

//----------------------Affichage----------
require_once('inc/haut.inc.php');
echo $contenu;
?>

<h3>Veuillez renseigner vos identifiants pour vous connecter</h3>

<form method="post" action="">

    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo"   name="pseudo" value=""    ><br><br>


    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp"   name="mdp"  value=""   ><br><br>

     <input type="submit"   value="Se connecter"  class="btn"   >

</form>






<?php
require_once('inc/bas.inc.php');