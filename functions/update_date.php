<?php
session_start();
session_id();
// Connexion à la base de données
$servername = "localhost";
$username = "admin__";
$password = "5YbsW6lVuo4wwh^a";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Requêtes
$update = "UPDATE entreprise SET pub='".$_COOKIE['pub']."' WHERE id='".$_COOKIE['idd']."'";
$conn->query($update);
$updatee = "UPDATE entreprise SET banniere='".$_COOKIE['bannierenom']."' WHERE id='".$_COOKIE['idd']."'";
$conn->query($updatee);
echo $update;
echo "<br>".$updatee;
// Modification de l'image
if (!empty($_FILES["banniere"]) && is_uploaded_file($_FILES["banniere"]["tmp_name"]))
{
  echo "jjjjjjj";
  // Importation du logo/image
  $target='img/uploads/'.basename($_FILES['banniere']['name']);
  if(move_uploaded_file($_FILES['banniere']['tmp_name'],$target)) {
    $fp = fopen($target, "r");
  }
  $_SESSION['bannierenom'] = $_FILES['banniere']['name'];
  echo $_SESSION['bannierenom'];
}
else
{
  echo "Aucun fichier selectionné...";
}
echo "<p style='color: #000000;'>La publicité a bien été modifié !</p>";
setcookie("bannierenom", $_SESSION['bannierenom']);
echo $_COOKIE['barrierenom'];
?>
