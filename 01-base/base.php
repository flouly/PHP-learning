<style>h2{font-size: 15px; color: red;} </style>

<?php

// -----------------
echo '<h2> Les balises PHP</h2>';
// ------------------
?>





<!--En dehors des balises PHP nous pouvons ouvrir du HTML-->
<strong>Bonjour</strong>

<?php

// -----------------
echo '<h2> Ecriture et affichage</h2>';
// ------------------

echo 'Bonjour'; // se termine par ; on peut mettre des balises dans echo , elles sont interpretees comme telles
echo '<br>';
print 'Nous sommes jeudi'; // Autre instruction d affichage

// print_r(); et var_dump();    autres instructions d affichage

// -----------------
echo '<h2> Variable : types / declaration / affectation</h2>';
// ------------------

// Definition : une variable est un espace memoire qui permet de conserver une valeur
// Declaration en PHP : signe $

$a = 127; // declare a et affecte la valeur 127
// son type est integer

$b = 1.5; // type double pour nombre a virgule

$a = 'une chaine de caracteres'; // type string 
$b = '127';

$a = true; // type boolean

// -----------------
echo '<h2> Concatenation </h2>';
// ------
$x = 'bonjour ';
$y = 'tout le monde';
echo $x . $y . '<br>'; // point de concatenation 

echo "$x $y <br>"; // meme resultat sans concatenation (cf chapitre d apres : evaluation des variablea entre guillemets)

// --------------------
// Concatenation lors de l affectation :
$prenom1 = 'Bruno'; // affectation et declaration
$prenom1 = 'Claire'; // la nouvelle valeur ecrase la valeur precedente

echo $prenom1 . '<br>';

$prenom2 = 'Bruno';
$prenom2 .= 'Claire'; // on affecte la valeur Claire a la variable prenom en l ajoutant a la valeur precedemment contenu dans la variable grace a l operateur .=
echo $prenom2 . '<br>'; // affiche BrunoClaire

// -----------------
echo '<h2> Guillemets et quotes </h2>';
// ------
$message = "aujourd'hui";
$message = 'aujourd\' hui'; // dans les quotes on echappe les apostrophes avec \

$txt = 'Bonjour';
echo "$txt tout le monde <br>"; // Les variables sont evaluees  quand elles sont presentes dans des guillemets, c est leur contenu qui est affiche
echo '$txt tout le monde <br>'; // on affiche litteralement le nom des variables : elles ne sont  pas evalues

// -----------------
echo '<h2> Constantes </h2>';
// ----------------

// Ne peut pas etre modifiee durant la duree du script. Tres utile pout garder de maniere certaine la connexion a une BDD ou le chemin du site par exemple.

define("CAPITALE", "Paris"); // En majuscule par convention. 

echo CAPITALE . '<br>';

// Constantes magiques :
echo_FILE_ . '<br>'; // affichage du chemin du fichier dans lequel on est..`
echo_LINE_ . '<br>';

// -----------------
echo '<h2> Operateurs arithmetiques </h2>';
// ----------------

$a = 10;
$b = 2;

echo $a + $b . '<br>';
echo $a - $b . '<br>';
echo $a / $b . '<br>';
echo $a % $b . '<br>'; // le reste de division entiere

// -------
//  Operations et affectations combinees :
$a += $b; // $a = $a + $b 12
$a -= $b; // 12 - 2 = 10
$a *= $b;
$a /= $b;
$a %= $b;

// ----------
// Incrementer et decrementer
$i = 0;
$i++;  // 1
$i--;

$k = ++$i; // la variable est incrementer de 1 puis elle est affecte a $k
echo $i .  '<br>'; // 1
echo $k .  '<br>'; // 1

$k = $i++; // la variable $i est  d abord affecter a $k puis incremente de 1
echo $i .  '<br>'; // 2
echo $k .  '<br>'; // 1

// -----------------
echo '<h2> Structures conditionnelles et operateurs de comparaison </h2>';
// ------------------

$a = 10; $b = 5; $c = 2;

if ($a > $b) { //si la condition est true
    echo '$a est  bien superieur a $b <br>';
} else{
    echo 'Non , c\' est $b qui est superieure a $a <br>';
}

// --------
if ($a > $b && $b > $c ){
    echo 'les 2 conditions sont vraies <br>';
}

// ------
if ($a == 9 || $b > $c){
    echo 'ok pour l\' une des 2 conditions <br>';
} else{
    echo 'les 2 conditions sont fausses <br>';
}

// ------
if ($a == 8){
    echo 'Reponse 1 <br>';
} elseif ($a != 10){
    echo 'Reponse 2 <br>';
} else {
    echo 'Reponse 3 <br>';
}

// ---------
if ($a == 10 XOR $b == 6) {
    echo 'ok pour la condition exclusive <br>';
} //si les 2 conditiona sont fausses ou vraies en meme temps alors pas ok; or exclusive

// ------------
// Conditions ternaires (forme contractee de la condition) :
echo ($a == 10) ? '$a est egal a 10 <br>': '$a est different de 10 <br>'; // ? represente le if ; le : -> else

// ------------
//  Different entre == et ===
$vara = 1;
$varb = '1';

if ($vara == $varb) {
    echo 'il y a egalite en valeur entre les 2 variables <br>';
}
if ($vara === $varb) {
    echo 'il y a egalite en valeur ET type entre les 2 variables <br>';
}

// ------------
// empty() et isset() :
// empty() : teste si c est vide ( c a d 0, '', NULL, false ou non defini)
// isset() : teste si c est  defini et a une valeur non NULL

$var1 =  0;
$var2 =  '';

if (empty($var1)) echo ' on a 0 , vide, ou non definie <br>';
if (isset($var2)) echo 'var2 existe bien <br>';

// empty sert utilise pour verifier qu un champs de formulaire soit rempli, isset permettra par  exemple de verifier l existence  d un indice dans un array avant de l'utiliser'

// phpinfo();

// -----------------
echo '<h2> Conditions  </h2>';
// ------------------
// entrer une valeur dans un variable sous condition (PHP7) :
$var1 = isset($maVar) ? $maVar : 'valeur par defaut';
echo $var1 . '<br>';

// En version PHP7 :
$var2 = $maVar ?? 'valeur par defaut';
echo $var2 . '<br>';

$var3 = $_GET['pays'] ?? $_GET['ville'] ?? 'pas d\'info';
echo $var3 . '<br>';
// -----------------
echo '<h2> Conditions switch </h2>';
// ------------------
// Dans le switch ci-dessous les "cases" representent les cas differents dans lesquels on peut potentiellement tomber
$couleur = 'jaune';

switch($couleur){
    case 'bleu' : echo 'Vous aimez le bleu'; break;
    case 'rouge' : echo 'Vous aimez le rouge'; break;
    case 'vert' : echo 'Vous aimez le vert'; break;
    default : echo 'Vous n\'aimez ni le bleu   ni le rouge ni le vert <br>';
}
// le switch compare a chaque case
// le default correspond a else

// Exercice
if ($couleur == 'bleu') {
    echo 'Vous aimez le bleu';
} elseif ($couleur == 'rouge') {
    echo 'Vous aimez le rouge';
} elseif ($couleur == 'vert'){
    echo 'Vous aimez le vert';
} else{
     echo 'Vous n\'aimez ni le bleu ni le rouge ni le vert <br>';
}

// -----------------
echo '<h2> Fonctions predefinies </h2>';
// ------------------
echo '<h2> Traitement des chaines de caracteres (strlen, strpos, substr </h2>';
$email1 = 'prenom@site.fr';

echo strpos ($email1, '@') . '<br>'; // 6
echo strpos ('Bonjour', '@'); //  Retourne un boolean (false) qui ne se voit pas dans la page
var_dump (strpos ('Bonjour', '@')); // var_dump permet de voir le boolean

// -------
$phrase = 'Mettez une phrase a cet endroit';
echo '<br>' . strlen($phrase) . '<br>'; // Affiche la longueur d une string

// --------
$texte = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores architecto aperiam perferendis fugit! Soluta rem laborum architecto rerum corporis impedit fugit ratione labore expedita tenetur, eaque omnis dolorem. Deserunt, itaque.';
echo substr ($texte, 0, 20) . '...<a href="">Lire la suite</a>'; // on decoupe une partie du texte et on lui ajoute un lien; echec retourne false

// ---------
echo  str_replace('site', 'gmail', $email1);

// -----------
$message = '           Hello world           ';
echo strtolower ($message) . '<br>';
echo strtoupper ($message) . '<br>';

echo strlen ($message) . '<br>';
echo strlen (trim($message)) . '<br>'; //trim permet de supprimer les espaces a la fin et au debut d un string


// -----------------
echo '<h2> Le manuel PHP en ligne </h2>';
// ------------------

// http://php.net/manuel/fr/

// -----------------
echo '<h2> Gestion des dates </h2>';
// ------------------
echo date('d/m/Y H:i:s') . '<br>'; // y pour l annee en 2 chiffres; H sur 24 /  h en pm et am

echo time() . '<br>'; // retourne le timestamp actuel = nombre de secondes ecoulees depuis le 01/01/1970 a 00:00:00 (creation theorique de UNIX)

// La fonction predefinie strtotime() :
$dateJour = strtotime('10-01-2016'); // retourne le timestamp de la date du 1er janvier 2016

echo $dateJour . '<br>';

// La fonction strftime () :
$dateFormat = strftime ('%Y-%m-%d', $dateJour); // transforme le timestamp donnees en date selon le format indique
echo $dateFormat . '<br>';

// Exemple de convertion de format de date :
// Transformer 23-05-2015 en 2015-05-23 :
echo strftime('%Y-%m-%d', strtotime('23-05-2015'));

echo '<br>';
// Transformer 2015-05-23 en 23-05-2015 :
echo strftime('%d-%m-%Y', strtotime('2015-05-23'));

// Cette methode de transformation est limitee dans le temps (2038)

// Autre methode
$date = new Datetime('11-04-2017');
echo '<br>';
echo $date->format('Y-m-d');
// Datetime est une classe que l on  peut comparer a un plan ou un modele qui sert a construire des objets "date".
// On construit un objet "date" avec le mot new, en indiquant la date qui nous interesse entre parentheses. $date est donc un objet "date"
// Cet objet beneficie des methodes (= fonctions) offertes par la classe; pour appeler cette methode on utilise "->"

// --------------------------------
echo '<h2> Les fonctions utilisateurs </h2>';
// -------------------------------
// Les fonctions non declarees et non executees par le langage

// Declaration d une fonction :
function separation (){
    echo '<hr>'; // fonction tirer un trait 
}

// Appel de la fonction 
separation (); // ici on execute la fonction

// -----------------
// Fonction avec arguments : les arguments sont des parametres fournis a la fonction
function bonjour ($qui){ // variable de reception qui apparait pour la 1er fois et recoit un argument
    return 'Bonjour ' . $qui . '<br>';
    echo 'cette ligne ne sera pas executee '; // Apres un return on quitte la fonction donc on execute pas le code qui suit
}

// Appel de la fonction
echo bonjour('Pierre');

$prenom = 'Etienne';
echo bonjour($prenom); // L argument peut etre une variable

// ----------------------
function appliqueTva($nombre){
    return $nombre * 1.2;
}
//  Remplacer la constante par une variable
function appliqueTva2($nombre, $taux){
    return $nombre * $taux;
}

echo appliqueTva2(100, 0.19) . '<br>'; // Les arguments ne sont pas optionnels, on ne peut pas redeclarer une fonction avec le meme nom

// ----------------------
// Exercice :
function meteo($saison, $temperature){
    echo "Nous sommes en $saison et il fait $temperature degre(s) <br>";
}

meteo('hiver', 2);
meteo('printemps', 2);

// Creer meteo2 qui permet d afficher au printemps lorsqu il s agit du printemps

function meteo2($saison, $temperature){

    if ($saison == 'printemps'){
        $article = 'au';
    } else{
        $article = 'en';
    }
    echo "Nous sommes $article $saison et il fait $temperature degre(s) <br>";
}

meteo2('printemps', 5);
meteo2('hiver', 4);

function meteo3($saison, $temperature){
   $article = ($saison == 'printemps') ?  'au' :  'en';
   echo "Nous sommes $article $saison et il fait $temperature degre(s) <br>";
}

meteo3('hiver', 4);

// -----------
// Exercice
function prixLitre(){
    return rand(1000,2000)/1000; // determine un prix aleatoire entre 1 et 2 
}

// Ecrivez la fonction  factureEssence() qui calcule le prix total de votre facturre d essence en fonction du nombre de litres que vous lui donnez. cette fonction retourne  la phrasse "Votre facture est de x euros pour Y litres d essence" (X t Y sont variables)
// Dans cette fonction  utilisez la fonction prixLitre() qui vous retourne le prix du litre d essence.

function factureEssence($Y){

    $E = prixLitre();
  
     $totalFacture = $Y * $E;
    

    echo "Votre facture est de $totalFacture euros pour $Y litres d essence <br>";
}


factureEssence(50);

// --------------------------------
echo '<h2> Les variables locales et globales </h2>';
// -------------------------------

function jourSemaine() {
    $jour = 'vendredi'; // nous sommes dans un espace LOCAL
    return $jour;
}

// A l exterieur de la fonction, je suis dans l espace GLOBAL

// echo $jour; // je ne peux pas utiliser une variable Locale dans l espace globale
echo jourSemaine() . '<br>'; //on peut cependant recuperer la valeur de $jour grace au return qui est au sein  de la fonction e t a l appel de cette fonction

// ---------
$pays = 'France'; // variable globale
function affichagePays(){
    global $pays;// global permet de recuperer une variable provenant de l espace global au sein de l'espace local de la fonction'
    echo $pays;
}

affichagePays();

// --------------------------------
echo '<h2> Les structures iteratives : boucles</h2>';
// -------------------------------
// boucle while
$i = 0; //valeur de depart de la boucle
while ($i < 3){
    echo "$i---";
    $i++; // on oublie pas d incrementer pour que la boucle ne soit pas infinie, il faut que la conditon puisse devenir false a un moment donne
}

echo '<br>';

$i = 0; //valeur de depart de la boucle
while ($i < 3){
    if($i == 2){
        echo "$i";
    } else{
        echo "$i---";
    }
    
    $i++; // on oublie pas d incrementer pour que la boucle ne soit pas infinie, il faut que la conditon puisse devenir false a un moment donne
}

echo '<br>';
// -------
// A l aide d une boucle while afficher dans les annees depuis l annee encours moins 100 ans et jusqu a l annee encours:
echo '<select>';
    $option = 1917;
    while ($option <= 2017){

        echo "<option>$option</option>"; // "" pour evaluer la variable  (echo '<option>' . $option . '</option>';)
        $option++;
    }
echo '</select>';

echo '<br>';

echo '<select>';
    $option = date('Y') - 100;
    while ($option <= date('Y')){

        echo "<option>$option</option>"; // "" pour evaluer la variable
        $option++;
    }
echo '</select>';

// -------------------------------
// boucle do while
// la boucle do while a la particularite de s executer  au moins une fois, puis tant que la condition de fin est vraie
echo '<br> Boucle do while<br>';

do{
    echo 'un tour de boucle';
} while (false); // on  met la condition pour executer les tours ici a la place de false. Dans ce cas precis on vois que l on effectue un tour de bloucle bien que la condition soit fausse.

// -------------------------------
// boucle for :
echo '<br>';
for ($j = 0; $j < 16; $j++){
    print $j . '<br>';
}

echo '<br>';
// Exercice:
// 1 faire une boucle qui affiche  0 a 9  sur la meme  ligne
// 2 faire la meme chose mais dans un tableau HTML
for ($i = 0; $i < 10; $i++){
    print $i .' ';
} 

echo '<table border = "1"><tr>';

for ($i = 0; $i < 10; $i++){
    echo "<td>$i</td>";
}
echo '</tr></table>';

echo '<br>';
// ------------------------------2
echo '<table border = "1">';
    $i = 0;
    while($i < 10) {
        echo " <tr>";

        for ($j = 0; $j < 10; $j++){
            echo "<td>$j</td>";
        }
        $i++;  
          echo "</tr>";
    }
echo '</table>';

echo '<br>';

echo '<table border = "1">';
    // on fait une boucle pour les lignes
    $i = 0;
    for ($i = 0; $i < 10; $i++){
        echo " <tr>";

            for ($j = 0; $j < 10; $j++){
                echo "<td>$j</td>";
            } 
        echo "</tr>";
    }
echo '</table>';

// ------------------------
echo '<br>';

// --------------------------------
echo '<h2> Les arrays ou tableaux</h2>';
// -------------------------------
// on peut stocker dans un array une multitude de valeurs, quelque soit leur type
$liste = array('gregoire', 'nathalie', 'emilie', 'francois','georges');

echo $liste; //erreur car on ne peut pas afficher directement le contenu d un array

echo '<br>';

echo '<pre>' ; var_dump($liste); echo '</pre>';

echo '<br>';

echo '<pre>' ; print_r($liste); echo '</pre>'; // <pre> sert a mettre en forme

// Autre moyen d affecter des valeurs dans un tableau :
$tab[] = 'France'; //permet  de remplir le tableau
$tab[] = 'Italie';
$tab[] = 'Espagne';
$tab[] = 'Portugal';

print_r($tab);

echo '<br>';
echo $tab[1];

echo '<br>';

// Tableau associatif : tableau dont les indices sont litteraux
$couleur = array("j" => "jaune", "b" => "bleu", "v" =>"vert" );

echo 'la seconde couleur de notre tableu est le'. $couleur ['b'] . '<br>';
echo "la seconde couleur de notre tableu est le $couleur [b] <br>"; //un array ecrit dans des guillemets perd ses quotes autour de son indice

// --------------
// Mesurer la taille d un array
echo 'Taille du tableau : ' . count($couleur) .  '<br>';

echo 'Taille du tableau : ' . sizeof($couleur) . '<br>';

// --------------
// Transformer un array  en string :
$chaine = implode('-', $couleur); // separateur "-"

echo $chaine . '<br>';

$couleur2 = explode('-', $chaine);

print_r($couleur2) ;

// --------------------------------
echo '<h2> La boucle foreach pour parcourir les arrays</h2>';
// -------------------------------
// La boucle est un moyen pour passer en revue un tableau. Elle fonctionne uniquement sur les arrays et les objets. Et elle a l avantage d etre automatique s arretant quand il n y a plus d elements
foreach($tab as $valeur){ //La variable $valeur recupere a chaque tour de boucle les valeurs  qui sont parcourues dans l array $tab
    echo $valeur . '<br>';
}

foreach($tab as $indice => $valeur){
    echo $indice . ' correspond a ' . $valeur . '<br>';
} //On recupere les indices  qui donne leur valeur correspondante (On peut appeler les variables comme on veut)

// --------------------------------
echo '<h2> Les arrays multidimentionnels</h2>';
// -------------------------------
// Tableaux contenus dans un tableau

// Creation d un tableau multidimensionnel
$tab_multi = array(
    0 => array('prenom' => 'Julien', 'nom' => 'Dupont', 'telephone'=> '06 00 00 00'),
    1 => array('prenom' => 'Pore', 'nom' => 'Durant', 'telephone'=> '06 00 00 00'),
    2 => array('prenom' => 'Pierre', 'nom' => 'Drew')
);

echo '<pre>';  print_r($tab_multi);  echo '<pre>';

// Acceder a la valeur Julien
echo $tab_multi[0]['prenom'] .'<br>';
echo '<br>';

// Parcourir le tableau multidimensionnel avec une boucle for :
for ($i = 0; $i < count($tab_multi); $i++){
    echo $tab_multi[$i]['prenom'] .'<br>';
}
echo '<br>';
// Afficher les prenoms avec une boucle foreach

foreach($tab_multi as $valeur){
    echo $valeur['prenom'] . '<br>';
};
echo '<br>';

foreach($tab_multi as $indice => $valeur){
    echo $tab_multi [$indice]['prenom'] . '<br>';
};

// --------------------------------
echo '<h2> Les inclusions de fichiers</h2>';
// -------------------------------
echo 'premiere inclusion';
include('exemple.inc.php');// On inclut le fichier dont le chemin est specifie

echo 'deuxieme inclusion';
include_once('exemple.inc.php'); // N apparait pas car deja appelle

echo 'troisieme inclusion';
require('exemple.inc.php');// inclusion obligatoire, genere une erreur de type fatal s il ne parvient pas a executer le script(include ne genere qu un warning)

echo 'quatrieme  inclusion';
require_once('exemple.inc.php');//on verifie si le fichier n est pas deja inclu*/

// le ".inc" est la par convention

// --------------------------------
echo '<h2> Introduction aux objets</h2>';
// -------------------------------

// Un objet rdt un autre type de donnees Un objet est issu d une classe qui possede des attributs(ou propriete)  et des methodes

// l objet a partier dune classe peut acceder a ces attribut et ces methodes

// example avec un personnge de type 'Etudiant'
class Etudiant {
    public $prenom = 'Julien'; // public l element est accessible partout

    public $age = 25;

    public function pays() { //methode appelee pays
        return 'France';
    }
}

$objet = new Etudiant(); // New permet de creer une nouvelle instance de la class Etudiant

echo '<pre>'; print_r($objet); echo '<pre>';

// afficher le prenom de l etudiant $objet

echo $objet->prenom .'<br>';

// Afficher le pays via la methode pays() :
echo $objet->pays().'<br>'; 

// Context :sur un site une classe panier cntiendra led proprietes et les methodes necessaires au fonctionnement du panier d achat :
class Panier {
    public function ajout_article($article) {

        return " L article $article a  ete ajoute au panier <br>" ;
    }
}

// Lorsfque on clique sur le bouton "ajouter au panier"
$panier = new panier(); // on creer un panier vide dans un premier temps
echo $panier->ajout_article('Pull');

// ********************************************************************************************