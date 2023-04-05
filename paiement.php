<!doctype html>
<html lang="fr">
 <title>Paiement des Frais</title>
 <?php include('header.php'); ?>
	
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
       

    <!-- SELECT salarie.nom_salarie, salarie.prenom_salarie, mission.debut, mission.fin, commune.comNom, commune.comCp, trajet.distance, trajet.id_arrive_com , trajet.id_debut_com, (parametre.forfait_journalier * trajet.distance) as montant, mission.payer FROM salarie LEFT JOIN mission ON salarie.id_salarie = mission.id_salarie LEFT JOIN commune ON mission.id_commune = commune.comId LEFT JOIN trajet ON trajet.id_arrive_com = mission.id_commune AND trajet.id_debut_com = salarie.id_agence LEFT JOIN parametre ON trajet.id_arrive_com = parametre.idem_kilometre WHERE salarie.id_responsable = salarie.id_salarie ORDER BY mission.debut;  -->