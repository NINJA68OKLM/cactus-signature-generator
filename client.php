<?php
session_start();
session_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style_O.css" media="screen and (min-width: 1200px)">
    <link rel="stylesheet" href="styles/background_2_O.css" media="screen and (min-width: 1200px)">
    <title>Signature Generator</title>
</head>
<body>
<fieldset>
        <div class="gauche">
            <img src="img/logo.png" alt="" style="width: 100%;">
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
            <h1>Besoin de modifier vos informations personnelles ?</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="<?php $entr ?>">
                        <div class="form" id="$i">
                            <div class="col5">
                                <p>Nom :</p> <br>
                                <p>Prénom :</p> <br>
                                <p>Fonction :</p> <br>
                                <p>Ligne directe :</p> <br>
                                <p>Mail :</p> <br>
                            </div>
                            <div class="col6">
                                <input type="text" name="nom $i" id="" value=""><br>
                                <input type="text" name="prenom $i" id="" value=''><br>
                                <input type="text" name="fonction $i" id="" value=""><br>
                                <input type="text" name="ld $i" id="" value=""><br>
                                <input type="text" name="mail $i" id="" value=""> <br>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="confirm" value="Enregistrer" class="button">
                    <input type="submit" value="Aperçu" class="button" style="margin-left: 95px;">
                    <input type="submit" value="Télécharger" class="button">
                </form>
        </div>
        <?php
        if (isset($_POST['Entreprise']))
        {
            header('Location: client.php');
        }
        if (isset($_POST['Client']))
        {
            header('Location: entreprise.php');
        }
        if (isset($_POST['Entreprise']))
        {
            header('Location: espace_client.php');
        }
        ?>
    </fieldset>
</body>
</html>