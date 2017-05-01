<h1>Page detail des articles</h1>

<?php
// **********************************
// La super globale $_GET
// **********************************
// $_GET represente l url : il s agit d une superglobale d un ARRAY; supergloble signifie qu il est disponible dans tous les contexte du script, y compris dans les fonctions

// Les informations transitent dans l url de la maniere suivante :
// page.php?indice1=valeur1&indice2=valeur2
// Chaque indice de cet url correspondent a un indice de l array $_GET et sa valeur correspondante

//print_r($_GET);
if(isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET['prix'])){

echo 'Article :' . $_GET['article'] . '<br>';
echo 'Couleur :' . $_GET['couleur'] . '<br>';
echo 'Prix : ' . $_GET['prix'] . '<br>';
} else{
    echo 'Aucun article selectionne';
}