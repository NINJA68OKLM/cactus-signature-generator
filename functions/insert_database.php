<?php
session_start();
session_id();
$i = $_COOKIE['id'];
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérification de la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Vérifie si l'employé existe déjà exite dans la base de données
$requete= "SELECT * FROM employes WHERE nom='".$_COOKIE['nom_'.$i]."' AND prenom='".$_COOKIE['prenom_'.$i]."' AND id='".$_COOKIE['bddid']."'";
$result = $conn->query($requete);

// if ($result->num_rows > 0) {
if ($result->num_rows >= 1) {
  echo "<p class='confirmation' style='margin: 15px;'>Cet employé existe déjà dans notre base de données !</p>";
}
else
{
  echo "<p class='confirmation' style='margin: 15px;'>Cet employé n'existe pas.</p>";
  $nrequete = "SELECT id FROM entreprise WHERE nom='".$_SESSION['entr']."'";
  $rresult = $conn->query($nrequete);

  while ($ligne = $rresult->fetch_row())
  {
    // Préparation de l'insertion de l'employé dans la base de données
    $insert="INSERT INTO employes (id, nom, prenom, fonction, ld, mail, admin, ide, mdp) VALUES (".$ligne[0].",'".$_COOKIE['nom_'.$i]."', '".$_COOKIE['prenom_'.$i]."', '".$_COOKIE['fonction_'.$i]."', ".$_COOKIE['ld_'.$i].", '".$_COOKIE['mail_'.$i]."', 0, '', '')";
    echo $insert;
    // Génération des identifiants
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($e = 0; $e < 20; $e++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $ide = strtolower($_COOKIE['nom_'.$i]).".".strtolower($_COOKIE['prenom_'.$i])."@signature-cactus.fr";
    // Requête d'enregistrement des identifiants dans la base de données
    $update = "UPDATE employes SET ide='".$ide."', mdp='".$randomString."' WHERE id='".$_COOKIE['bddid']."' AND nom='".$_COOKIE['nom_'.$i]."'";
    echo $update;
    // Insertion
    if ($conn->query($insert) === true)
    {
      echo "True";
    }
    else
    {
      echo "Not true";
    }
    // Attribution des identifiants
    $conn->query($update);
    echo "<br>".$_COOKIE['nom_'.$i];
  }
}
$conn->close();
?>