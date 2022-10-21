<?php
echo "DDDDD : KI";
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
// Enregistrement des liens des réseaux sociaux
for ($d=0; $d < $_COOKIE['rsnbr']; $d++) {
  $frequete= $requete= "UPDATE entreprise SET ".$_COOKIE['rs_'.$d]."='".$_COOKIE['rs_href_'.$d]."' WHERE id='".$_COOKIE['bddid']."'";
  $fresult = $conn->query($frequete);
}
// Enregistrement du style
$trequete= "UPDATE entreprise SET rs_style='".$_COOKIE['rs_style']."' WHERE id='".$_COOKIE['bddid']."'";
$tresult = $conn->query($trequete);
?>