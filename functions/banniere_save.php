<?php
session_start();
session_id();
// Connexion à la base de données
$servername = "localhost";
$username = "admin__";
$password = "5YbsW6lVuo4wwh^a";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Modification de l'image
setcookie('filee', $_FILES["banniere"], time()+3600);
setcookie('tmp', $_FILES["banniere"]["tmp_name"], time()+3600);
echo $_COOKIE['filee'];
if (!empty($_FILES["banniere"]) && is_uploaded_file($_FILES["banniere"]["tmp_name"]))
{
  // Importation du logo/image
  $target='img/uploads/'.basename($_FILES['banniere']['name']);
  if(move_uploaded_file($_FILES['baniere']['tmp_name'],$target)) {
    $fp = fopen($target, "r");
  }
  $_SESSION['bannierenom'] = $_FILES['banniere']['name'];
  echo $_SESSION['bannierenom'];
  $updateee = "UPDATE entreprise SET banniere='".$_SESSION['bannierenom']."' WHERE id=".$_COOKIE['idd']."";
  $conn->query($updateee);
  echo "<br>".$updateee;
  setcookie("bannierenom", $_SESSION['bannierenom'], time()+3600);
}
else
{
  echo "Aucun fichier selectionné...";
}




$updatee = "UPDATE entreprise SET banniere='".$_COOKIE['bannierenom']."' WHERE id='".$_COOKIE['idd']."'";
$conn->query($updatee);
echo $updatee;
?>
