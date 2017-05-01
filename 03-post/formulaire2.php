<?php
// creer le formulaire indique au tableau recuperer les donnees et les afficher dans la meme page

print_r($_POST);

if(!empty($_POST)){
    echo 'Ville :' . $_POST['ville'] . '<br>';
    echo 'Code postale :' . $_POST['codepostal'] . '<br>';
    echo 'Adresse :' . $_POST['adresse'] . '<br>'; //  attention les name sont sensible a la casse
} 



?>

<form method="post" action="">
    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville"><br>

     <label for="codepostal">Code Postal</label>
    <input type="text" id="codepostal" name="codepostal"><br>

    <label for="adresse">Adresse</label>
    <textarea  id="adresse" name="adresse"></textarea><br>
    <input type="submit" name="validation" value="validation">
</form>