<?php



//------------------------TRAITEMENT--------------------------






$contenu = '';
$tab = array('Prenom' => 'Frederic', 'Nom' => 'Louly','Adresse' => '21 rue charles V', 'Code Postale'=> '75004', 'Ville' => 'Paris', 'Email' =>'flouly@orange.fr', 'Telephone' => '06 21 40 32 75', 'Date de naissance' => '1961-06-11');



$date = new Datetime($tab['Date de naissance']);
$tab['Date de naissance'] = $date->format('d-m-Y');

foreach($tab as $key => $values){

                

            $contenu .= '<ul>';

                $contenu .= '<li>' .$key. ':   '.$values. '</li>';
            $contenu .= '</ul>';
}






//--------------------AFFICHAGE-----------------------------

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>On se présente !</title>
</head>
<body>
    <h1>Mes details</h1>
    <?php
    echo $contenu;

    ?>
</body>
</html>
