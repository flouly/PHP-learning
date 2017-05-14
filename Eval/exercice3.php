
<style>p{color:red}</style>
<?php



//---------------TRAITEMENT------------------------

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$message = '';
$contenu = '';
$category = array('rated', 'nonrated');
$language = array('fr', 'en','dr', 'rus', 'ita', 'es');

//var_dump($_POST);
// Traitement des champs du formulaire
    if($_POST){

        if(strlen($_POST['title']) < 5 || strlen($_POST['title']) > 50){
            $contenu .= '<div>Erreur titre</div>';
        }

        if(strlen($_POST['actors']) < 5 || strlen($_POST['actors']) > 20){
            $contenu .= '<div>Erreur actors</div>';
        }

        if(strlen($_POST['director']) < 5 || strlen($_POST['director']) > 20){
            $contenu .= '<div>Erreur director</div>';
        }

        if(strlen($_POST['producer']) < 5 || strlen($_POST['producer']) > 20){
            $contenu .= '<div>Erreur producer</div>';
        }


        if(!preg_match('#^[0-9]{4}$#', $_POST['year_of_prod'])){
            $contenu .= '<div>Erreur producer</div>';
        }

        if (!in_array($_POST['category'], $category)){
            $contenu .= '<div>Pas la bonne categorie</div>';
        }



        if (!in_array($_POST['language'], $language)){
            $contenu .= '<div>Pas la bonne langue</div>';
        }


        if(strlen($_POST['storyline']) < 5 || strlen($_POST['storyline']) > 255){
            $contenu .= '<div>Erreur Storyline</div>';
        }


        if (!filter_var($_POST['video'], FILTER_VALIDATE_URL)){
		$contenu .= '<div>Ce n\'est pas un lien</div>';
	    }


        if(empty($contenu)){


            	foreach($_POST as $indice => $valeur){      
			        $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		        }

                $resultat = $pdo->prepare("INSERT INTO movies (title, actors, director, producer, year_of_prod, category, language, storyline, video) VALUES (:title, :actors, :director, :producer, :year_of_prod, :category,:language, :storyline, :video) ");


                $resultat->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
                $resultat->bindParam(':actors', $_POST['actors'], PDO::PARAM_STR);
                $resultat->bindParam(':director', $_POST['director'], PDO::PARAM_STR);
                $resultat->bindParam(':producer', $_POST['producer'], PDO::PARAM_STR);
                $resultat->bindParam(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_INT );
                $resultat->bindParam(':category', $_POST['category'], PDO::PARAM_STR);
                $resultat->bindParam(':language', $_POST['language'], PDO::PARAM_STR);
                $resultat->bindParam(':storyline', $_POST['storyline'], PDO::PARAM_STR);
                $resultat->bindParam(':video', $_POST['video'], PDO::PARAM_STR);
            
                $succes = $resultat->execute();

                if($succes){
				        $message .= '<div>Le film a ete ajoute</div>';

			    } else{
				$message .= '<div>Une erreur est survenue lors de l\' enregistrement</div>';
			    }



        }//Fin if(empty($contenu))

    }//fin if($_POST)




















//--------------------AFFICHAGE--------------------------

echo '<p>' .$contenu . '</p>';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Et si on regardait un film ?</title>
</head>
<body>
    <h1>Votre film</h1>
    <section>
        <form method="post" action="">

            <article>
                <label for="title">Title</label>
                <input type="text" name="title" id="title">
            </article>
                <label for="actors">Actors</label>
                <input type="text" name="actors" id="actors">
            <article>
                <label for="director">Director</label>
                <input type="text" name="director" id="director">
            </article>
                <label for="producer">Producer</label>
                <input type="text" name="producer" id="producer">
            <article>
                <label for="year_of_prod">Year of production</label>
                <select  name="year_of_prod" id="year_of_prod">
                <?php 
				for($i=date('Y'); $i>=date('Y')-100; $i--) {
					echo "<option value=$i>$i</option>";
				} 
				?>
                </select>
            </article>
                <label for="language">Language</label>
                <select name="language" id="language">
                    <?php
                        foreach($language as $values)
                        echo "<option value=$values>$values</option>";
                    ?>  
                </select>
            <article>
                <label for="category">Category</label>
                <select name="category" id="category">
                    <?php
                        foreach($category as $values)
                        echo "<option value=$values>$values</option>";
                    ?>  
                </select>
            </article>
                <label for="storyline">Storyline</label>
                <input type="text" name="storyline" id="storyline">
            <article>
                <label for="video">Video</label>
                <input type="text" name="video" id="video">
            </article>
            <article>
                <input type="submit" value="Submit">
            </article>
           
      
        </form>   
    </section>

    <?php
    echo $message;
    ?>
</body>
</html>