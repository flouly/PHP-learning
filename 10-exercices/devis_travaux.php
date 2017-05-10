<?php
/* 
	1- Vous réalisez un formulaire "Votre devis de travaux" qui permet de saisir le montant des travaux de votre maison en HT et de choisir la date de construction de votre maison (bouton radio) : "plus de 5 ans" ou "5 ans ou moins". Ce formulaire permettra de calculer le montant TTC de vos travaux selon la période de construction de votre maison.

	2- Vous réalisez la validation du formulaire : le montant doit être en nombre positif non nul, et la période de construction conforme aux valeurs que vous aurez choisies.

	3- Vous créez une fonction montantTTC qui calcule le montant TTC à partir du montant HT donné par l'internaute et selon la période de construction : le taux de TVA est de 10% pour plus de 5 ans, et de 20% pour 5 ans ou moins. La fonction retourne le résultat du calcul.
	
	Formule de calcul d'un montant TTC :  montant TTC = montant HT * (1 + taux / 100) où taux est par exemple égale à 20.

	4- Vous affichez le résultat calculé par la fonction au-dessus du formulaire : "Le montant de vos travaux est de X euros avec une TVA à Y% incluse."

	5- Vous diffusez des codes de remises promotionnelles, dont un est 'abc' offrant 10% de remise. Ajoutez un champ au formulaire pour saisir le code de remise. Vous validez ce champ qui ne doit pas excéder 5 caractères. Puis la fonction montantTTC applique la remise (-10%) au montant total des travaux si le code de l'internaute est correcte. Vous affichez dans ce cas "Le montant de vos travaux est de X euros avec une TVA à Y% incluse, et y compris une remise de 10%.". 

*/
$message = '';
//var_dump($_POST);
$affichage = '';

function montantTravaux($momtantHT, $date, $code){
				$taux = array(10, 20);
				if($date == "+5ans"){
							$taux = $taux[1];
							$montantTTC = $momtantHT * (1 + $taux/100); 
					
				} elseif($date == "-5ans") {
							$taux = $taux[2];
							$montantTTC = $momtantHT * (1 + $taux/100); 

				} else {
							$montantTTC = 'Erreur';
				}

				if($code = 'abc'){
						$montantTTC = 0.9 * $montantTTC;
						$TextRemise = ", avec une remise de 10 %";
				}
				return "Votre montant de travaux TTC est de  $montantTTC avec un taux de TVA de $taux %  et $TextRemise  ";

}

if(!empty($_POST)){

				if(!is_numeric($_POST['montant'])  || $_POST['montant'] <= 0){
					$message .= '<div>Erreur Montant</div>';
				}
				if( $_POST['date_construction'] != "+5ans" && $_POST['date_construction'] != "-5ans"){
					$message .= '<div>Erreur date de construction</div>';
				}

				if(strlen($_POST['code_remise']) > 5){
					$message .= '<div>Erreur de code</div>';
				} 

				if(empty($message)){


						$affichage = montantTravaux($_POST['montant'], $_POST['date_construction'],$_POST['code_remise']);

					
				}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Votre devis</title>
</head>
<body>

	<h1>Cacul des travaux</h1>

	<?php
	echo $message;
	?>

	<form method="post" action="">
	
		<label for="montant">Montant travaux HT</label><br>
		<input type="text" name="montant" id="montant"><br><br>

		<label >Date de construction</label>
		<input type="radio" name="date_construction" id="+5ans" value="+5ans"checked><label for="+5ans">+5ans</label>
		<input type="radio" name="date_construction" id="-5ans" value="-5ans"checked><label for="-5ans">-5ans</label><br><br>


		<label for="code_remise">Code remise</label><br>
		<input type="text" name="code_remise" id="code_remise"><br><br>

		<button type="submit">Soumettre</button>
	
	</form>

		<?php
		echo $affichage;
		?>
</body>
</html>