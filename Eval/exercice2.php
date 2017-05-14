<?php


//------------------------TRAITEMENT--------------------------
$message = '';
$affichage = '';
function Convertion($montant, $devise){

            $taux = 1.085965;

            if($devise == 'EUR'){
                $montant = $montant * $taux ;
            }

            if($devise == 'US'){
                $montant   = $montant / $taux ;
            }
        return   "Vous avez $montant  $devise";
}


if(!empty($_POST)){


             $affichage = convertion($_POST['montant'], $_POST['devise']);

}



//------------------------AFFICHAGE--------------------------

echo $message;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>On part en voyage</title>
</head>
<body>
    
    <h1>Taux de change Euro US</h1>

    <form method="post" action="">
            <article>
                    <label for="montant">Montant</label>
                    <input type="text" name="montant" id="montant">
            </article>
                    
            <article>
                    <input type="radio" name="devise"  id="euro"  value="EUR" checked><label for="euro">EUR</label>
                    <input type="radio" name="devise"  id="us"  value="US" checked><label for="us">US</label>      
            </article>  

            <button type="submit">Soumettre</button>

    </form>

    <?php
    echo $affichage;
    ?>
</body>
</html> 






