<?php

print_r($_POST);

if(!empty($_POST)){ //si le formulaire est soumis, il y a les indices correspondant aux names

    if (!empty($_POST['pseudo'])){
    echo 'Pseudo : ' . $_POST['pseudo'] .'<br>';  
    } else{
        echo 'Erreur sur le pseudo <br>';
    }
    echo 'Email : ' . $_POST['email'] .'<br>';
} 