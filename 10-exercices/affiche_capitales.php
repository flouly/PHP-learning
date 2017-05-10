<?php
/* 
   Vous créez un tableau PHP contenant les pays suivants : France, Italie, Espagne, inconnu, Allemagne auxquels vous associez les valeurs Paris, Rome, Madrid, blablabla, Berlin.

   Vous parcourez ce tableau pour afficher la phrase "La capitale X se situe en Y" dans un paragraphe (où X remplace la capitale et Y le pays).

   Pour le pays "inconnu" vous afficherez "Ca n'existe pas !" à la place de la phrase précédente. 	
*/

//Tableau PHP
$capitale = array('France' => 'Paris', 'Italie' => 'Rome', 'Espagne' => 'Madrid', 'inconnu' =>'blabla', 'Allemagne' => 'Berlin');


//Tableau HTML
    echo '<table>';
              
            echo "<tr>";
                  foreach($capitale as $indice => $valeur){   
                        echo "<th>$indice</th>";
                  }
            echo"</tr>";
            
            echo "<tr>";               
                foreach($capitale as $indice => $valeur){   
                        echo "<td>$valeur</td>";
                  }
            echo"</tr>";

    echo '</table>';



    foreach($capitale as $indice => $valeur){

        if($indice == 'inconnu'){
            echo 'Ca n\'existe pas !<br>';
        } else{
            echo 'La capitale  ' .$indice.'  se situe en  '.$valeur .' <br>';
        }

    }









