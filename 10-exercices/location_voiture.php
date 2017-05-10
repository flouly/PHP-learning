<?php
/*
   1- Vous créez un formulaire avec un menu déroulant avec les catégories A,B,C et D de véhicules de location et un champ nombre de jours de location. Lorsque le formulaire est soumis, vous affichez "La location de votre véhicule sera de X euros pour Y jour(s)." sous le formulaire.

   2- Vous validez le formulaire : la catégorie doit être correcte et le nombre de jours un entier positif.

   3- Vous créez une fonction prixLoc qui retourne le prix total de la location en fonction du prix de la catégorie choisie (A : 30€, B : 50€, C : 70€, D : 90€) multiplié par le nombre de jours de location. 

   4- Si le prix de la location est supérieur à 150€, vous consentez une remise de 10%.

*/

//----------------Traitement---------------------

$contenu = '';
$categorie = array('A'=> 30,'B'=> 50, 'C' => 70, 'D' =>90);
$coutLoc = '';
function prixLoc($nbJour, $prix){
    return $nbJour * $prix;
}

//var_dump($_POST);

if(!empty($_POST)){

    foreach($_POST as $indice => $valeur ){
        $_POST[$indice]= htmlspecialchars($valeur, ENT_QUOTES);
    }

//Controle formulaire
    
    if(!array_key_exists($_POST['categorie'], $categorie)){
        $contenu .= '<div>Vous devez choisir une categorie</div>';
    }


    $jour = (int)$_POST['Jour_location']; //transforme le contenu en integer
    if($jour <= 0){
        $contenu .= '<div>Nombre de jour non valide</div>';
    }
    // aussi fonction predefni ctype_digit()
    if(empty($contenu)){

        $coutLoc = prixLoc($_POST['Jour_location'], $categorie[$_POST['categorie']]);
//var_dump($categorie[$_POST['categorie']]);
        if($coutLoc > 150){

            $coutLoc -= $coutLoc * 10 / 100;
       //var_dump ($coutLoc);
        }
    }

}//Fin if(!empty($_POST))


//--------------------Affichage-;-------------------------
echo $contenu;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Location de voiture</title>
</head>
<body>
    <section>
        <form method="post" action="">
            <article>
            
                <label for="categorie">Categorie de la voiture</label><br>
                <select name="categorie" id="categorie">
                    <?php 
                    foreach($categorie as $indice => $valeur){

                        echo  "<option value=$indice>$indice</option>";
                    }
                
                    ?>
                </select><br><br>
            
            </article>
            <article>
                <label for="Jour_location">Jour de Location</label><br>
                <input type="text" name="Jour_location"><br><br>
            </article>
    
           <button type="submit">Soumettre</button><br><br>

           <?php
           echo 'La location de votre véhicule sera de  ' . $coutLoc . '   euros pour  '. $jour .'  jour(s)';

           //echo $coutLoc;
           ?>
        </form>
    
    </section>
</body>
</html>


