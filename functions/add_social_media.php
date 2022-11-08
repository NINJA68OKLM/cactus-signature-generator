<?php
session_start();
session_id();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);

// Enregistrement du nombre de réseaux sociaux de l'entreprise
$requete= "UPDATE entreprise SET rs='".$_COOKIE['rsnbr']."' WHERE id='".$_COOKIE['bddid']."'";
$result = $conn->query($requete);
// On vide les liens de tous les réseuax sociaux dans la base de données
$kfrequete= $requete= "UPDATE entreprise SET facebook='', instagram='', twitter='', linkedin='', youtube='' WHERE id='".$_COOKIE['bddid']."'";
$kfresult = $conn->query($kfrequete);
// Enregistrement des liens des réseaux sociaux
for ($d=0; $d < $_COOKIE['rsnbr']; $d++) {
  $frequete= $requete= "UPDATE entreprise SET ".$_COOKIE['rs_'.$d]."='".$_COOKIE['rs_href_'.$d]."' WHERE id='".$_COOKIE['bddid']."'";
  $fresult = $conn->query($frequete);
  // echo "<br>".$frequete."<br>";
}
// Enregistrement du style
$trequete= "UPDATE entreprise SET rs_style='".$_COOKIE['rs_style']."' WHERE id='".$_COOKIE['bddid']."'";
$tresult = $conn->query($trequete);
echo $trequete;
?>