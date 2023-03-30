<?php
        session_start();
        if(!isset($_SESSION["id_salarie"])){
          header("Location: index.php");
          exit(); 
        }
        
        $host = 'localhost';
        $dbname = 'epoka_mission';
        $username = 'root';
        $password = 'root';
		$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
		$stmt = $pdo->prepare("UPDATE mission SET valid = 1 WHERE id_mission = ".$_POST['valider'].";");
		$stmt->execute();
		header("Refresh:0;validation.php");
?>