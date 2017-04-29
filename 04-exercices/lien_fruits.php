<?php

// faire 4 liens   HTML avec le nom des fruits
// quand on clique sur un lien on affiche le prix pour 1000g de ce fruit, dans cette page lien_fruits.php

include('fonction.inc.php');

if(isset($_GET['fruit'])){ //les $_GET sont prexeistant, ce sont les indices que l on verifie

echo 'Fruit :' .$_GET['fruit'] . '<br>';

echo calcul($_GET['fruit'], 1000);

}



?>  

<h1>Nos fruits</h1>

<a href="lien_fruits.php?fruit=cerises">Cerises</a>
<a href="lien_fruits.php?fruit=bananes">Bananes</a>
<a href="lien_fruits.php?fruit=pommes">Pommes</a>
<a href="lien_fruits.php?fruit=peches">Peches</a>
