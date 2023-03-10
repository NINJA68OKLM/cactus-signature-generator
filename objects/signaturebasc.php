<?php
$id=$_COOKIE['id'];
$sitee = explode("/", $_COOKIE['site']);
// Espacement des numéros de téléphone
$tel = str_split($_COOKIE['tel'], 2);
$ld = str_split($_COOKIE['ld_'.$id], 2);
$li = "";
$la = "";
for ($d=0; $d < 5; $d++) { 
    $li = $li.$tel[$d]." ";
    $la = $la.$ld[$d]." ";
}
$tel = $li;
$ld = $la;
// Connexion à la base de données
$servername = "localhost";
$username = "admin__";
$password = "5YbsW6lVuo4wwh^a";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Sélection de tous les champs de réseuax sociaux
$requete= "SELECT facebook, twitter, instagram, youtube, linkedin FROM entreprise WHERE id='".$_COOKIE['idd']."'";
$result = $conn->query($requete);
// Sélection du nombre de réseuax sociaux
$rrequete= "SELECT rs FROM entreprise WHERE id='".$_COOKIE['idd']."'";
$rresult = $conn->query($rrequete);
// Sélection du style
$srequete= "SELECT rs_style FROM entreprise WHERE id='".$_COOKIE['idd']."'";
$sresult = $conn->query($srequete);
// Déclaration des cookies
$tab = ["facebook", "twitter", "instagram", "linkedin", "youtube"];
// Récupération du nombre de réseaux sociaux
// foreach ($rresult as $cle => $val) {
//   setcookie("rsnbr", $val["rs"], time()+3600);
// }
// Récupération du style
// foreach ($sresult as $cle => $val) {
//   setcookie("style", $val["rs_style"], time()+3600);
// }
// Récupération des réseaux sociaux en vérifiant chacune des valeurs dans la base de données
// foreach ($result as $cle => $val) {
//   $ch=0;
//   for ($r=0; $r < 5; $r++) {
//     // Tant qu'aucune des valeurs n'est vide on déclare la valeur en cookie 
//     if ($val[$tab[$r]] !== "")
//     {
//       // En-dessous -> exemples pour voir les résultats pris en compte
//       // echo $r." : ".$val[$tab[$r]]."<br>";
//       setcookie("rs_".$ch, $tab[$r]);
//       setcookie("rs_href_".$ch, $val[$tab[$r]]);
//       setcookie("rs_icon_".$ch, file_get_contents("../img/Logos/".$_COOKIE['style']."/".$tab[$ch].".svg"));
//       // echo $_COOKIE['rs_icon_0'];
//       $ch++;
//     }
//   }
// }
?>
<<<<<<< HEAD
<div style="font-family: Arial, Helvetica, sans-serif !important; min-height: 160px; min-width: 320px; max-width: 650px; display: flex; align-items: center">
  <table style="font-family:Arial, Helvetica, sans-serif !important; margin-right:0; margin-left:auto; line-height:19px; width: 100%; height: 100%; display: flex; justify-content: center;" cellpadding="0" cellspacing="0" id="table">
    <tbody>
      <tr style="font-size: 14px;">
        <!-- Identité -->
        <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
          <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif;"><?= $_COOKIE['prenom_'.$id]." ".strtoupper($_COOKIE['nom_'.$id]) ?></span>
          <br>
          <!-- Poste -->
          <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
            <?= $_COOKIE['fonction_'.$id] ?>
          </span>
          <br>
          <!-- Mail -->
          <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;"><a href="<?= $_COOKIE['mail_'.$id] ?>" style="color: rgb(100, 99, 99); text-decoration: none;"><?= $_COOKIE['mail_'.$id] ?></a></span>
          <br>
          <!-- Numéro de teléphone -->
          <span style="font-weight: bold; color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;">
            Tél : <a style="color: rgb(100, 99, 99); text-decoration: none;" href="tel:<?= $ld?>"><?= $_COOKIE['ld_'.$id]?> (ligne directe)</a>
          </span>
          <br> <br> 
          <span style="color: #000000; font-family: Arial, Helvetica, sans-serif;">
          <?= $_COOKIE['adre']?>, <?= $_COOKIE['cp']?> <?= $_COOKIE['vill']?>
          </span>
          <br>
          <span style="color: #000000; font-family: Arial, Helvetica, sans-serif;">
            Tél : <a href="tel: <?= $_SESSION['tel']?>" style="color: #000000; text-decoration: none;"><?= $tel?></a>
          </span>
          <br>
          <span style="display: flex;" class='cacher'>
          <!-- Site web -->
          <span style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
            <a style="color: #000000; text-decoration: none;" href="<?= $_COOKIE['site']?>"><?= $sitee[2]?></a>
          </span>
          <span class="signRS" style='display: flex; margin-left: 5px;'>
          <?php
          if (isset($_COOKIE['rsnbr']))
          {
            for ($r=0; $r < $_COOKIE['rsnbr']; $r++) { 
              echo "<span style='margin-left: 5px; margin-top: 3px;'>
                    <a style='text-decoration: none;' href='".$_COOKIE['rs_href_'.$r]."' target='_blank' rel='noopener noreferrer' style=''>
                      <div style='display: flex; width: 14px; height: 14px; justify-content: space-between;'' class='icon ".$_COOKIE['rs_'.$r]."'>
                        ".$_COOKIE['rs_icon_'.$r]."
                      </div>
                    </a>
                  </span>";
            }  
          }
          ?>
          </span> 
            <br>
          <span>
            <img src="https://generator.agence-cactus.fr/img/uploads/<?= $_COOKIE['logo'] ?>" alt="agence-cactus.fr" style="max-height:150px; height:auto; border:0;" height="150">
          </span>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div class="pub">
    <a href="<?= $_COOKIE['pub'] ?>" target="_blank" rel="noopener noreferrer">
        <img src="https://generator.agence-cactus.fr/img/uploads/<?= $_COOKIE['logo'] ?>" alt="" style="min-width: 310px; max-width: 600px; max-height: 150px; margin-top: 15px;">
    </a>
</div>
=======
<table style="font-family:Arial, Helvetica, sans-serif !important; margin-right:0; margin-left:auto; line-height:19px; width: 100%; height: 100%; " cellpadding="0" cellspacing="0" id="table">
  <tbody>
    <tr style="font-size: 14px;">
      <!-- Identité -->
      <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
        <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif;"><?= $_COOKIE['prenom_'.$id]." ".strtoupper($_COOKIE['nom_'.$id]) ?></span>
        <br>
        <!-- Poste -->
        <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
          <?= $_COOKIE['fonction_'.$id] ?>
        </span>
        <br>
        <!-- Mail -->
        <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;"><a href="<?= $_COOKIE['mail_'.$id] ?>" style="color: rgb(100, 99, 99); text-decoration: none;"><?= $_COOKIE['mail_'.$id] ?></a></span>
        <br>
        <!-- Numéro de teléphone -->
        <span style="font-weight: bold; color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;">
          Tél : <a style="color: rgb(100, 99, 99); text-decoration: none;" href="tel:<?= $_COOKIE['ld_'.$id]?>"><?= $_COOKIE['ld_'.$id]?> (ligne directe)</a>
        </span>
        <br> <br> 
        <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
        <?= $_SESSION['adre']?>, <?= $_SESSION['cp']?> <?= $_SESSION['vill']?>
        </span>
        <br>
        <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
          Tél : <a href="tel: <?= $_SESSION['tel']?>" style="color: #156cad; text-decoration: none;"><?= $_SESSION['tel']?></a>
        </span>
        <br>
        <span style="display: flex;" class='cacher'>
        <!-- Site web -->
        <span style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
          <a style="color: #156cad; text-decoration: none;" href="<?= $_SESSION['site']?>"><?= $_SESSION['site']?></a>
        </span>
        <span class="signRS" style='display: flex; margin-left: 5px;'>
        <?php
        if (isset($_COOKIE['rsnbr']))
        {
          for ($r=0; $r < $_COOKIE['rsnbr']; $r++) { 
            echo "<span style='margin-left: 5px; margin-top: 3px;'>
                  <a style='text-decoration: none;' href='".$_COOKIE['rs_href_'.$r]."' target='_blank' rel='noopener noreferrer' style=''>
                    <div style='display: flex; width: 14px; height: 14px; justify-content: space-between;'' class='icon ".$_COOKIE['rs_'.$r]."'>
                      <img src='https://generator.agence-cactus.fr/".$_COOKIE['rs_icon_'.$r]."' alt=''>
                    </div>
                  </a>
                </span>";
          }  
        }
        ?>
        </span> 
          <br>
        <span>
          <img src="https://generator.agence-cactus.fr/img/uploads/<?= $_COOKIE['logo'] ?>" alt="agence-cactus.fr" style="max-height:150px; height:auto; border:0;" height="150">
        </span>
      </td>
    </tr>
  </tbody>
</table>
>>>>>>> f4dbbec0ad4884910deac2ca173971d24997607c
