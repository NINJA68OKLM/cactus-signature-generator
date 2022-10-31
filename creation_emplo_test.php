<?php
session_start();
session_id();
$logo=$_SESSION['logo'];
$logonom=$_SESSION['logonom'];
$entr=$_SESSION['entr'];
$adre=$_SESSION['adre'];
$cp=$_SESSION['cp'];
$vill=$_SESSION['vill'];
$tel=$_SESSION['tel'];
$site=$_SESSION['site'];
$empl=$_SESSION['empl'];
$sign=$_SESSION['sign'];
if (isset($_POST['ok']) | isset($_POST['sign']) | !empty($_POST['entr']) | !empty($_POST['adre']) | !empty($_POST['cp']) | !empty($_POST['vill']) | !empty($_POST['tel']) | !empty($_POST['site']) | !empty($_POST['empl']))
{
    $_SESSION['empl']=$empl=$_POST['empl'];
    $_SESSION['entr']=$entr=$_POST['entr'];
    $_SESSION['adre']=$adre=$_POST['adre'];
    $_SESSION['cp']=$cp=$_POST['cp'];
    $_SESSION['vill']=$vill=$_POST['vill'];
    $_SESSION['tel']=$tel=$_POST['tel'];
    $_SESSION['site']=$site=$_POST['site'];
    $_SESSION['sign']=$sign=$_POST['sign'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style_O.css" media="screen and (min-width: 1200px)">
    <link rel="stylesheet" href="styles/background_1.css">
    <link rel="stylesheet" href="styles/background_1_O.css" media="screen and (min-width: 1200px)">
    <title>Signature Generator</title>
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="js/jquery-cookie-master/src/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
    <script src="js/accept-cookie.js"></script>
</head>
<body>
    <fieldset>
        <div class="gauche">
            <img src="img/logo.png" alt="" style="width: 100%;">
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
            <h1>Déclarez vos employés</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="formprinc">
                <div class="flex">
                    <div class="form">
                        <div class="col1">
                            <p>*Nom d'entreprise :</p> <br>
                            <p>*Adresse :</p> <br>
                            <p>*Ville :</p> <br>
                            <p>*Code postal :</p> <br>
                        </div>
                        <div class="col2">
                            <input type="text" name="entr" id="" value="<?php if (!empty($_POST['entr'])) { echo $_POST['entr'] ; } else { echo $entr; } ?>"><br>
                            <input type="text" name="adre" id="" value="<?php if (!empty($_POST['adre'])) { echo $_POST['adre'] ; } else { echo $adre; } ?>"><br>
                            <input type="text" name="vill" id="" value="<?php if (!empty($_POST['vill'])) { echo $_POST['vill'] ; } else { echo $vill; } ?>"><br>
                            <input type="text" name="cp" id="" maxlength="5" value="<?php if (!empty($_POST['cp'])) { echo $_POST['cp'] ; } else { echo $cp; } ?>">
                        </div>
                    </div>
                    <p class="trait"></p>
                    <div class="form">
                        <div class="col3">
                            <p>*Numéro de teléphone :</p> <br>
                            <p>*Site internet :</p> <br>
                            <p>*Nombre d'employés :</p> <br>
                            <p>*Signature :</p> <br>
                            <p class="plogo">*Logo :</p> <br>
                        </div>
                        <div class="col4">
                            <input type="text" name="tel" id="" maxlength="10" value="<?php if (!empty($_POST['tel'])) { echo $_POST['tel'] ; } else { echo $tel; }?>"><br>
                            <input type="text" name="site" id="" value="<?php if (!empty($_POST['site'])) { echo $_POST['site'] ; }  else { echo $site; }?>"><br>
                            <input type="text" name="empl" id="" value="<?php echo $empl;?>" class="employ"><br>
                            <input type="radio" name="sign" value="haut" id="haut" <?php if ($sign=="haut" | (isset($_POST['sign']) && ($_POST['sign']=="haut"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Haut 
                            <input type="radio" name="sign" value="bas" id="bas" <?php if ($sign=="bas" | (isset($_POST['sign']) && ($_POST['sign']=="bas"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Bas <br>
                            <input type="radio" name="sign" value="gauche" id="gauche" <?php if ($sign=="gauche" | (isset($_POST['sign']) && ($_POST['sign']=="gauche"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Gauche 
                            <input type="radio" name="sign" value="droite" id="droite" <?php if ($sign=="droite" | (isset($_POST['sign']) && ($_POST['sign']=="droite"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Droite <br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000"><br>
                            <?php 
                            // echo "<p style='color: black;' id='namelogo'>$logonom</p>";
                            echo "<img class='logoimg' src='img/uploads/$logonom' width='120'>";
                            ?> <br>
                        </div>
                    </div>
                    <p class="trait ele"></p>
                    <div class="form formRS">
                        <div class="col5">
                            <p class="ele">Réseaux sociaux :</p> <br>
                        </div>
                        <div class="col6">
                            <div class="ele">
                                <input type="checkbox" name="rs[]" id="" value="facebook" <?php if (!empty($_POST['rs']) && ($_POST['rs']=="Facebook")) { echo "checked=\"checked\""; } ?>>Facebook
                                <input type="checkbox" name="rs[]" id="" value="twitter" <?php if (isset($_POST['rs']) && $_POST['rs']=="Twitter") { echo "checked=\"checked\""; } ?>>Twitter 
                                <input type="checkbox" name="rs[]" id="" value="instagram" <?php if (isset($_POST['rs']) && $_POST['rs']=="Instagram") { echo "checked=\"checked\""; } ?>>Instagram <br>
                                <input type="checkbox" name="rs[]" id="rs" value="linkedIn" <?php if (isset($_POST['rs']) && $_POST['rs']=="LinkedIn") { echo "checked=\"checked\""; } ?>>LinkedIn 
                                <input type="checkbox" name="rs[]" id="rs" value="youtube" <?php if (isset($_POST['rs']) && $_POST['rs']=="Youtube") { echo "checked=\"checked\""; } ?>>YouTube <br>
                                <input type="radio" name="style" id="" value="StyleUn" style="margin-bottom: 15px; ">Style 1
                                <input type="radio" name="style" id="" value="StyleDeux" style="margin-bottom: 15px; ">Style 2
                                <input type="radio" name="style" id="" value="StyleTrois" style="margin-bottom: 15px; ">Style 3 <br>
                                <div class="champsrs"></div>
                                <input type="submit" name="val" id="okk" value="<?php if (!isset($_POST['rs'])) { echo "Confirmer le style"; } else { echo "Renseigner les réseaux"; } ?>" class="button rs" style="margin-bottom: 15px;">
                            </div> 
                        </div>
                    </div>
                </div>
                <p>Tous les champs précédés d'un "<b> * </b>" sont obligatoires !</p> <br>
                <input type="submit" name="ok" id="okk" value="Confirmer" class="button">
                <input type="submit" value="Deconnexion" name="deco" class="button">
            </form>
        </div>
    </fieldset>
    <?php
    echo "<div class='results'>
        <div class='emplo'>";
            for ($i=0; $i < $empl; $i++) {
                $a=$i+1;
                        echo "<hr style='width: 420px; color: white; margin-bottom: 25px; margin-right: 20px;'>";
                        echo $employ=
                        "<form action=".$_SERVER['PHP_SELF']." method='post' style='max-width: 450px;' class='form_employ form_employ_$i' id='form_employ_$i'>
                            <div class='".$entr."'>
                                <h2 style='color: #FFFFFF; margin-top: 0px; margin-bottom: 25px; padding-left: 15px;'>Employé n° $a</h2>
                                <div class='form' id='".$i."'>
                                    <div class='col5'>
                                        <p>Nom :</p> <br>
                                        <p>Prénom :</p> <br>
                                        <p>Fonction :</p> <br>
                                        <p>Ligne directe :</p> <br>
                                        <p>Mail :</p> <br>
                                    </div>
                                    <div class='col6'>
                                        <input type='text' name='nom_".$i."' id='' class='nom' value='";
                                        if (!empty($_POST['nom_'.$i]))
                                        {
                                            echo $_POST['nom_'.$i];
                                            $_SESSION['nom_'.$i] = $_POST['nom_'.$i];
                                        }
                                        echo "' id='nom_$i' data-name-id='$i' placeholder='Ex : Durand'><br>
                                        <input type='text' name='prenom_".$i."' id='' class='prenom' value=\"";
                                        if (!empty($_POST['prenom_'.$i]))
                                        {
                                            echo $_POST['prenom_'.$i];
                                            $_SESSION['prenom_'.$i] = $_POST['nom_'.$i];
                                        }
                                        echo "\" id='prenom_$i' data-firstname-id='$i' placeholder='Ex : Martin'><br>
                                        <input type='text' name='fonction_".$i."' id='' class='fonction' value=\"";
                                        if (!empty($_POST['fonction_'.$i]))
                                        {
                                            echo $_POST['fonction_'.$i];
                                            $_SESSION['fonction_'.$i] = $_POST['nom_'.$i];
                                        }
                                        echo "\" id='fonction_$i' data-function-id='$i' placeholder='Ex : Stagiaire'><br>
                                        <input type='text' name='ld_".$i."' id='' class='ld' value=\"";
                                        if (!empty($_POST['fonction_'.$i]))
                                        {
                                            echo $_POST['ld_'.$i];
                                            $_SESSION['ld_'.$i] = $_POST['nom_'.$i];
                                        }
                                        echo "\" id='ld_$i' data-ld-id='$i' maxlength='10' placeholder='Ex : 06********'><br>
                                        <input type='email' name='mail_".$i."' id='' class='mail' value=\"";
                                        if (!empty($_POST['mail_'.$i]))
                                        {
                                            echo $_POST['mail_'.$i];
                                            $_SESSION['mail_'.$i] = $_POST['nom_'.$i];
                                        }
                                        echo "\" id='mail_$i' data-mail-id='$i' placeholder='Ex : prenom.nom@mail.fr'>
                                        <input type='submit' name='confirm_".$i."' value='Enregistrer' class='button enregistrer_$i enregistrer' data-form-id='$i' >
                                    </div>
                                </div>
                            </div>
                            <div class='zone' id='zone_$i'></div>
                            <p class='erreur erreur_".$i."'></p>
                        </form>";     
            }
        echo "</div>
              <div class='coldeux' style='display: flex; flex-direction: column; width: 70%;'>
                    <div class='apercu' style='height: 375px; padding: 15px;'></div>
                    <div class='pub'></div>
              </div>
            </div>
        </div>";
        if (isset($_POST['deco']))
        {
            header("Location: index.php");
            session_destroy();
        }
    ?>
    <div class="logonom" data-nom-id="<?php echo $_SESSION['logonom']; ?>"></div>
    <div id="infoRS"></div>
    <div class="employes"></div>
    <div class="values"></div>
</body>
</html>