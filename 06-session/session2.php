<?php
// Creation ou ouverture de la session
session_start(); // lorsque j effectue un session_start la session n est pas recreer car elle existe deja grace au session_start dans le fichier session1.php

echo 'La session est accesssible dans tout les scripts du site : ';
echo '<pre>'; print_r($_SESSION); echo '<pre>'; //Affiche le contenue de la session

// Ce fichier  session2.php n a rien a voir avec l autre, il ny a pas d inclusion pourtant il accede a la sesson en cours cree dans session1.php . Notez que cest l identifiant de la session envoye dans un cookie dans le poste de l internaute par session1.php  qui indique quelle session ouvrir dans session2.php

