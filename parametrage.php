<!doctype html>
<html lang="fr">
 <title>Paramétrage</title>
 <?php include('header.php'); 
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["id_salarie"]) || !isset($_SESSION["responsable"]) || !isset($_SESSION["comptable"])){
    header("Location: index.php");
    exit(); 
    }
    if($_SESSION["comptable"] != 1 ) {
        echo '<div class="alert m-5 alert-danger" role="alert">
        Vous n\'êtes pas autorisé
        </div>';
    exit(); 
    }
   if($_SESSION["responsable"] == 1 ) {
      echo '<div class="alert m-5 alert-danger" role="alert">
      Vous n\'êtes pas autorisé
      </div>';
   exit(); 
   }
?>
	
   <body>
   <div class="container my-5 w-25 text-center ">
      <h3 class="my-3">Paramétrage de l'application</h3>

      <?php
    require("config.php");
        
      // Connexion à la base de données avec PDO
      try {
         $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
         echo "Erreur de connexion à la base de données : " . $e->getMessage();
         exit();
      }


      ?>
     
      <form name="indemnité" method="post" action="updateParametrage.php">
      <div class="form-outline mb-4">
			<label class="form-label" for="indemKm" style="font-size:smaller; ">Remboursement au kilométrage :</label>
			<input type="text" name="indemKm" style="margin-right:10px"class="form-control text-center">
		</div>
				
		<div class="form-outline mb-4">
			<label class="form-label" for="indemJour" style="font-size:smaller; ">Indemnité d'hebergement journalié :</label>
			<input type="number" name="indemJour" style="margin-right:10px"class="form-control text-center">
		</div>
      <input type="submit" class="btn btn-sm btn-outline-dark" placeholder="Modifier">
      </form>
      </div>

      <div class="container justify-content-between my-5">
      <hr class="my-5">
   <div class="row">
      <div class="col">
         <div class="container text-center">
            <h3 class="my-3">Ajouter une distance</h3>
            <form name="indemnité" method="post" action="insertTrajet.php">
               <div class="form-outline mb-4">
               <label class="form-label" for="commune1" style="font-size:smaller;">De :</label>
                  <select name="commune1" class="form-select">
                     <option value="">Sélectionner une commune</option>
                     <?php
                     
                     $query = $pdo->query("SELECT * FROM commune ORDER BY comNom");
                     while ($commune = $query->fetch()) {
                           echo '<option value="'.$commune['comId'].'">'.$commune['comNom']. ' ('.$commune['comCp'].')'.'</option>';
                     }
                     ?>
                  </select>
               </div>
                     
               <div class="form-outline mb-4">
                  <label class="form-label" for="commune2" style="font-size:smaller; ">A :</label>
                  <select name="commune2" class="form-select">
                     <option value="">Sélectionner une commune</option>
                     <?php
                     
                     $query = $pdo->query("SELECT * FROM commune ORDER BY comNom");
                     while ($commune = $query->fetch()) {
                           echo '<option value="'.$commune['comId'].'">'.$commune['comNom']. ' ('.$commune['comCp'].')'.'</option>';
                     }
                     ?>
                  </select>
               </div>

               <div class="form-outline mb-4">
                  <label class="form-label" for="distance" style="font-size:smaller; ">Distance en km :</label>
                  <input type="number" name="distance" style="margin-right:10px"class="form-control">
               </div>

               <input type="submit" class="btn btn-sm btn-outline-dark" placeholder="Ajouter">
            </form>
         </div>
      </div>

      <div class="col">
         <div class="container">
            <table class="table table-striped text-center table-responsive{-sm|-md|-lg|-xl} rounded-2">
               <thead>
                  <tr>
                     <th>De </th>
                     <th>à</th>
                     <th>Distance</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $stmt = $pdo->prepare("SELECT depart.comNom as De, arrive.comNom as A, trajet.distance, trajet.id_arrive_com, trajet.id_debut_com FROM trajet, commune as depart, commune as arrive WHERE trajet.id_debut_com = depart.comId AND trajet.id_arrive_com = arrive.comId; ");
                  $stmt->execute();
                  
                  while ($row = $stmt->fetch()) {
                     echo ('<tr><td>' . $row["De"] . '</td>
                     <td>' . $row["A"] . '</td>
                     <td>' . $row["distance"] .' Km'. '</td></tr>');
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <hr class="my-5">
   </div>
</div>

   
      
        
        

      
	
<?php //include('footer.php'); ?>
       
