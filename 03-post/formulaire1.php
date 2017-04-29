<?php
// **********************************
// La super globale $_POST
// **********************************
//$_POST est une superglobale et donc un array disponible dans tout le contexte du script

// C est une methide qui pertmrt de recuperer des informations issues d un formulaire

// Un formulaire esr obligatoi emefa dans des balises form, aves la designation des attributs method (pour get o u post) et action (qui indique le fichier  de destination des donnees deu formulaire).il contient un bouton  envoie


// les names constituent les indices du ARRAY   $_POST
print_r($_POST);

if(!empty($_POST)){ // not empty siginifie que l array  $_POSTn est  pa s vide , autrement dit que la formulaire a ete poste. Il peut cependant  avoair fete poste avec des champs vide :lea valeurs  de l array  $_POST  dosnt vides mais il ya bien les  indices 'prenom ' et 'description'.
  echo 'Prenom : ' . $_POST['prenom'] . '<br>';
echo 'Description : ' . $_POST['description'] . '<br>';
}

?>



<h1>Formulaire</h1>
<form method="post" action="">
    <label for="prenom">Prenom</label> <!--les for servent a lier  le label avec l id de  l input-->
    <input type="text" id="prenom" name="prenom"><br>

    <label for="description">Description</label>
    <textarea  id="prenom" name="description"></textarea><br>
    <input type="submit" name="validation" value="envoyer">
</form>