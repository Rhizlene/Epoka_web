<!doctype html>
<html lang="fr">
 <title>Validation des missions</title>
 <?php include('header.php'); 
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
    if(!isset($_SESSION["id_salarie"]) || !isset($_SESSION["responsable"])){
        header("Location: index.php");
    exit(); 
    }
    if($_SESSION["responsable"] != 1 ) {
        echo '<div class="alert m-5 alert-danger" role="alert">
        Vous n\'êtes pas autorisé
        </div>';
    exit(); 
    }
?>
	
<body>
    <div class="container my-5">
        <h3 class="my-3">Validation des missions de vos subordonnés</h3>

        <?php
        $host = 'localhost';
        $dbname = 'epoka_mission';
        $username = 'root';
        $password = 'root';
        
        // Connexion à la base de données avec PDO
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit();
        }

        $id_salarie = $_SESSION['id_salarie'];

        $stmt = $pdo->prepare("SELECT salarie.nom_salarie, salarie.prenom_salarie, mission.debut, mission.fin, commune.comNom, commune.comCp, mission.id_mission, mission.valid FROM salarie, mission, commune WHERE salarie.id_responsable = :id_salarie AND mission.id_salarie = salarie.id_salarie AND mission.id_commune = commune.comId ORDER BY mission.debut ");
        $stmt->execute(array(':id_salarie' => $id_salarie));
    
        echo ('<table class="table table-striped text-center table-responsive{-sm|-md|-lg|-xl} rounded-2">
        <thead>
            <tr>
                <th>Nom du salarié</th>
                <th>Prénom du salarié</th>
                <th>Début de la mission</th>
                <th>Fin de la mission</th>
                <th>Lieu de la mission</th>
                <th>Validation</th>
            </tr>
        </thead>
        <tbody>');
     
        while ($row = $stmt->fetch()) {
      
                        

            if ($row['valid'] == 0) {
                $validation = '<td>
                <form action="updateValid.php" method="post">
                <button value="'.$row["id_mission"].'" name="valider" type="submit" class="btn btn-sm btn-outline-dark">Valider</button>
                </form>';
            }
            else {
                $validation = '<td>Validée';
            }
        
            echo ('<tr><td>' . $row["nom_salarie"] . '</td>
            <td>' . $row["prenom_salarie"] . '</td>
            <td>' . $row["debut"] . '</td>
            <td>' . $row["fin"] . '</td>
            <td>' . $row["comNom"] . ' ('. $row["comCp"] .')</td>'.$validation.'</tr>');
        }
        echo ('</tbody></table>');
				
        ?>

        
        </table>
    </div>

  
    <?php include('footer.php'); ?>
       

    