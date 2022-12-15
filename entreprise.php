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
$logo=$_SESSION['logo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style_O.css" media="screen and (min-width: 1200px)">
    <!-- <link rel="stylesheet" href="styles/background_2_O.css" media="screen and (min-width: 1200px)"> -->
    <title>Signature Generator</title>
</head>
<body>
<fieldset>
        <div class="gauche">
            <a href="/">
                <img src="img/logo.png" alt="" style="width: 100%;">
            </a>
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
        <h1>Informations de l'entreprise</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form">
                    <div class="col1">
                        <p>Nom d'entreprise :</p> <br>
                        <p>Adresse :</p> <br>
                        <p>Ville :</p> <br>
                        <p>Code postal :</p> <br>
                    </div>
                    <div class="col2">
                        <input type="text" name="entr" id="" value="<?php echo $entr; ?>"><br>
                        <input type="text" name="adre" id="" value="<?php echo $adre; ?>"><br>
                        <input type="text" name="vill" id="" value="<?php echo $cp; ?>"><br>
                        <input type="text" name="cp" id="" maxlength="5" value="<?php echo $vill; ?>">
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
                        <input type="text" name="tel" id="" maxlength="10" value="<?php echo $tel;?>"><br>
                        <input type="text" name="site" id="" value="<?php echo $site;?>"><br>
                        <input type="text" name="empl" id="" value="<?php echo $empl;?>"><br>
                        <input type="radio" name="sign" value="bloc" id="" <?php if ($sign=="bloc") { echo "checked='checked'"; } ?>> Bloc 
                        <input type="radio" name="sign" value="colonnes" id="" <?php if ($sign=="bloc") { echo "checked='checked'"; } ?>> Colonnes <br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000"><br>
                        <input type="file" name="logo" id="">
                    </div>
                </div>
                <input type="submit" name="ok" value="Confirmer" class="button">

                <input type="submit" value="Aperçu" class="button" style="margin-left: 95px;">
                <input type="submit" value="telécharger" class="button">
            </form>
        </div>
    </fieldset>
    <?php
    if (isset($_POST['ok']))
    {
        if (!((int)$_POST['cp']) | strlen($_POST['cp']) < 5 | !((int)$_POST['tel']) | strlen($_POST['tel']) < 10 | !((int)$_POST['empl']))
        {
            echo "<p>Remplissez correctement le formulaire !</p>";
        }
        else
        {
            $_SESSION['logo']=$logo;
            $_SESSION['entr']=$entr;
            $_SESSION['adre']=$adre;
            $_SESSION['cp']=$cp;
            $_SESSION['vill']=$vill;
            $_SESSION['tel']=$tel;
            $_SESSION['site']=$site;
            $_SESSION['empl']=$empl;
            $_SESSION['sign']=$sign;
            $_SESSION['logo']=$logo;
            echo "Vos informations ont étés enregistrés !";
        }
    }
    ?>
</body>
</html>