<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ma Boutique</title>
    <!--les liens bootstrap-->
    <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/bootstrap.min.css';  ?>">

    <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/shop-homepage.min.css';  ?>">

     <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/portfolio-item.min.css';  ?>">

     <script src="<?php echo  RACINE_SITE . 'inc/js/jquery.js' ?> "></script>

     <script src="<?php echo  RACINE_SITE . 'inc/js/bootstrap.min.js' ?> "></script>
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
    
        <div class="container"  >

            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"> </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>  
                </button>

                <a class="navbar-brand" href="<?php echo RACINE_SITE . 'boutique.php'; ?>">Ma Boutique</a>
               
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                        <?php
                            echo ' <li>  <a  href="'.  RACINE_SITE  .'boutique.php">Boutique </a></li>';

                            if(internautEstConnecte()) { //si membre est connecte

                            echo ' <li>  <a  href="'.  RACINE_SITE  .'profil.php">Profil </a></li>';

                            echo ' <li>  <a  href="'.  RACINE_SITE  .'connexion.php?action=deconnexion" > Se deconnecter</a></li>';
                            } else {

                                echo ' <li>  <a  href="'.  RACINE_SITE  .'inscription.php">Inscription </a></li>';

                                echo ' <li>  <a  href="'.  RACINE_SITE  .'connexion.php">Connexion</a></li>';

                            }

                            echo ' <li>  <a  href="'.  RACINE_SITE  .'pannier.php">Pannier</a></li>';

                            //Menu admin:
                            if(internautEstConnecteEtAdmin()) {

                                    echo ' <li>  <a  href="'.  RACINE_SITE  .'admin/gestion_boutique.php"> Gestion de la boutique</a></li>';

                                    echo ' <li>  <a  href="'.  RACINE_SITE  .'admin/gestion_commande.php">Gestion des commandes</a></li>';

                                    echo ' <li>  <a  href="'.  RACINE_SITE  .'admin/gestion_membre.php">Gestion des membres</a> </li>';

                            }
                        ?>         
                </ul>
   
            </div>
               
        </div><!--/container--> 
    </nav>  

    <div class="container" style="min-height: 80vh; padding-top:75px;">
    <!--ici contenue specifique de chaque page -->
    

