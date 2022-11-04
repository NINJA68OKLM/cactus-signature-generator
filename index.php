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
    <link rel="stylesheet" href="styles/background_1.css">
    <link rel="stylesheet" href="styles/background_1_O.css" media="screen and (min-width: 1200px)">
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="js/jquery-cookie-master/src/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
    <script src="js/accept-cookie.js"></script>
    <title>Signature Generator</title>
</head>
<body>
    <fieldset>
        <div class="gauche">
            <img src="img/logo.png" alt="" style="width: 100%;">
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
            <h1>Bienvenue sur Signature Generator</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="radio" name="choix" value="creation" id="choix" <?php if (isset($_POST['choix']) && ($_POST['choix']=="creation")) { echo "checked='checked'"; } ?>> Nouvelle entreprise
                <input type="radio" name="choix" value="login" id="choix" <?php if (isset($_POST['choix']) && ($_POST['choix']=="login")) { echo "checked='checked'"; } ?>> Entreprise existante <br><br>
                <input type="submit" name="ok" value="Confirmer" class="button">
            </form>
        </div>
        <?php
        if (isset($_POST['choix']) && ($_POST['choix']=="creation") && isset($_POST['ok']))
        {
            header('Location: creation_entre.php');
        }
        if (isset($_POST['choix']) && ($_POST['choix']=="login") && isset($_POST['ok']))
        {
            header('Location: login.php');
        }
        ?>
    </fieldset>
</body>
</html>