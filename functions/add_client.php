<?php
session_start();
session_id();
// $id = $_COOKIE['id'];
$id = $_COOKIE['nb_client'];
// Connexion à la base de données
$servername = "localhost";
$username = "admin__";
$password = "5YbsW6lVuo4wwh^a";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Requêtes
$requete= "INSERT INTO employes (id, nom, prenom, mail, ld, fonction, admin, ide, mdp) VALUES ('".$_COOKIE['idd']."', '".$_COOKIE['nom']."', '".$_COOKIE['prenom']."', '".$_COOKIE['mail']."', '".$_COOKIE['ld']."', '".$_COOKIE['fonction']."', 0, '', '')";
$result = $conn->query($requete);
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 20; $i++) {
  $randomString .= $characters[rand(0, $charactersLength - 1)];
}
$ide = strtolower($_COOKIE['prenom']).".".strtolower($_COOKIE['nom'])."@signature-cactus.fr";
$update = "UPDATE employes SET ide='".$ide."', mdp='".$randomString."' WHERE id='".$_COOKIE['idd']."' AND nom='".$_COOKIE['nom']."' AND prenom='".$_COOKIE['prenom']."'";
$conn->query($update);
echo "<p style='color: #000000;'>Votre nouvel employé a bien été ajouté !</p>";
?>