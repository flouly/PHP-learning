<?php
// ***************************
// PDO
// ****************************
//  L EXENSION PHP  data object (PDO) Defini un interface pour acceder a une base de donnees depuis PHP

// ****************************
// 01. Connexion
// ****************************

echo '<h1> 01.Connection</h1>';

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); // PDO Class predefinie

/* Les arguments passes a PDO :
//         DRIVER + serveur + nom de la base de donnees
//          pseudo du SGBD
            mdp du SGBD
            options option 1 pour generer l ffichage des erreurs, option 2 = commande a executer lors de lsa connexion au serveur qui definit le jeu de caracteres des echanges avec la BDD
*/

print_r($pdo);
echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>';// Permet d afficher les methodes disponibles dans l objet $pdo

// ****************************
// 02. exec() avec INSERT, UPDATE ET DELETE
// ****************************
echo '<h1>02. exec() avec INSERT, UPDATE ET DELETE</h1>';

// $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('Jean', 'Tarte', 'm', 'informatique', '2017-04-25', 300) ");

/* exec est utilise pour formuler des requetes ne retournant pas de jeu de resultat: INSERT, UPDATE ET DELETE

valeur de retour
succes : un integer correspondant au nombre de lignes affectes
echec : false
*/

// echo "Nombre  d enregistrements affectes par l'INSERT : $resultat <br>";

echo 'Dernier id genere : ' . $pdo->lastInsertId();

// *******
$resultat = $pdo->exec("UPDATE employes SET salaire = 6000 WHERE id_employes = 350");

echo "Nombre  d enregistrements affectes par l'INSERT : $resultat <br>";

// ****************************
// 03. query() avec SELECT + fetch
// ****************************

echo '<h1>03. query() avec SELECT + fetch</h1>';

/*
Au contraire d exec(), query() est utilise pour la formulation de requetes retournant un ou plusiuers resultats :  SELECT 

VALLEUR RETOUR 
succes :objet PDOStatement
echec : false
*/

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'laura'");
echo '<pre>'; print_r($result); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($result)); echo '</pre>'; //on voit les nouvelles methoddes de Pdoststement

// $result constitue le resultat de LA requete  sous une forme inexploitable directement: il faut donc le transformer par la methode fetch()

$employe = $result->fetch(PDO::FETCH_ASSOC);// la methode permet  de transformer  l objet  $result en un ARRAY  associatif exploitable indexe avec le nom des champs de la requete

echo '<pre>';  print_r($employe);  echo '</pre>';
echo "Bonjour je suis  $employe[prenom] $employe[nom] $employe[service] <br>"; // les ' ' tombent avec les""

// ou encore faire un fetch avec l une des requetes suivantes
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'laura'");
$employe = $result->fetch(PDO::FETCH_NUM); //pour otenir un array indexe numeriquement
echo '<pre>';  print_r($employe);  echo '</pre>';

echo $employe[1]; 
// ---------
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'laura'");
$employe = $result->fetch();// pour un melange de fetch_assoc et fetch_num
echo '<pre>';  print_r($employe);  echo '</pre>';

// ------------
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'laura'");
$employe = $result->fetch(PDO::FETCH_OBJ);// RETOURNE un nouvel objet avec les noms de champs attributs(proprietes) public
echo '<pre>';  print_r($employe);  echo '</pre>';
echo $employe->prenom;

// Attention il faut choisir l un des fectch que vous voulez executer sur un jeu de resultat , vous ne pouvez pas faire plusieur fetch sur le meme resultat n en contenant qu une seule. en effet cette  methode deplace  un curseur de lecture sur le resultat suivant contenu dans le jeu de resultats: ainsi quand il n y en a q un , on sort du jeu

// Aficher le service de l employe Laura:

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'laura'");
$employe = $result->fetch(PDO::FETCH_OBJ);
echo '<pre>';  print_r($employe);  echo '</pre>';
echo $employe->service;

$result = $pdo->query("SELECT service FROM employes WHERE prenom = 'laura'");
$employe = $result->fetch();// pour un melange de fetch_assoc et fetch_num
echo '<pre>';  print_r($employe);  echo '</pre>';
echo $employe[0];

// ****************************
// 04. while et fetch_assoc
// ****************************

echo '<h1>04.while et fetch_assoc</h1>';

$resultat = $pdo->query("SELECT * FROM employes ");

echo ' Nombres d employes : ' . $resultat->rowCount() . '<br>';

while ($contenu = $resultat->fetch(PDO::FETCH_ASSOC)) { //fetch retourne la ligne suivante du jeu de resultat en array asssociatif. la boucle while permet de faire avance le curseur dans le jeu de resultat et s arrete a la fin des resultats
     //echo '<pre>';  print_r($contenu);  echo '</pre>';//$contenu est un array  associatif qui contient les donnees de chaque ligne du jeu de resultats.le nom des indices correspondent aux nom des champs

     echo $contenu['id_employes'] . '<br>';
     echo $contenu['prenom'] . '<br>';
     echo $contenu['nom'] . '<br>';
     echo $contenu['sexe'] . '<br>';
     echo $contenu['service'] . '<br>';
     echo $contenu['date_embauche'] . '<br>';
     echo $contenu['salaire'] . '<br>';
     echo  '__________________<br>';
}
// quand on a une demande avec un seul resultat on a pas besoin du while, en effet on a besoin de while pour parcourur les resultats

// ****************************
// 05. fetchAll
// ****************************
echo '<h1>05. fetch_all</h1>';

$resultat = $pdo->query("SELECT * FROM employes ");

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
//tableau multidimentionnel sans faire de boucle :vous avez un array associatif a chaque indice

echo '<pre>';  print_r($donnees);  echo '</pre>';

// Pour lire le contenu d un array multidimentionnel nous faisons des boucles foreach imbriques :
echo '<strong>Doubleboucle foreach </strong> <br>';

foreach ($donnees as $contenu) {
    foreach($contenu as $indice => $valeur) {
    echo $indice . '  correspond a  ' . $valeur . '<br>';
    }
    echo  '__________________<br>';
}

// ****************************
// 06. Exercices
// ****************************
echo '<h1>06. Exercices</h1>';

// Afficher la liste des bases de donnees presentent sur votre SGBD dans un liste ul li

$resultat = $pdo->query("SHOW DATABASES");

echo '<ul>';
    while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {

        echo'<li>';
            echo $donnees['Database'];
        echo'</li>';
    }
echo '</ul>';
        // -------------------
$resultat = $pdo->query("SHOW DATABASES");
$liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';  print_r($liste);  echo '</pre>';

echo 'Ma liste de bases de donnees :';
echo '<ul>';
foreach ($liste as $contenu){
    
    foreach($contenu as $indice => $valeur){      
        echo " <li>$valeur</li> ";
    }
}
echo '</ul>';

// ****************************
// 07. Tables HTML
// ****************************
echo '<h1>07. Tables HTML</h1>';

$resultat = $pdo->query("SELECT * FROM employes ");

echo '<table border = "1">';

    echo '<tr>';
        for($i = 0; $i < $resultat->columnCount(); $i++){
            echo '<pre>'; print_r($resultat->getColumnMeta($i));  echo '<pre>';//Pour voir ce que retourne get_____; un array notemment avec l indice du champs
            $colonne = $resultat->getColumnMeta($i); //array qui contient l indice name

            echo '<th>' . $colonne['name'] . '</th>';
        }
    echo '</tr>';

    // Afficher les autres lignes
    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
            foreach($ligne as $information){
                echo '<td>' . $information  . '</td>';
            }
        echo '</tr>';
    }
echo '</table>';

// ****************************
// 08. Requetes preparees: prepare() + bindParam() + execute()
// ****************************
echo '<h1>08.Requetes preparees() + bindParam() + execute()</h1>';


$nom = 'sennard';

// preparation de la requete
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom "); // on prepare la requete sans l execute, avec un  marqueur nominatif  ecrit :nom

// ON donne une valeur au marqueur :nom
$resultat->bindParam(':nom', $nom, PDO::PARAM_STR); //je lie le marqueur :nom a la variable $nom. Si on change le contenu de la variable. ls valeur du marqueur changera  automatiquement si on fait plusieurs execute

//On execute la requete
$resultat->execute();

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo implode($donnees, ' - ');

/*prepare() renvoie toujours un objet PDOStatement
execute() renvoie :
    succes : un objet PDOStatement
    echec : false

les requetes preparees sont a preconniser si vous avez plusieurs fois  la meme requete par exemple dans une boucle et ainsi eviter le cycle complet 

aussi poour assainir les donnees en forcant le type de valeur communiques aux marqueur */

// ****************************
// 09. Requetes preparees: prepare() + bindValue() + execute()
// ****************************
echo '<h1>09.Requetes preparees() + bindValue() + execute()</h1>';

$nom = 'Thoyer';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom "); 

// on lie le marqueur a une valeur
$resultat->bindValue(':nom', $nom, PDO::PARAM_STR);// bindValue recoit une variable ou un string, le marqueur pointe uniquement vers la valeur. Si celle ci change il faudra faire un nouveau bindValue pour prendre encompte la nouvelle valeur

// execute
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo implode($donnees, ' - ');


//Si on change la  valeur de la variable nom sans faire un nouveau bindValue, la requete pointe toujours sur la valeur Thoyer
$nom = 'Durand';

$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo implode($donnees, ' - ');

// ****************************
// 10. exercice
// ****************************
echo '<h1>exercice</h1>';

//Afficher dans une liste les livres empruntes par Benoit (il y en plusieurs.. ) en utilisant une requete preparee

//Connection a la base de donnee
$pdo = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//preparation
 $prenom = 'Benoit';

 $resultat = $pdo->prepare("SELECT l.titre FROM livre l INNER JOIN emprunt e ON l.id_livre = e.id_livre INNER JOIN abonne a ON a.id_abonne = e.id_abonne WHERE a.prenom = :prenom "); 

 $resultat->bindParam(':prenom', $prenom, PDO::PARAM_STR); //on peut aussi avoir PDO::PARAM_INT  ou  PDO::PARAM_BOOL

// execution
$resultat->execute(); // on obtient un objet de la  classe PDOStatement



// le fetch
echo '<ul>';
while ($livre = $resultat->fetch(PDO::FETCH_ASSOC)){
    //echo '<pre>'; print_r($livre); echo '</pre>';
    echo " <li>$livre[titre]</li>"; //le titre est passe de colonne de table de base de donnees a un indice d un array associatif
}
echo '</ul>';

// ****************************
// 11. FETCH_CLASS
// ****************************
echo '<h1>11. FETCH_CLASS</h1>';

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

Class Employes {
    public $id_employes;
    public $prenom;
    public $nom;
    public $sexe;
    public $service;
    public $date_embauche;
    public $salaire; //autant de proprietes que de champs
}

$result = $pdo->query("SELECT * FROM employes");

$donnees = $result-> fetchAll(PDO::FETCH_CLASS, 'employes');

echo '<pre>'; print_r($donnees); echo '</pre>';

foreach ($donnees as $employe) { //$employe peut s appeler comme on veut on pourrait mettre $var
    echo $employe->prenom . '<br>';
}

// ****************************
// 12. Points complementaires
// ****************************
echo '<h1>12. Points complementaires</h1>';

// ________________
echo '<br><strong>Le marqueur "?" </strong><br>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom =? AND prenom = ?"); // les variables remplace par le marqueur "?"

$resultat->execute(array('durand','damien'));// durand va remplacer le premier  ? et damien le second

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);// pas de boucle car un seul resultat

echo implode($donnees,' - '); // nous faisons implode lpour aller plus vite et eviter de faire un affichage en boucle

//_______________
echo '<br><strong>on peut faire un execute () sans bindParam() </strong><br>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");
$resultat->execute(array('nom' => 'durand', 'prenom' =>'damien'  ));//nous ne sommes pas obliges demettre les ":" devant les marqueurs

echo implode($donnees,' - ');

//_______________
echo '<br><strong>Afficher une erreur de requete SQL </strong><br>';

$resultat = $pdo->prepare("SELECT * FROM azerty WHERE nom = 'durand' ");
$resultat->execute();
echo '<pre>';   print_r($resultat->errorInfo()); echo '</pre>';//errorInfo est une methode de la classe PDOStatement at qui fournit des infos  sur l erreur SQL on trouve l erreur a lindice 2  de l array retourne par cette methode

// ****************************
// 13. Mysqli
// ****************************
echo '<h113. Mysqli</h1>';

//Il existe une autre maniere de se connecter a une base de dommees et d effectuer  des requetes sur celle ci

// Connexion a la BDD
$mysqli = new Mysqli('localhost', 'root', 'root', 'entreprise');

$requete = $mysqli->query("SELECT * FROM employes");//proprietes et methodes differentes de PDO. on ne peut  pas melanger les uns avec les autres

// *****************************************************************************************
