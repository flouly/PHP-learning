<?php
//__________________________________
//cas pratique
//------------------------------

/* Objectif nous allons creer  un espace de commentaires types  avis ou livre d or

Modelisation de la BDD dialogue
        Table : commentaire
        Champs : id_commentaire            INT(3) PK AI
                                            
                pseudo                    VARCHAR(20)
                message                   TEXT
                date_enregistrement         DATETIME

*/

// II connection a la BDD et trairement du post

$pdo = new PDO('mysql:host=localhost;dbname=dialogue', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if(!empty($_POST)){

    //Traitement contre les failles  XSS(Cross Site Script) (injections JS) OU LES injections CSS; on parle d echappement des donnees recu
    //on va injection dans le champs message :
    //<style>body{display:none}</style>

    //injection de code JS :
    //<script>while(true){alert('vous etes bloques....');}</script> 

    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
    $_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES); //htmlspecialchars convertit les caracteres speciaux en entite HTML (< devient &lt par ex), ce qui pemet de rendre innofensif les balises HTML .  ENT_QUOTES PERmet d ajouter a la liste de caracteres convertis

    //En complement:
    $_POST['message'] = strip_tags($_POST['message']); // permet de supprimer toutes les balises HTML CONTENU

    //htmlentities() permet aussi de convertir les balises HTML en entites HTML

    //1- premiere requete non protege par les injections et qui n accepte pas les apostrophes
    //$r = $pdo->query("INSERT INTO commentaire(pseudo, date_enregistrement, message) VALUES('$_POST[pseudo]', NOW(), '$_POST[message]')"); // pas de '' dans $_POST car deja entoure de ''

    //2- nous allons faire une injection SQL : dans champs message, saisir ok'); DELETE FROM commentaire; (
        //Pour se premunir des inJections SQL ET  pouvoir mettre des appostrophes ,nous pouvons faire  un requete preparee
        $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES(:pseudo, NOW(), :message)");

        $stmt->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $stmt->bindParam(':message', $_POST['message'], PDO::PARAM_STR);

        $stmt->execute();

}// fin du if(!empty($_POST))

?>
<form method="post" action="">

    <label for="pseudo">Pseudo</label> <br>
    <input type="text" id="pseudo" name="pseudo" value="" ><br><br>

    <label for="message">Message</label> <br>
    <textarea name="message" id="message" ></textarea><br><br>

    <input type="submit" name="envoie" value="envoie" >

</form>

<?php

// III Affichage des messages contenu en bdd
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d-%m-%Y') AS  datefr, DATE_FORMAT(date_enregistrement, '%H:%i:%s')  AS heurefr FROM commentaire ORDER BY date_enregistrement DESC");

echo '<h2>' . $resultat->rowCount() . ' commentaire </h2>';

while ($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)){

    echo '<div>';

        echo '<p>Par  ' . $commentaire['pseudo'] . ' le ' . $commentaire['datefr'] . ' a ' . $commentaire['heurefr'] . '</p>';
        echo '<p>' . $commentaire['message'] . '</p>';

    echo '</div>'; 

}
        