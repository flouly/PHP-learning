<?php 
// realiser un formulaire "pseudo" et "email" dans formulaire 3, en recuprerant et affichant les informations dans formulaire4

// De plus une fois le formulaire soumis, vous verifiez que le pseusdo  n est pas vide, si tel est le cas affichrer un  message d erreur a l'internaute'
?>
<!---->
<form method="post" action="formulaire4.php"> <!--action permet de preciser le ficier de destination des infornations-->
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo"><br>

     <label for="email">Email</label>
    <input type="email" id="email" name="email"><br>

    <input type="submit" name="validation" value="valider">
</form>

