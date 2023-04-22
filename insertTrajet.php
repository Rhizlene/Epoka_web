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

$commune1 = $_POST['commune1'];
$commune2 = $_POST['commune2'];
$distance = $_POST['distance'];

if(empty($commune1) || empty($commune2) || empty($distance) || !filter_var($distance, FILTER_VALIDATE_INT)) {

    echo "Erreur : Veuillez saisir tout les champs ! ";
    echo "<a href='parametrage.php'>Retour</a>";


}else {

    $req = $pdo->prepare('INSERT INTO trajet (id_arrive_com, id_debut_com,distance) VALUES (:commune1,:commune2,:distance)');
    $req->bindValue(':commune1', $commune1, PDO::PARAM_INT);
    $req->bindValue(':commune2', $commune2, PDO::PARAM_INT);
    $req->bindValue(':distance', $distance, PDO::PARAM_INT);
    $req->execute();

header("Refresh:0;parametrage.php");
}


?>