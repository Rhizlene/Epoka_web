<?php

session_start();
if(!isset($_SESSION["id_salarie"])){
  header("Location: index.php");
  exit(); 
}

require("config.php");
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

$indemKm = $_POST['indemKm'];
$indemHeb = $_POST['indemJour'];

if(empty($indemKm) || empty($indemHeb)) {

    echo "Erreur : Veuillez saisir tout les champs ! ";
    echo "<a href='parametrage.php'>Retour</a>";


}else {

    $req = $pdo->prepare('UPDATE parametre SET idem_kilometre = :indemKm, forfait_journalier = :indemJour');
    $req->bindValue(':indemKm', $indemKm, PDO::PARAM_INT);
    $req->bindValue(':indemJour', $indemHeb, PDO::PARAM_INT);
    $req->execute();

    echo '<div class="alert m-5 alert-success" role="alert">
    Les parametres ont été modifié !
    </div>';

header("Refresh:0;parametrage.php");
}


?>