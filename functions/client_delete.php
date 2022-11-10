<?php
session_start();
session_id();
$i = $_COOKIE['id'];
  $servername = "localhost";
  $username = "admin__";
  $password = "5YbsW6lVuo4wwh^a";
  $dbname = "signature";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // $requete= "UPDATE employes SET nom='".$_POST['nom_'.$i]."', prenom='".$_POST['prenom_'.$i]."', mail='".$_POST['mail_'.$i]."', ld='".$_POST['ld_'.$i]."', fonction='".$_POST['fonction_'.$i]."' WHERE id='".$_COOKIE['bddid']."' AND nom='".$_COOKIE['nom_'.$i]."', prenom='".$_COOKIE['prenom_'.$i]."', mail='".$_COOKIE['mail_'.$i]."', ld='".$_COOKIE['ld_'.$i]."', fonction='".$_COOKIE['fonction_'.$i]."'";
  // $result = $conn->query($requete);
  $requete= "DELETE FROM employes WHERE id='".$_COOKIE['idd']."' AND nom='".$_COOKIE['nom_pre_'.$i]."' AND prenom='".$_COOKIE['prenom_pre_'.$i]."' AND fonction='".$_COOKIE['fonction_pre_'.$i]."' AND idd='".$_COOKIE['idd_'.$i]."'";
  $result = $conn->query($requete);
  echo $requete;
  // 
  $rrequete= $requete= "SELECT * FROM entreprise WHERE id='".$_COOKIE['idd']."'";
  echo $rrequete;
  $rresult = $conn->query($rrequete);

  // for ($n=0; $n > $_COOKIE['nb_client']; $n++) { 
  //   setcookie("nom_".$n, "" , time()-1);
  // }
  

?>