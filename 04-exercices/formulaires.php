<?php

// 1 realiser un formulaire permettant de selectionner un fruit dans un selecteur, et de saisir un poids  quelconque  exprime en grammes
// 2faire le traitement du formulaire pour afficher le  prix du fruit choisi selon le poidx indique, en passsant par la fonction calcul
// 3 faire en sorte de garder le fruit choisi et le poids saisi dans les champs du formulaire.

include('fonction.inc.php');

if (!empty($_POST)){
    echo calcul($_POST['fruit'], $_POST['poids']);
}



?>


<form method="post" action="formulaires.php">

<select name="fruit" >

    <option value="null">selectionnez</option>
    <option value="cerises" <?php if (isset($_POST['fruit']) && $_POST['fruit'] == 'cerises') echo 'selected'; ?>>Cerises</option>
    <option value="pommes" <?php if (isset($_POST['fruit']) && $_POST['fruit'] == 'pommes') echo 'selected'; ?>>Pommes</option>
    <option value="peches" <?php if (isset($_POST['fruit']) && $_POST['fruit'] == 'peches') echo 'selected'; ?>>Peches</option>
    <option value="bananes" <?php if (isset($_POST['fruit']) && $_POST['fruit'] == 'bananes') echo 'selected'; ?>>Bananes</option>
</select>


<input type="text" name="poids" placeholder="poids en grammes" value="<?php echo $_POST['poids'] ?? ''; ?>">

<input type="submit" value="Calculer">


</form>