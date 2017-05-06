<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec les champs nom, prénom, téléphone, et un champ supplémentaire "autres infos" avec un lien qui permet d'afficher le détail de chaque contact.

	2- Afficher sous la table HTML le détail d'un contact quand on clique sur le lien "autres infos".



*/

$pdo = new PDO('mysql:host=localhost;dbname=contacts', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$resultat = $pdo->query("SELECT nom, prenom, telephone FROM contact");


echo '<table>';

	echo '<tr>';
			for($i = 0; $i < $resultat->columnCount(); $i++){
				$column = $resultat->getColumnMeta($i);

				echo '<th>' . $column['name'] . '</th>';
			}
		
	echo '</tr>';

	

			while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){

				echo '<tr>';
					echo '<td>' . $ligne['nom'] . '</td>';
					echo '<td>' . $ligne['prenom'] . '</td>';
					echo '<td>' . $ligne['telephone'] . '</td>';
					
					echo '<td><a href="?action=autre_info&nom=' .$ligne['nom']. '">Autres info</a></td>';
				echo '</tr>';
			}

	

echo '</table>';
