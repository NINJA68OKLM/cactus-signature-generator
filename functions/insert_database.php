<?php
session_start();
session_id();
$i = $_COOKIE['id'];
if (isset($_COOKIE['bddid']))
{
  $_COOKIE['bddid'] = $_COOKIE['bddid'] ;
}
else
{
  $_COOKIE['bddid']  = $_SESSION['bddid'];
}
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
// // Récupération de l'id de l'entreprise en cookie "bddid"
$requete= "SELECT id FROM entreprise WHERE nom='".$_COOKIE['nom_'.$i]."' AND prenom='".$_COOKIE['prenom_'.$i]."' AND id='".$_COOKIE['bddid']."'";
$result = $conn->query($requete);

// Vérifie si l'employé existe déjà existe dans la base de données
$requetee= "SELECT * FROM employes WHERE nom='".$_COOKIE['nom_'.$i]."' AND prenom='".$_COOKIE['prenom_'.$i]."' AND id='".$_COOKIE['bddid']."'";
$resultt = $conn->query($requetee);

// if ($result->num_rows > 0) {
if ($resultt->num_rows >= 1) {
  echo "<p class='confirmation' style='margin: 7.5px;'>Cet employé existe déjà dans notre base de données !</p>";
}
else
{
  // echo "<p class='confirmation' style='margin: 15px;'>Cet employé n'existe pas.</p>";
  echo "<p class='confirmation' style='margin: 7.5px;'>Cet employé a bien été enregistré dans la base de données !</p>";
  $nrequete = "SELECT id FROM entreprise WHERE nom='".$_SESSION['entr']."'";
  $rresult = $conn->query($nrequete);

  while ($ligne = $rresult->fetch_row())
  {
    // Préparation de l'insertion de l'employé dans la base de données
    $insert="INSERT INTO employes (id, nom, prenom, fonction, ld, mail, admin, ide, mdp) VALUES (".$ligne[0].",'".$_COOKIE['nom_'.$i]."', '".$_COOKIE['prenom_'.$i]."', '".$_COOKIE['fonction_'.$i]."', ".$_COOKIE['ld_'.$i].", '".$_COOKIE['mail_'.$i]."', 0, '', '')";
    // Echo test pour voir ce que retourne la requête SQL
    // echo $insert;
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
    // echo $update;
    // Insertion
    if ($conn->query($insert) === true)
    {
      $result = true;
    }
    else
    {
      $result = false;
    }
    // Attribution des identifiants
    $conn->query($update);
    // echo "<br>".$_COOKIE['nom_'.$i];
  }
}
$conn->close();
?>