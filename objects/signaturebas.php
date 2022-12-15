<?php
$id=$_COOKIE['id'];
?>
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
          <img src="https://generator.agence-cactus.fr/img/uploads/<?= $_SESSION['logonom'] ?>" alt="agence-cactus.fr" style="max-height:150px; height:auto; border:0;" height="150">
        </span>
      </td>
    </tr>
  </tbody>
</table>