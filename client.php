<?php
session_start();
session_id();
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérification de la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Recherche du nom de l'entreprise de l'employé
$requete= $requete= "SELECT nom FROM entreprise WHERE id='".$_COOKIE['idd']."'";
$result = $conn->query($requete);

if ($result->num_rows > 0) {
    $ligne = $result->fetch_array(MYSQLI_ASSOC);
    $entr = $ligne["nom"];
    echo $entr;
  echo "<p class='confirmation' style='margin: 15px;'>L'entreprise a été trouvé et c'est : ".$entr."</p>";
}
else
{}
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
    <?php
    // echo $_COOKIE['nb_client'];
     if ($_COOKIE['nb_client'] == 1)
     {
        echo "<fieldset>
                <div class='gauche'>
                    <img src='img/logo.png' alt='' style='width: 100%;'>
                    <h1 style='margin-top: 10px; margin-bottom: 0px !important;'>Signature Generator</h1>
                </div>
                <div class='droite'>
                    <h1>Vos informations personnelles</h1>
                    <form action='".$_SERVER['PHP_SELF']."' method='post'>
                            <div class='ekkkiiiiz'>
                                <div class='form' id='0'>
                                    <div class='col5 client'>
                                        <p>Nom :</p> <br>
                                        <p>Prénom :</p> <br>
                                        <p>Fonction :</p> <br>
                                        <p>Ligne directe :</p> <br>
                                        <p>Mail :</p> <br>
                                    </div>
                                    <div class='col6'>
                                        <input type='text' name='nom' id='' value='";
                                        if (!empty($_POST['nom']))
                                        {
                                            $_COOKIE['nom'] = $_POST['nom'];
                                            echo $_COOKIE['nom'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['nom'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='prenom' id='' value='";
                                        if (!empty($_POST['prenom']))
                                        {
                                            $_COOKIE['prenom'] = $_POST['prenom'];
                                            echo $_COOKIE['prenom'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['prenom'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='fonction' id='' value='";
                                        if (!empty($_POST['fonction']))
                                        {
                                            $_COOKIE['fonction'] = $_POST['fonction'];
                                            echo $_COOKIE['fonction'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['nom'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='ld' id='' value='";
                                        if (!empty($_POST['ld']))
                                        {
                                            $_COOKIE['ld'] = $_POST['ld'];
                                            echo $_COOKIE['ld'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['ld'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='mail' id='' value='";
                                        if (!empty($_POST['mail']))
                                        {
                                            $_COOKIE['mail'] = $_POST['mail'];
                                            echo $_COOKIE['mail'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['mail'];
                                        }
                                        echo "'> <br>
                                    </div>
                                </div>
                            </div>
                            <input type='submit' name='confirm' value='Enregistrer' class='button'>
                            <input type='submit' value='Aperçu' class='button' style='margin-left: 95px;'>
                            <input type='submit' value='Télécharger' class='button' name='telecharger_0'>
                        </form>
                </div>
                <?php
                ?>
            </fieldset>";
     }
     else
     {
        echo "<fieldset>
                <div class='gauche'>
                    <img src='img/logo.png' alt='' style='width: 100%;'>
                    <h1 style='margin-top: 10px; margin-bottom: 0px !important;'>Signature Generator</h1>
                </div>
                <div class='droite'>
                    <h1>Les informations de votre entreprise</h1>
                    <form action='".$_SERVER['PHP_SELF']."' method='post'>
                            <div class='ekkkiiiiz'>
                                <div class='form' id='0'>
                                    <div class='col5 client'>
                                        <p>Nom :</p> <br>
                                        <p>Prénom :</p> <br>
                                        <p>Fonction :</p> <br>
                                        <p>Ligne directe :</p> <br>
                                        <p>Mail :</p> <br>
                                    </div>
                                    <div class='col6'>
                                        <input type='text' name='nom' id='' value='";
                                        if (!empty($_POST['nom']))
                                        {
                                            $_COOKIE['nom'] = $_POST['nom'];
                                            echo $_COOKIE['nom'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['nom'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='prenom' id='' value='";
                                        if (!empty($_POST['prenom']))
                                        {
                                            $_COOKIE['prenom'] = $_POST['prenom'];
                                            echo $_COOKIE['prenom'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['prenom'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='fonction' id='' value='";
                                        if (!empty($_POST['fonction']))
                                        {
                                            $_COOKIE['fonction'] = $_POST['fonction'];
                                            echo $_COOKIE['fonction'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['nom'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='ld' id='' value='";
                                        if (!empty($_POST['ld']))
                                        {
                                            $_COOKIE['ld'] = $_POST['ld'];
                                            echo $_COOKIE['ld'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['ld'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='mail' id='' value='";
                                        if (!empty($_POST['mail']))
                                        {
                                            $_COOKIE['mail'] = $_POST['mail'];
                                            echo $_COOKIE['mail'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['mail'];
                                        }
                                        echo "'> <br>
                                    </div>
                                </div>
                            </div>
                            <input type='submit' name='confirm' value='Enregistrer' class='button'>
                            <input type='submit' value='Aperçu' class='button' style='margin-left: 95px;'>
                            <input type='submit' value='Télécharger' class='button' name='telecharger_0'>
                        </form>
                </div>
                <?php
                ?>
            </fieldset>";
     }
    ?>
    <fieldset>
        <div class="gauche">
            <img src="img/logo.png" alt="" style="width: 100%;">
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
            <h1>Vos informations personnelles ?</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="<?php $entr ?>">
                        <div class="form" id="$i">
                            <div class="col5 client">
                                <p>Nom :</p> <br>
                                <p>Prénom :</p> <br>
                                <p>Fonction :</p> <br>
                                <p>Ligne directe :</p> <br>
                                <p>Mail :</p> <br>
                            </div>
                            <div class="col6">
                                <input type="text" name="nom_0" id="" value="<?php if (!empty($_POST['nom'])) { $_COOKIE['nom'] = $_POST['nom']; echo $_COOKIE['nom']; } else { echo $_COOKIE['nom']; } ?>"><br>
                                <input type="text" name="prenom_0" id="" value="<?php if (!empty($_POST['prenom'])) { $_COOKIE['prenom'] = $_POST['prenom']; echo $_COOKIE['prenom']; } else { echo $_COOKIE['prenom']; } ?>"><br>
                                <input type="text" name="fonction_0" id="" value="<?php if (!empty($_POST['fonction'])) { $_COOKIE['fonction'] = $_POST['fonction']; echo $_COOKIE['fonction']; } else { echo $_COOKIE['nom']; } ?>"><br>
                                <input type="text" name="ld_0" id="" value="<?php if (!empty($_POST['ld'])) { $_COOKIE['ld'] = $_POST['ld']; echo $_COOKIE['ld']; } else { echo $_COOKIE['ld']; } ?>"><br>
                                <input type="text" name="mail_0" id="" value="<?php if (!empty($_POST['mail'])) { $_COOKIE['mail'] = $_POST['mail']; echo $_COOKIE['mail']; } else { echo $_COOKIE['mail']; } ?>"> <br>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="confirm" value="Enregistrer" class="button">
                    <input type="submit" value="Aperçu" class="button" style="margin-left: 95px;">
                    <input type="submit" value="Télécharger" class="button" name="telecharger_0">
                </form>
        </div>
        <?php
        ?>
    </fieldset>
</body>
</html>