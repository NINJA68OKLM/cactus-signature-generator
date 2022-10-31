<?php
session_start();
session_id();
// Connexion à la base de données
$requete= "SELECT * FROM entreprise WHERE nom='".$_SESSION['entr']."'";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Récupération de l'id de l'entreprise dans la base de données pour la réutiliser plus tard
$recherche = "SELECT id FROM entreprise WHERE nom='".$_SESSION['entr']."'";
$ligne = $conn->query($recherche);
$id = $ligne->fetch_row();
echo $id[0];
?>