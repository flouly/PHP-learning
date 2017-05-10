<?php

/* 1- Créer une base de données "contacts" avec une table "contact" :
	  id_contact PK AI INT(3)
	  nom VARCHAR(20)
	  prenom VARCHAR(20)
	  telephone INT(10)
	  annee_rencontre (YEAR)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. Le champ année est un menu déroulant de l'année en cours à 100 ans en arrière à rebours, et le type de contact est aussi un menu déroulant.
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   L'année de rencontre doit être une année valide
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	3- Ajouter les contacts à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/


$message = '';


$pdo = new PDO('mysql:host=localhost;dbname=contacts', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	
if(!empty($_POST)){


		//Controle formulaire

		if(strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20) {
			$message .= '<div>Le nom doit etre supererieur a 3 caracteres</div>';
		}

		if(strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20) {
			$message .= '<div>Le prenom doit etre superieur a 3 caracteres</div>';
		}

		if(!preg_match('#^[0-9]{10}$#',$_POST['telephone'])) {
			$message .= '<div>Le numero de telephone n\' est pas valide</div>';
		}

		if(!is_numeric($_POST['annee_rencontre']) && checkdate('01','01',$_POST['annee_rencontre'])){
			$message .= '<div>L\'annee  n\' est pas valide</div>';
		}

		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$message .= '<div>L\'email  n\' est pas valide</div>';
		}

		if($_POST['type_contact'] != 'ami' &&  $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionel' && $_POST['type_contact'] != 'autre'){
				$message .= '<div>Le type de contact  n\' est pas selectionne</div>';
		}

		if(empty($message)){


			$resultat = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, annee_rencontre, email, type_contact) VALUES (:nom, :prenom, :telephone, :annee_rencontre, :email, :type_contact) ");


			$resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
			$resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
			$resultat->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_INT);
			$resultat->bindParam(':annee_rencontre', $_POST['annee_rencontre'], PDO::PARAM_STR);
			$resultat->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
			$resultat->bindParam(':type_contact', $_POST['type_contact'], PDO::PARAM_STR);
			


			$req = $resultat->execute();

			if($req){
				$message .= '<div>Le contact a ete ajoute</div>';

			} else{

				$message .= '<div>Une erreur est survenue lors de l\' enregistrement</div>';

			}
		}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Contact</title>
</head>
<body>
	 <h1>Enregistrer un contact</h1>
    <?php echo $message; ?>

	<section>
		<form method="post" action="">
		
			<label for="nom">Nom</label><br>
			<input type="text" id="nom" name="nom"><br><br>
		
			<label for="prenom">Prenom</label><br>
			<input type="text" id="prenom" name="prenom"><br><br>

			<label for="telephone">Telephone</label><br>
			<input type="text" id="telephone" name="telephone"><br><br>
		
			<label for="year">Annee</label>
			<?php
			echo '<select  name="annee_rencontre" id="year">';
			$option = date('Y') - 100;
			while ($option <= date('Y')){

				echo '<option >' .$option . '</option>';
				$option++;
			}
			echo '</select><br><br>';
						
			?>

			<label for="email">Email</label><br>
			<input type="text" id="email" name="email"><br><br>


			<label for="type_contact" >Type de contact</label>
			<select name="type_contact" id="type_contact" >
				<option value="ami"  > Ami </option>
				<option value="famille" > Famille  </option>
				<option value="professionel" >Professionel</option>
				<option value="autre" >Autre</option>
			
			</select><br><br>	
		
			<input type="submit" value="Entree">
			
		</form>
	</section>
</body>
</html>