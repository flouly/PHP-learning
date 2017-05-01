<?php
// Creer un formulaire qui permet d enregistrer un nouvel employe dans la base  entreprise

/*les etapes
1 Creation du formulaire HTML
2 CONNEXTION a la BDD
3 Lorsque le formulairre est poste insertion des informations du formulaire en BDD
FAITES le avec une requete preparees.
4 afficher a la fin un message "L employe a bien ete ajoute".
*/
$message = '';//variable d affichage des messages d erreur de validation du formulaire

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if(!empty($_POST)){ // si le formulaire est poste, il y a des indices dans $_POST, IL n est donc pas  vide


        // Controle du FORMULAIRE :
        if(strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20) $message .= '<div>Le prenom doit comporter  3 carateres</div>';

         if(strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20) $message .= '<div>Le prenom doit comporter  3 carateres</div>';

         if($_POST['sexe'] != 'm' && $_POST['sexe'] != 'f') $message .= '<div>le sexe n\'est pas  correcte </div>';

         if(strlen($_POST['service']) < 3 || strlen($_POST['service']) > 20) $message .= '<div>Le service doit comporter  3 carateres</div>';

         if(!is_numeric($_POST['salaire']) || $_POST['salaire'] <= 0) $message .= '<div>Le salaire doit etre supereur a 0</div>';//is_numeric teste si c est un nombre

         $tab_date = explode('-', $_POST['date_embauche']);// met le jour, le mois  et l annnee dans un array pour pouvoir  les passer a la fonction checkdate($mois, $jour, $annee)
         if(!(isset($tab_date[0]) && isset($tab_date[1]) && isset($tab_date[2]) && checkdate($tab_date[1], $tab_date[2], $tab_date[0])))  $message .= '<div>La date n\'est pas valide</div>';  // la date est demandee en post  en YYYY-mm-jj

         if(empty($message)){ //si le message est vide 

                 $resultat = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire ) VALUES (:prenom, :nom, :sexe, :service, :date_embauche, :salaire)");  
 

                $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
                $resultat->bindParam(':sexe', $_POST['sexe'], PDO::PARAM_STR);
                $resultat->bindParam(':service' , $_POST['service'], PDO::PARAM_STR);
                $resultat->bindParam(':date_embauche', $_POST['date_embauche'], PDO::PARAM_STR);
                $resultat->bindParam(':salaire', $_POST['salaire'], PDO::PARAM_INT);

                $req = $resultat->execute();
                // Afficher un message "l employer a ete ajoute"
                if($req){ // execute()renvoie un objet PODStatement donc a une valeur implicite true en cas de succes de la requete sinon false
                    echo 'L\'employe a ete ajoute';

                } else{
                    echo 'Une erreur est survenue lors de l\' enregistrement';
                }

        }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
</head>
<body>
    <h1>Enregistrer un employe</h1>
    <?php echo $message; ?>
    <section>
    
        <form method="post" action="">
            

             <label for="prenom">Prenom</label>                       
            <input type="text" id="prenom" name="prenom"><br>

             <label for="nom">Nom</label>                       
            <input type="text" id="nom" name="nom"><br>

            <label for="sexe">Sexe</label>                       
            <input type="radio" id="homme" name="sexe" value="m" checked><label for="homme">Homme</label>
            <input type="radio" id="femme" name="sexe" value="f" checked><label for="femme">Femme</label><br>

            <label for="service">Service</label>                       
            <input type="text" id="service" name="service"><br>

            <label for="date_embauche">Date d'embauche</label>                       
            <input type="text" id="date_embauche" name="date_embauche"><br>

             <label for="salaire">Salaire</label>                       
            <input type="text" id="salaire" name="salaire"><br>

            <input type="submit" value="Entree">
        
        </form>
    
    </section>
</body>
</html>