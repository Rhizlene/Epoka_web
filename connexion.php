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

session_start();

try {
    
    $stmt = $pdo->prepare("SELECT id_salarie, nom_salarie, prenom_salarie, mdp, responsable,comptable FROM salarie WHERE id_salarie = :id_salarie AND mdp = PASSWORD(:mdp)");
    $stmt->execute(array(':id_salarie' => $_POST["login"], ':mdp' => $_POST["motdepasse"]));
    var_dump( $_POST["motdepasse"]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        
        $_SESSION['id_salarie'] = $row['id_salarie'];
        $_SESSION['nom_salarie'] = $row['nom_salarie'];
        $_SESSION['prenom_salarie'] = $row['prenom_salarie'];
        $_SESSION['responsable'] = $row['responsable'];
        $_SESSION['comptable'] = $row['comptable'];
        
        
        header('Location: accueil.php');
        exit();
    } else {
       
        header('Location: index.php');
        exit();
     
    }
	
} catch (Exception $e) {
    $erreur = "Gros souci : " . $e->getMessage();
    die($erreur);
}

?>