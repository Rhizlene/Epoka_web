<!doctype html>
<html lang="fr">
 <title>Accueil</title>
 <?php include('header.php'); 
   session_start();?>

 <body>


        
        <div class="alert m-5 alert-success" role="alert">
            Vous êtes connecté !
        </div>
        
        <h1 class="text-center font-weight-light">Bienvenue <?php echo  $_SESSION['prenom_salarie'] . ' ' . $_SESSION['nom_salarie']; ?></h1>
    
 <?php include('footer.php'); ?>
	