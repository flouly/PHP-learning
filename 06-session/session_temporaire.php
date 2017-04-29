<?php
// Contexte : souvent sur les sites bancaires, vous etes automatiquement au bout se 10 minutes

session_start(); // on cree une session

echo '<pre>'; print_r($_SESSION); echo '<pre>'; 
 if (isset($_SESSION['temps']) && isset($_SESSION['limit'])) {
    //  on verifie si les 10 seconde sont ecoulees
    if(time() > ($_SESSION['temps'] + $_SESSION['limit'])){
        session_destroy();
        echo '<hr> votre session a expire, vous etes deconnecte <hr>';
    } else{
        $_SESSION['temps'] = time(); // On remet a jour le temps
    }

 } else{ //on entre dans ce else la premiere fois pour remplir la session
     $_SESSION['temps'] = time(); //stamptime exorime en seconde
     $_SESSION['limit'] = 10; //  en seconde
     echo '<hr> vous etes connectez <hr>';
 }