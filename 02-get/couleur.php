<?php

// Exercice

/*
Dans le fichier listeFruits.php : creer 3 liens banane. kiwi et cerise Quand on clicke sur les liens. passe le nom du fruit et afficher sa couleur

notez que vous ne passez pas la couleur dans l url mais vous la deduisez dans couleur.php
*/
print_r($_GET);

echo '<br>';

if (isset($_GET['fruit'])) {
    echo 'Fruit :' .$_GET['fruit'] . '<br>';

    if ($_GET['fruit'] == 'banane') {
        echo'Couleur du fruit : jaune <br>';
    } elseif ($_GET['fruit'] == 'kiwi'){
        echo'Couleur du fruit : vert <br>';
    } elseif ($_GET['fruit'] == 'cerise'){
        echo'Couleur du fruit : rouge <br>';
    } else{
        echo'Ce fruit n existe pas <br>';
    }

} else{
    echo'Aucun fruit selectionne';
}
?>