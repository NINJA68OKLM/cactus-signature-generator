<?php
session_start();
session_id();
$_SESSION['hery'];
$_SESSION['hery']= "drdr";
echo $de;
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
$requete= $requete= "SELECT * FROM entreprise WHERE id='".$_COOKIE['idd']."'";
$result = $conn->query($requete);

if ($result->num_rows > 0) {
    $ligne = $result->fetch_array(MYSQLI_ASSOC);
    $entr = $ligne["nom"];
    $adre = setcookie("adre", $ligne["adresse"], time()+3600);
    $adre = setcookie("cp", $ligne["cp"], time()+3600);
    $adre = setcookie("vill", $ligne["ville"], time()+3600);
    $adre = setcookie("site", $ligne["site"], time()+3600);
    $adre = setcookie("tel", $ligne["tel"], time()+3600);
    $adre = setcookie("logo", $ligne["logo"], time()+3600);
    $adre = setcookie("signature", $ligne["signature"], time()+3600);
    $adre = setcookie("rs", "", time()+3600);
    $_SESSION['logonnom'] = $_COOKIE['logo'];
}
// else
// {}
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
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="js/jquery-cookie-master/src/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
</head>
<body>
    <?php
    // echo $_COOKIE['nb_client'];
     if ($_COOKIE['nb_client'] == 1)
     {
        echo "<fieldset class='field_client'>
                <div class='gauche'>
                    <img src='img/logo.png' alt='' style='width: 100%;'>
                    <h1 style='margin-top: 10px; margin-bottom: 0px !important;'>Signature Generator</h1>
                </div>
                <div class='droite'>
                    <h1>Vos informations personnelles</h1>
                    <form action='".$_SERVER['PHP_SELF']."' method='post' class='formclient'>
                            <div class='".$_COOKIE['nom_0']." formclientt'>
                                <div class='form' id='0'>
                                    <div class='col5 client'>
                                        <p>Nom :</p> <br>
                                        <p>Prénom :</p> <br>
                                        <p>Fonction :</p> <br>
                                        <p>Ligne directe :</p> <br>
                                        <p>Mail :</p> <br>
                                    </div>
                                    <div class='col6 client'>
                                        <input type='text' name='nom_0' id='' value='";
                                        if (!empty($_POST['nom_0']))
                                        {
                                            $_COOKIE['nom_0'] = $_POST['nom_0'];
                                            echo $_COOKIE['nom_0'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['nom_0'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='prenom_0' id='' value='";
                                        if (!empty($_POST['prenom_0']))
                                        {
                                            $_COOKIE['prenom_0'] = $_POST['prenom_0'];
                                            echo $_COOKIE['prenom_0'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['prenom_0'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='fonction_0' id='' value='";
                                        if (!empty($_POST['fonction_0']))
                                        {
                                            $_COOKIE['fonction_0'] = $_POST['fonction_0'];
                                            echo $_COOKIE['fonction_0'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['fonction_0'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='ld_0' id='' value='";
                                        if (!empty($_POST['ld_0']))
                                        {
                                            $_COOKIE['ld_0'] = $_POST['ld_0'];
                                            echo $_COOKIE['ld_0'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['ld_0'];
                                        }
                                        echo "'><br>
                                        <input type='text' name='mail_0' id='' value='";
                                        if (!empty($_POST['mail_0']))
                                        {
                                            $_COOKIE['mail_0'] = $_POST['mail_0'];
                                            echo $_COOKIE['mail_0'];
                                        }
                                        else
                                        {
                                            echo $_COOKIE['mail_0'];
                                        }
                                        echo "'> <br>
                                    </div>
                                </div>
                            </div>
                            <input type='submit' name='confirm_0' value='Enregistrer' class='button'>
                            <input type='submit' name='apercu_0' value='Aperçu' class='button apercu_0 apercu_submit' style='margin-left: 95px;'>
                            <input type='submit' value='Télécharger' class='button' name='telecharger_0'>
                        </form>
                </div>
                <div class='droitedeux'>
                    <div class='coldeux' style='display: flex; flex-direction: column; width: 70%;'>
                        <div class='apercu' style='height: 375px; padding: 15px;'></div>
                        <div class='pub'></div>
                    </div>
                    <form action='".$_SERVER['PHP_SELF']."' method='post'>
                        <input name='deconnexion' class='button' type='submit' value='Deconnexion' style='margin-top: 10px; margin-left: 85px;'>
                    </form>
                </div>
            </fieldset>";
     }
     else
     {
        echo "<fieldset class='field_client'>
                <div class='gauche'>
                    <img src='img/logo.png' alt='' style='width: 100%;'>
                    <h1 style='margin-top: 10px; margin-bottom: 0px !important;'>Signature Generator</h1>
                </div>
                <div class='droite'>
                    <h1>Les employés de votre entreprise</h1>";
                    for ($z=0; $z < $_COOKIE['nb_client']; $z++) { 
                        echo "<form action='".$_SERVER['PHP_SELF']."' method='post' class='formclient'>
                                <div class='".$_COOKIE['nom_'.$z]." formclientt'>
                                <h2 style='margin-top: 25px; margin-bottom: 25px; padding-left: 15px;'>Employé n° ".($z+1)."</h2>
                                    <div class='form' id='0'>
                                        <div class='col5 client'>
                                            <p>Nom :</p> <br>
                                            <p>Prénom :</p> <br>
                                            <p>Fonction :</p> <br>
                                            <p>Ligne directe :</p> <br>
                                            <p>Mail :</p> <br>
                                        </div>
                                        <div class='col6 client'>
                                            <input type='text' name='nom_".$z."' id='' value='";
                                            if (!empty($_POST['nom'.$z]))
                                            {
                                                $_COOKIE['nom_'.$z] = $_POST['nom_'.$z];
                                                echo $_COOKIE['nom_'.$z];
                                            }
                                            else
                                            {
                                                echo $_COOKIE['nom_'.$z];
                                            }
                                            echo "'><br>
                                            <input type='text' name='prenom_".$z."' id='' value='";
                                            if (!empty($_POST['prenom'.$z]))
                                            {
                                                $_COOKIE['prenom_'.$z] = $_POST['prenom'.$z];
                                                echo $_COOKIE['prenom_'.$z];
                                            }
                                            else
                                            {
                                                echo $_COOKIE['prenom_'.$z];
                                            }
                                            echo "'><br>
                                            <input type='text' name='fonction_".$z."' id='' value='";
                                            if (!empty($_POST['fonction'.$z]))
                                            {
                                                $_COOKIE['fonction_'.$z] = $_POST['fonction'.$z];
                                                echo $_COOKIE['fonction_'.$z];
                                            }
                                            else
                                            {
                                                echo $_COOKIE['fonction_'.$z];
                                            }
                                            echo "'><br>
                                            <input type='text' name='ld_".$z."' id='' value='";
                                            if (!empty($_POST['ld'.$z]))
                                            {
                                                $_COOKIE['ld_'.$z] = $_POST['ld'.$z];
                                                echo $_COOKIE['ld_'.$z];
                                            }
                                            else
                                            {
                                                echo $_COOKIE['ld_'.$z];
                                            }
                                            echo "'><br>
                                            <input type='text' name='mail_".$z."' id='' value='";
                                            if (!empty($_POST['mail'.$z]))
                                            {
                                                $_COOKIE['mail_'.$z] = $_POST['mail'.$z];
                                                echo $_COOKIE['mail_'.$z];
                                            }
                                            else
                                            {
                                                echo $_COOKIE['mail_'.$z];
                                            }
                                            echo "'> <br>
                                        </div>
                                    </div>
                                </div>
                                <input type='submit' name='confirm_".$z."' value='Enregistrer' class='button enregistrer_".$z."'>
                                <input type='submit' name='apercu_".$z."' value='Aperçu' class='button apercu_".$z." apercu_submit' style='margin-left: 95px;'>
                                <input type='submit' value='Télécharger' class='button' name='telecharger_0'>
                                <!-- <hr class='hrclient' style='background: black; width: 350px; margin-left: 0px;'> -->
                            </form>";
                    }
                echo "</div>
                <div class='droitedeux'>
                    <div class='coldeux' style='display: flex; flex-direction: column; width: 70%;'>
                        <div class='apercu' style='height: 375px; padding: 15px;'></div>
                        <div class='pub'></div>
                    </div>
                    <form action='".$_SERVER['PHP_SELF']."' method='post'>
                        <input name='deconnexion' class='button' type='submit' value='Deconnexion' style='margin-top: 10px; margin-left: 85px;'>
                    </form>
                </div>
                </div>
            </fieldset>";
     }
    ?>
    <!-- <fieldset>
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
    </fieldset> -->
    <?php
    if (isset($_POST['deconnexion']))
    {
        session_destroy();
        header("Location: login.php");
    }
    ?>
</body>
</html>