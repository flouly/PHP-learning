<?php 
// realiser un formulaire "pseudo" et "email" dans formulaire 3, en recuprerant et affichant les informations dans formulaire4

// De plus une fois e formulaire aiumis, vous verifiea que ke pseusdo  n estpas vide ai tel est le cas affichrer un  message d errreur a l'internaute'
?>
<!---->
<form method="post" action="formulaire4.php"> <!--action permet de preciser ke ficier de destination des infornations-->
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo"><br>

     <label for="email">Email</label>
    <input type="email" id="email" name="email"><br>

    <input type="submit" name="validation" value="valider">
</form>

