<?php
//table Html avec nom telephone et champ supplementaires autres infos


//---------------------TRAITEMENT----------------------------
$contenu = '';

$pdo = new PDO('mysql:host=localhost;dbname=restaurants', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$resultat = $pdo->query("SELECT id_restaurant, nom, telephone FROM restaurant");


$contenu .= '<table>';

$contenu .= '<tr>';
        for($i = 1; $i < $resultat->columnCount(); $i++){
          
                        $colonne = $resultat->getColumnMeta($i);
                        //echo '<pre>'; print_r($colonne); echo '</pre>';
                        $contenu .= '<th>' .$colonne['name'].'</th>';                     
        }
                        $contenu .= '<th>Autres Infos</th>';
$contenu .= '</tr>';

while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){




        $contenu .= '<tr>
                         <td>' .$ligne['nom'].'</td>
                        <td>' .$ligne['telephone'].'</td>
                        <td><a href="?id_restaurant='. $ligne['id_restaurant'].'">Autres infos</a> </td>
                    <tr>';
}

$contenu .= '</table>';


if(isset($_GET['id_restaurant'])){

    $query = $pdo->prepare("SELECT * FROM restaurant  WHERE   id_restaurant = :id_restaurant");
    $query->bindParam(':id_restaurant', $_GET['id_restaurant'], PDO::PARAM_STR);
    $query->execute();


    $restaurant = $query->fetch(PDO::FETCH_ASSOC);

    

    $contenu .= '<h1>Detail du restaurant</h1>';
    if(!empty($restaurant)){
        $contenu .= $restaurant['nom'];
        $contenu .= $restaurant['adresse'];
        $contenu .= $restaurant['telephone'];
        $contenu .= $restaurant['type'];
        $contenu .= $restaurant['note'];
        $contenu .= $restaurant['avis'];
        
    } else {

        $contenu .= 'le restaurant n\'existe pas';

    }





}


//----------------------------AFFICHAGE-----------------------
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    echo $contenu;
    ?>
</body>
</html>





