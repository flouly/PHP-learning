<?php

/* 1- Créer une base de données "restaurants" avec une table "restaurant" :
	  id_restaurant PK AI INT(3)
	  nom VARCHAR(100)
	  adresse VARCHAR(255)
	  telephone VARCHAR(10)
	  type ENUM('gastronomique', 'brasserie', 'pizzeria', 'autre')
	  note INT(1)
	  avis TEXT

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un restaurant dans la bdd. Les champs type et note sont des menus déroulants que vous créez avec des boucles.
	
	3- Effectuer les vérifications nécessaires :
	   Le champ nom contient 2 caractères minimum
	   Le champ adresse ne doit pas être vide
	   Le téléphone doit contenir 10 chiffres
	   Le type doit être conforme à la liste des types de la bdd
	   La note est un nombre entre 0 et 5
	   L'avis ne doit être vide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter le restaurant à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/
//---------------------Traitement----------------------------
$contenu = '';
$type = array('gastronomique', 'brasserie', 'pizzeria', 'autre');

$pdo = new PDO('mysql:host=localhost;dbname=restaurants', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//var_dump($_POST);

if(!empty($_POST)){

	if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {

		$contenu .= '<div>Erreur Nom</div>';
	}

	if($_POST['adresse'] == '' ) {

		$contenu .= '<div>Erreur adresse</div>';
	}

	
	if(!preg_match('#^[0-9]{10}$#', $_POST['telephone'])){
		$contenu .= '<div>Le téléphone doit comporter 10 chiffres</div>';
	}

	if(!in_array($_POST['type'], $type)){

		$contenu .= '<div>Erreur type</div>';
	}


	if(!ctype_digit($_POST['note']) || $_POST['note'] < 0 || $_POST['note'] > 5){
		$contenu .= '<div>Erreur note</div>';
	}

		if($_POST['avis'] == '' ) {

		$contenu .= '<div>Erreur vis</div>';
	}

	if(empty($contenu)){


		foreach($_POST as $indice => $valeur) {
			$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		}


			$resultat = $pdo->prepare("INSERT INTO restaurant (nom, adresse, telephone, type, note, avis) VALUES (:nom, :adresse, :telephone, :type, :note, :avis)");

			$resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
			$resultat->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
			$resultat->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
			$resultat->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
			$resultat->bindParam(':note', $_POST['note'], PDO::PARAM_INT);
			$resultat->bindParam(':avis', $_POST['avis'], PDO::PARAM_STR);

			$succes = $resultat->execute();

			if($succes){
					$contenu .= '<div>Le restaurant a ete ajoute</div>';
			} else {
			
				$contenu .= '<div>Un probleme est survenu</div>';
			
			}


	}//Fin if(empty($contenu))

}//fin if(!empty($_POST))




//---------------------------Afichage-------------------------------

echo $contenu;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Restaurants</title>
</head>
<body>
	<section>
		<form method="post" action="">

		<label for="nom">Nom</label><br>
		<input type="text" name="nom" id="nom"><br><br>
		
		<label for="adresse">Adresse</label><br>
		<input type="text" name="adresse" id="adresse"><br><br>
		
		<label for="telephone">Telephone</label><br>
		<input type="text" name="telephone" id="telephone"><br><br>
		
		<label for="type">Type</label><br>
		<select name="type" id="type">
			<?php
					foreach($type as $valeur){
							echo "<option value=$valeur>$valeur</option>";
					}
			?>	
		</select><br><br>


		<label for="note">Note</label><br>
			<select name="note" id="note">
			<?php
					$i = 0;
					for($i = 0; $i < 6; $i++){
							echo '<option value='. $i .'>' . $i . '</option>';
					}
			?>	
		</select><br><br>
		
		<label for="avis">Votre avis</label><br>
		<textarea name="avis" id="avis" ></textarea><br><br>

		<input type="submit" value="Envoyer">
		
		</form>
	
	</section>
</body>
</html>


