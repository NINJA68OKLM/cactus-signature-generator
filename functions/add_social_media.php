<?php
session_start();
session_id();
$servername = "localhost";
$username = "admin__";
$password = "5YbsW6lVuo4wwh^a";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_SESSION['entr']))
{
  $_COOKIE['entr'] = $_SESSION['entr'] ;
}
else
{
  $_COOKIE['entr']  = $_COOKIE['entr'];
}
// Sélection de l'id de l'entreprise
$select="SELECT id FROM employes WHERE nom='".$_COOKIE['entr']."'" ;
$reponse = $conn->query($select);
$ligne = $reponse->fetch_assoc();
setcookie("bddid", $ligne["id"], time()+3600);
// Enregistrement du nombre de réseaux sociaux de l'entreprise
$requete= "UPDATE entreprise SET rs='".$_COOKIE['rsnbr']."' WHERE id='".$_COOKIE['bddid']."'";
$result = $conn->query($requete);
// On vide les liens de tous les réseuax sociaux dans la base de données
$kfrequete= $requete= "UPDATE entreprise SET facebook='', instagram='', twitter='', linkedin='', youtube='' WHERE id='".$_COOKIE['bddid']."'";
$kfresult = $conn->query($kfrequete);
// Enregistrement des liens des réseaux sociaux
for ($d=0; $d < $_COOKIE['rsnbr']; $d++) {
  $frequete= $requete= "UPDATE entreprise SET ".$_COOKIE['rs_'.$d]."='".$_COOKIE['rs_href_'.$d]."', rs_style='".$_COOKIE['rs_style']."' WHERE id='".$_COOKIE['bddid']."'";
  echo $frequete;
  $fresult = $conn->query($frequete);
  echo "<br>".$frequete."<br>";
}
// Enregistrement du style
$trequete= "UPDATE entreprise SET rs_style='".$_COOKIE['rs_style']."', rs='".$_COOKIE['rsnbr']."' WHERE id='".$_COOKIE['bddid']."'";
$tresult = $conn->query($trequete);
echo $trequete;
?>