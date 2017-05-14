<?php



//---------------------TRAITEMENT----------------------------
$contenu = '';

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));



$resultat = $pdo->query("SELECT id_movie, title, director, year_of_prod FROM movies");


$contenu .= '<table border= 1 >';

$contenu .= '<tr>';
        for($i = 1; $i < $resultat->columnCount(); $i++){
          
                        $colonne = $resultat->getColumnMeta($i);
                        //echo '<pre>'; print_r($colonne); echo '</pre>';
                        $contenu .= '<th>' .$colonne['name'].'</th>';                     
        }
                        $contenu .= '<th>Details du film</th>';
$contenu .= '</tr>';

while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){

        $contenu .= '<tr>
                         <td>' .$ligne['title'].'</td>
                        <td>' .$ligne['director'].'</td>
                        <td>' .$ligne['year_of_prod'].'</td>
                        <td><a href="?id_movie='. $ligne['id_movie'].'">Details du film</a> </td>
                    <tr>';
}

$contenu .= '</table>';


if(isset($_GET['id_movie'])){

    $query = $pdo->prepare("SELECT * FROM movies  WHERE   id_movie = :id_movie");
    $query->bindParam(':id_movie', $_GET['id_movie'], PDO::PARAM_STR);
    $query->execute();


    $film= $query->fetch(PDO::FETCH_ASSOC);

    

    $contenu .= '<h1>Detail du film</h1>';
    if(!empty($film)){
        $contenu .= '<p>Titre :  ' .$film['title']. '</p>';
        $contenu .= '<p>Acteurs :  ' .$film['actors']. '</p>';
        $contenu .= '<p>Directeur:  ' .$film['director']. '</p>';
        $contenu .= '<p>Producteur :  ' .$film['producer']. '</p>';
        $contenu .= '<p>Annee de production :  ' .$film['year_of_prod']. '</p>';
        $contenu .= '<p>Langage :  ' .$film['language']. '</p>';
        $contenu .= '<p>Categorie :  ' .$film['category']. '</p>';
        $contenu .= '<p> Storyline :  ' .$film['storyline']. '</p>';
        $contenu .= '<p> Video :   ' .$film['video']. '</p>';
        
    } else {

        $contenu .= 'le film n\'existe pas';

    }
}

//---------------------AFFICHAGE------------------------

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tableau des film</title>
</head>
<body>
    <?php
    echo $contenu;
    ?>
</body>
</html>