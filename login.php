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
    <!-- <link rel="stylesheet" href="styles/background_2.css">
    <link rel="stylesheet" href="styles/background_2_O.css" media="screen and (min-width: 1200px)"> -->
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="js/jquery-cookie-master/src/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
    <script src="js/accept-cookie.js"></script>
    <title>Signature Generator : Connexion</title>
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
            <h1>Bienvenue sur Signature Generator</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form">
                    <div class="col1">
                        <p>Identifiant :</p> <br>
                        <p>Mot de passe :</p> <br>
                    </div>
                    <div class="col2">
                        <input type="text" name="identifiant" id="" value="<?php if (!empty($_POST['identifiant'])) { echo $_POST['identifiant'] ; } ?>"><br>
                        <input type="password" name="mdp" id="" value="<?php if (!empty($_POST['mdp'])) { echo $_POST['mdp'] ; } ?>">
                    </div>
                </div>
                <input type="submit" name="ok" value="Confirmer" class="button">
            </form>
        </div>    
    </fieldset>
    <?php
        if (isset($_POST['ok']) && !empty($_POST['identifiant']) && !empty($_POST['mdp']))
        {
            // Connexion à la base de données
            // $requete= "SELECT * FROM employes WHERE ide='".$_POST['identifiant']."' AND mdp='".$_POST['mdp']."'";
            $servername = "localhost";
            $username = "admin__";
            $password = "5YbsW6lVuo4wwh^a";
            $dbname = "signature";
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Vérifie si les identifiants existent dans la base de données
            $requete= "SELECT * FROM employes WHERE ide='".$_POST['identifiant']."' AND mdp='".$_POST['mdp']."'";
            // echo $requete;
            $result = $conn->query($requete);
            if ($result->num_rows >= 1) {
                // Récupération des informations de la personne et déclaration en tant que cookie qui se connecte pour les afficher dans son espace client
                $rechercheinfos = $result -> fetch_array(MYSQLI_ASSOC);
                setcookie("idd", $rechercheinfos["id"], time()+3600);
                // On met en place un cookie de signature pour que le télchargmenet et l'aperçu puisse fonctionner
                $request= "SELECT * FROM entreprise WHERE id='".$rechercheinfos["id"]."'";
                $resultt = $conn->query($request);
                $responsee = $resultt -> fetch_array(MYSQLI_ASSOC);
                // Création d'un tableau pour vérifier quels réseaux sociaux ont des liens vides
                $tabb = array(
                    "facebook" => $responsee["facebook"],
                    "twitter" => $responsee["twitter"],
                    "instagram" => $responsee["instagram"],
                    "linkedin" => $responsee["linkedin"],
                    "youtube" => $responsee["youtube"]
                );
                echo "<br>".$request."<br>";
                // Si la personne authentifié n'est pas administrateur un seul utilisateur lui est affilié dans l'espace client
                if ($rechercheinfos["admin"] == 0)
                {
                    // Mise en place des cokkies employé
                    setcookie("nom_0", $rechercheinfos["nom"], time()+3600);
                    setcookie("prenom_0", $rechercheinfos["prenom"], time()+3600);
                    setcookie("nom_pre_0", $rechercheinfos["nom"], time()+3600);
                    setcookie("prenom_pre_0", $rechercheinfos["prenom"], time()+3600);
                    setcookie("fonction_0", $rechercheinfos["fonction"], time()+3600);
                    setcookie("mail_0", $rechercheinfos["mail"], time()+3600);
                    setcookie("ld_0", $rechercheinfos["ld"], time()+3600);
                    // setcookie("admin_0", $rechercheinfos["admin"], time()+3600);
                    setcookie("idd_0", $rechercheinfos["idd"], time()+3600);
                    setcookie("nb_client", $result->num_rows, time()+3600);
                    // setcookie("bannierenom", $responsee["pub"], time()+3600);
                    // setcookie("rsnbr", $responsee["rsnbr"], time()+3600);
                    // setcookie("rs_style", $responsee["rs_style"], time()+3600);
                    // Cookies d'entreprise
                    // setcookie("entr", $responsee["nom"], time()+3600);
                    
                    // setcookie("signature", $responsee['signature'], time()+3600);
                    foreach ($responsee as $cle => $val) {
                        echo $cle." : ".$val."<br>";
                        if ($cle == "ville")
                        {
                            setcookie("vill", $val, time()+3600);
                        }
                        if ($cle == "nom")
                        {
                            setcookie("entr", $val, time()+3600);
                        }
                        if ($cle == "adresse")
                        {
                            setcookie("adre", $val, time()+3600);
                        }
                        if ($cle == "rs")
                        {
                            $m = 0;
                            foreach ($tabb as $cl => $va) {
                                if ($va !== "")
                                {
                                    setcookie("rs_".$m, $cl, time()+3600);
                                    setcookie("rs_href_".$m, $va, time()+3600);
                                    setcookie("rs_icon_".$m, "<img src='https://generator.agence-cactus.fr/img/Logos/".$responsee['rs_style']."/".$cl.".png'>", time()+3600);
                                    echo "Hihi : ".$va."<br>";
                                    $m++;
                                }
                            }
                        }
                        else
                        {
                            setcookie($cle, $val, time()+3600);
                        }
                    }
                }
                // Sinon tous les employés de l'entreprise le sont
                else
                {
                    // On décide de sélectionner tous les employés de l'entreprise excepté le compte avec admin = 1
                    $drequete = "SELECT * FROM employes WHERE id='".$rechercheinfos["id"]."' AND admin=0";
                    $dresult = $conn->query($drequete);
                    $nb_client = $dresult->fetch_assoc();
                    $l = 0;
                    // Mise en place des cookies des employés
                    setcookie("nb_client", $dresult->num_rows, time()+3600);
                    foreach ($dresult as $cle => $val) {
                        setcookie("nom_".$l, $val["nom"], time()+3600);
                        setcookie("prenom_".$l, $val["prenom"], time()+3600);
                        // setcookie("nom_pre_".$l, $val["nom"], time()+3600);
                        // setcookie("prenom_pre_".$l, $val["prenom"], time()+3600);
                        setcookie("fonction_".$l, $val["fonction"], time()+3600);
                        setcookie("mail_".$l, $val["mail"], time()+3600);
                        setcookie("ld_".$l, $val["ld"], time()+3600);
                        // setcookie("admin_".$l, $val["admin"], time()+3600);
                        setcookie("idd_".$l, $val["idd"], time()+3600);
                        setcookie("nb_client", $dresult->num_rows, time()+3600);
                        echo "<p>Nom ".$l." : ".$val["nom"]."</p>";
                        $l++;
                    }
                    // Mise en place du cookie "id" de l'entrperise pour pouvoir afficher les infos propres à l'entreprise
                    setcookie("bddid", $rechercheinfos["id"], time()+3600);
                    $_SESSION['ide'] = $_POST['identifiant'];
                    $_SESSION['mdp'] = $_POST['mdp'];
                    ?>



                    <?php
                }
                header('Location: client.php');
                ?>
                <?php
            }
            else
            {
                echo "<p class='confirmation' style='margin: 15px;'>L'identifiant où le mot de passe est incorrect !</p>";
            }
            $conn->close();
            
        }
        ?>
</body>
</html>