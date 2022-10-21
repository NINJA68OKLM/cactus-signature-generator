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
    <link rel="stylesheet" href="styles/background_2.css">
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
            $username = "root";
            $password = "";
            $dbname = "signature";
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Vérifie si les identifiants existent dans la base de données
            $requete= "SELECT * FROM employes WHERE ide='".$_POST['identifiant']."' AND mdp='".$_POST['mdp']."'";
            echo $requete;
            $result = $conn->query($requete);
            if ($result->num_rows >= 1) {
                // echo "<p class='confirmation' style='margin: 15px;'>Vous allez être redirigé vers votre espace client.</p>";
                // Récupération des informations de la personne et déclaration en tant que cookie qui se connecte pour les afficher dans son espace client
                $rechercheinfos = $result -> fetch_array(MYSQLI_ASSOC);
                setcookie("idd", $rechercheinfos["id"], time()+3600);
                // echo "<br>Admin : ".$rechercheinfos["admin"]."<br>";
                // Si la personne authentifié n'est pas administrateur un seul utilisateur lui est affilié dans l'espace client
                if ($rechercheinfos["admin"] == 0)
                {
                    setcookie("nom_0", $rechercheinfos["nom"], time()+3600);
                    setcookie("prenom_0", $rechercheinfos["prenom"], time()+3600);
                    setcookie("fonction_0", $rechercheinfos["fonction"], time()+3600);
                    setcookie("mail_0", $rechercheinfos["mail"], time()+3600);
                    setcookie("ld_0", $rechercheinfos["ld"], time()+3600);
                    setcookie("admin_0", $rechercheinfos["admin"], time()+3600);
                    setcookie("nb_client", $result->num_rows, time()+3600);
                }
                // Sinon tous les employés de l'entreprise le sont
                else
                {
                    $drequete = "SELECT * FROM employes WHERE id='".$rechercheinfos["id"]."'";
                    // echo $drequete;
                    $dresult = $conn->query($drequete);
                    $nb_client = $dresult->fetch_assoc();
                    var_dump($dresult->num_rows);
                    $l = 0;
                    setcookie("nb_client", $dresult->num_rows, time()+3600);
                    foreach ($dresult as $cle => $val) {
                        setcookie("nom_".$l, $val["nom"], time()+3600);
                        setcookie("prenom_".$l, $val["prenom"], time()+3600);
                        setcookie("fonction_".$l, $val["fonction"], time()+3600);
                        setcookie("mail_".$l, $val["mail"], time()+3600);
                        setcookie("ld_".$l, $val["ld"], time()+3600);
                        setcookie("admin_".$l, $val["admin"], time()+3600);
                        $l++;
                    }
                }
                header('Location: client_test.php');
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