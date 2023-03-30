<!doctype html>
<html lang="fr">
 <title>Validation des missions</title>
 <?php include('header.php'); 
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["id_salarie"])){
    header("Location: index.php");
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
    
        
     
        while ($ligne = $stmt->fetch()) {
            echo ('<table id="tableValid" class="table table-striped table-responsive{-sm|-md|-lg|-xl}">
            <tead class="">
                <td>Nom du salarié</td>
                <td>Prenom du salarié</td>
                <td>Debut de la Mission</td>
                <td>Fin de la Mission</td>
                <td>Lieu de la Mission</td>
                <td>Validation</td>
            </thead>
						<tbody>');
                        foreach ($stmt->fetchAll() as $ligne) {

                            if ($ligne['valid'] == 0) {
                                $validation = '<td>
                                <form action="updateValid.php" method="post">
                                <button value="'.$ligne["id_mission"].'" name="valider" type="submit" class="btn btn-sm btn-outline-dark">Valider</button>
                                </form>';
                            }
                            else {
                                $validation = '<td>Validée';
                            }
        
                            echo ('<tr><td>' . $ligne["nom_salarie"] . '</td>
                            <td>' . $ligne["prenom_salarie"] . '</td>
                            <td>' . $ligne["debut"] . '</td>
                            <td>' . $ligne["fin"] . '</td>
                            <td>' . $ligne["comNom"] . ' ('. $ligne["comCp"] .')</td>'.$validation.'</tr>');
                        }
                        echo ('</tbody></table>');
				};
        ?>

        
        </table>
    </div>

  
    <?php include('footer.php'); ?>
       

    <!--  SELECT depart.ComNom as nomComDepart, arrive.ComNom as nomComArrive, trajet.distance, trajet.id_arrive_com , trajet.id_debut_com FROM trajet, commune as depart, commune as arrive WHERE trajet.id_debut_com = depart.comId AND trajet.id_arrive_com = arrive.comId;  -->