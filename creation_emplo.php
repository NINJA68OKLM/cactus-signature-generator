<?php
session_start();
session_id();
$logo=$_SESSION['logo'];
$logonom=$_SESSION['logonom'];
$logotmp=$_SESSION['logo_tmp'];
$entr=$_SESSION['entr'];
$adre=$_SESSION['adre'];
$cp=$_SESSION['cp'];
$vill=$_SESSION['vill'];
$tel=$_SESSION['tel'];
$site=$_SESSION['site'];
$empl=$_SESSION['empl'];
$sign=$_SESSION['sign'];
if (isset($_POST['ok']))
{
    $empl=$_POST['empl'];
}
if (empty($logo) && empty($entr) && empty($adre) && empty($cp) && empty($vill) && empty($tel) && empty($site) && empty($empl) && empty($sign))
{
    header("Location: creation_entre.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_O.css" media="screen and (min-width: 1200px)">
    <title>Signature Generator</title>
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="app.js"></script>
</head>
<body>
    <fieldset>
        <div class="gauche">
            <img src="img/logo.png" alt="" style="width: 100%;">
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
            <h1>Déclarez vos employés</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form">
                    <div class="col1">
                        <p>Nom d'entreprise :</p> <br>
                        <p>Adresse :</p> <br>
                        <p>Ville :</p> <br>
                        <p>Code postal :</p> <br>
                    </div>
                    <div class="col2">
                        <input type="text" name="entr" id="" value="<?php if (!empty($_POST['entr'])) { echo $_POST['entr'] ; } else { echo $entr; } ?>"><br>
                        <input type="text" name="adre" id="" value="<?php if (!empty($_POST['adre'])) { echo $_POST['adre'] ; } else { echo $adre; } ?>"><br>
                        <input type="text" name="vill" id="" value="<?php if (!empty($_POST['vill'])) { echo $_POST['vill'] ; } else { echo $cp; } ?>"><br>
                        <input type="text" name="cp" id="" maxlength="5" value="<?php if (!empty($_POST['cp'])) { echo $_POST['cp'] ; } else { echo $vill; } ?>">
                    </div>
                </div>
                <div class="form">
                    <div class="col3">
                        <p>Numéro de teléphone :</p> <br>
                        <p>Site internet :</p> <br>
                        <p>Nombre d'employés :</p> <br>
                        <p>Signature :</p> <br>
                        <p>Logo :</p> <br>
                    </div>
                    <div class="col4">
                        <input type="text" name="tel" id="" maxlength="10" value="<?php if (!empty($_POST['tel'])) { echo $_POST['tel'] ; } else { echo $tel; }?>"><br>
                        <input type="text" name="site" id="" value="<?php if (!empty($_POST['site'])) { echo $_POST['site'] ; }  else { echo $site; }?>"><br>
                        <input type="text" name="empl" id="" value="<?php echo $empl;?>" class="employ"><br>
                        <input type="radio" name="sign" value="bloc" id="" <?php if ($sign=="bloc" | (isset($_POST['sign']) && ($_POST['sign']=="bloc"))) { echo "checked='checked'"; } ?>> Bloc 
                        <input type="radio" name="sign" value="colonnes" id="" <?php if ($sign=="colonnes" | (isset($_POST['sign']) && ($_POST['sign']=="colonnes"))) { echo "checked='checked'"; } ?>> Colonnes <br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000"><br>
                        <?php 
                        echo $logonom;
                        ?> 
                    </div>
                </div>
                <input type="submit" name="ok" value="Confirmer" class="button">
                <input type="submit" value="Deconnexion" name="deco" class="button">
            </form>
        </div>
    </fieldset>
    <?php
    echo "<div class='results'>
        <div class='emplo'>";
            for ($i=0; $i < $empl; $i++) { 
                        echo "<hr style='max-width: 420px; margin-left: 0px;'>".$employ=
                        "<form action=".$_SERVER['PHP_SELF']." method='post' style='max-width: 420px; margin-right: 10px;' class='form_employ form_employ_$i' id='form_employ_$i'>
                            <div class='".$entr."'>
                                <div class='form' id='".$i."'>
                                    <div class='col5'>
                                        <p>Nom :</p> <br>
                                        <p>Prénom :</p> <br>
                                        <p>Fonction :</p> <br>
                                        <p>Ligne directe :</p> <br>
                                        <p>Mail :</p> <br>
                                    </div>
                                    <div class='col6'>
                                        <input type='text' name='nom_".$i."' id='' value=\"";
                                        if (!empty($_POST['nom_'.$i]))
                                        {
                                            echo $_POST['nom_'.$i];
                                        }
                                        echo "\"><br>
                                        <input type='text' name='prenom_".$i."' id='' value=\"";
                                        if (!empty($_POST['prenom_'.$i]))
                                        {
                                            echo $_POST['prenom_'.$i];
                                        }
                                        echo "\"><br>
                                        <input type='text' name='fonction_".$i."' id='' value=\"";
                                        if (!empty($_POST['fonction_'.$i]))
                                        {
                                            echo $_POST['fonction_'.$i];
                                        }
                                        echo "\"><br>
                                        <input type='text' name='ld_".$i."' id='' value=\"";
                                        if (!empty($_POST['ld_'.$i]))
                                        {
                                            echo $_POST['ld_'.$i];
                                        }
                                        echo "\"><br>
                                        <input type='text' name='mail_".$i."' id='' value=\"";
                                        if (!empty($_POST['mail_'.$i]))
                                        {
                                            echo $_POST['mail_'.$i];
                                        }
                                        echo "\">
                                        <input type='submit' name='confirm_".$i."' value='Enregistrer' class='button enregistrer_$i enregistrer' data-form-id='$i' >
                                    </div>
                                </div>
                            </div>
                            <div class='zone' id='zone_$i'></div>
                        </form>";
                        // $_SESSION['employe']=$employ;
                        // $form= array($i => array(
                        //     "nom" => "nom_".$i,
                        //     "prenom" => "prenom_".$i,
                        //     "fonction" => "fonction_".$i,
                        //     "mail" => "mail_".$i,
                        //     "ld" => "ld_".$i,
                        //     "confirm" => "confirm_".$i
                        // ));
                        // $_SESSION['form']=$form;
                        // if (isset($_POST[$form[$i]['confirm']]) && !empty($_POST[$form[$i]['nom']]) && !empty($_POST[$form[$i]['prenom']]) && !empty($_POST[$form[$i]['fonction']]) && !empty($_POST[$form[$i]['ld']]) && !empty($_POST[$form[$i]['mail']])) {
                        //     echo "<p style='margin-left: 15px; font-weight: bold;'>La signature de cette personne a bien été créé !</p> <br>";
                        //     echo "<div style='display: flex; justify-content: left;'><input type='submit' name='apercu_".$i."' value='Aperçu' class='button apercu_submit' id='apercu_$i' style='margin-left: 15px;' data-form-id='$i'>";
                        //     echo "<input type='submit' name='telecharger_".$i."' value='telécharger' class='button' style='margin-left: 15px;'></div>";
                        //     echo $_POST['apercu_'.$i];
                        // }
                        // else
                        // {
                        //     echo "<p><b>Déclarez votre employé</b></p>";
                        // }
                }
        echo "</div>
              <div class='apercu' style='height: 300px;'>";
                // if (isset($form["apercu"]))
                // {

                //         for ($i=0; $i < $empl; $i++)
                //         {
                //             $form= array($i => array(
                //                 "nom" => "nom_".$i,
                //                 "prenom" => "prenom_".$i,
                //                 "fonction" => "fonction_".$i,
                //                 "mail" => "mail_".$i,
                //                 "ld" => "ld_".$i,
                //                 "confirm" => "confirm_".$i,
                //                 "apercu" => "apercu_".$i,
                //                 "telecharger" => "telecharger_".$i
                //             ));
                //             if (isset($_POST[$form[$i]['apercu']]) && !empty($_POST[$form[$i]['nom']]) && !empty($_POST[$form[$i]['prenom']]) && !empty($_POST[$form[$i]['fonction']]) && !empty($_POST[$form[$i]['ld']]) && !empty($_POST[$form[$i]['mail']]))
                //             {
                //                     if ($sign=="bloc" || $_POST['sign']=="bloc")
                //                     {
                //                         echo "<h1>Michel</h1>";
                //                     }
                //                     if ($sign=="colonnes" || $_POST['sign']=="colonnes"){
                //                         echo $_SESSION['signature']="<table style='padding: 2px; border-style: none; border-color: black; border-style: none; border-collapse: inherit; direction: ltr; width: 100%' cellpadding='0' cellspacing='0'>
                //                         <tbody>
                //                             <tr>
                //                                 <td style='font-size:1pt; vertical-align:top; width: 95px;' valign='top'>               
                //                                     <table style='' cellpadding='0' cellspacing='0'>
                //                                         <tbody>
                //                                             <tr>
                //                                                 <!-- Logo ou photo de profil d'une largeur de 150 px -->
                //                                                 <td style='height:55px; vertical-align:top;' valign='top'>
                //                                                     <img src='".$logotmp."' style='border:0;' height='70'>
                //                                                 </td>
                //                                             </tr>      
                //                                         </tbody>
                //                                     </table>
                //                                 </td>
                //                                 <td style='padding-left:5px; text-align: left; vertical-align:top; ' valign='top'>
                //                                     <table style=' margin-right:0; margin-left:auto; line-height:19px; width: 100%; height: 100%; ' cellpadding='0' cellspacing='0' id='table'>
                //                                         <tbody>
                //                                             <tr style='font-size: 14px;'>
                //                                                 <!-- Identité -->
                //                                                 <td style='height:35px; vertical-align:center; text-align: left;' valign='center' align='right'>
                //                                                     <span id='nom' style='font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif !important;'>".$form[$i]['nom']." ".$form[$i]['prenom']."/span>
                //                                                     <br>
                //                                                     <span style='color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;'>
                //                                                             ".$form[$i]['fonction']."
                //                                                     </span>
                //                                                     <br>
                //                                                 <!-- Mail -->
                //                                                     <span style='color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important;'><a href='mailto:".$form[$i]['mail']."' style='color: rgb(100, 99, 99); text-decoration: none;'>".$form[$i]['mail']."</a></span>
                //                                                     <br>
                //                                                     <!-- Numéro de téléphone -->
                //                                                 <span style='color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important; font-weight: bold;'>
                //                                                         tel : <a style='text-decoration: none; color: rgb(100, 99, 99);' href='tel:".$form[$i]['ld']."'>".$form[$i]['ld']." (ligne directe)</a>
                //                                                 </span>
                //                                                 </td>
                //                                             </tr>
                //                                         </tbody>
                //                                     </table>
                //                                 </td>
                //                             </tr>
                //                         </tbody>
                //                     </table>";
                //                     }
                //             }
                //         }
                // }
                // else
                // {
                //     echo "<div style='display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;'>
                //         <strong>APERCU</strong>
                //     </div>";
                // }
                // echo $apercu;
        echo "</div>
              <div class='pub'>
                
              </div>
        </div>";
        if (isset($_POST['deco']))
        {
            header("Location: index.php");
            session_destroy();
        }
    ?>
</body>
</html>