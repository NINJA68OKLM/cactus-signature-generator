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
$requete= "INSERT INTO employes (id, nom, prenom, mail, ld, fonction, admin, ide, mdp) VALUES ('".$_COOKIE['idd']."', '".$_COOKIE['nom']."', '".$_COOKIE['prenom']."', '".$_COOKIE['mail']."', '".$_COOKIE['ld']."', '".$_COOKIE['fonction']."', 0, '', '')";
$result = $conn->query($requete);
$update = "UPDATE employes SET pub='".$_COOKIE['pub']."' WHERE id='".$_COOKIE['idd']."'";
$conn->query($update);
echo "<p style='color: #000000;'>Votre nouvel employé a bien été ajouté !</p>";
?>