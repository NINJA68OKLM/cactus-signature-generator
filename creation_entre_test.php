<?php
session_start();
session_id();
// Importation de PHPMailer
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require 'path/to/PHPMailer-master/src/Exception.php';
// require 'path/to/PHPMailer-master/src/PHPMailer.php';
// require 'path/to/PHPMailer-master/src/SMTP.php';
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
    <!-- <script async src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <script type="text/javascript">
        function initialize() {
                var options = {
                types: ['(cities)'],
            };
            var input = document.getElementById('ville');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script> -->
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="js/jquery-cookie-master/src/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
</head>
<body>
    <fieldset>
        <div class="gauche">
            <img src="img/logo.png" alt="" style="width: 100%;">
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
            <h1>Votre entreprise</h1>
            <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form_entre">
                <div class="form">
                    <div class="col1">
                        <p>Nom d'entreprise :</p> <br>
                        <p>Adresse :</p> <br>
                        <p>Ville :</p> <br>
                        <p>Code postal :</p> <br>
                    </div>
                    <div class="col2">
                        <input type="text" name="entr" id="" value="<?php if (!empty($_POST['entr'])) { echo $_POST['entr'] ; } ?>"><br>
                        <input type="text" name="adre" id="" value="<?php if (!empty($_POST['adre'])) { echo $_POST['adre'] ; } ?>"><br>
                        <input type="text" name="vill" id="" value="<?php if (!empty($_POST['vill'])) { echo $_POST['vill'] ; } ?>" id="ville" autocomplete="on"><br>
                        <input type="text" name="cp" id="" maxlength="5" value="<?php if (!empty($_POST['cp'])) { echo $_POST['cp'] ; } ?>">
                    </div>
                </div>
                <div class="form">
                    <div class="col3">
                        <p>Numéro de teléphone :</p> <br>
                        <p>Adresse mail</p> <br>
                        <p>Site internet :</p> <br>
                        <p>Nombre d'employés :</p> <br>
                        <p>Signature :</p> <br>
                        <p style="margin-top: 25px;">Logo :</p> <br>
                    </div>
                    <div class="col4">
                        <input type="text" name="tel" id="" maxlength="10" value="<?php if (!empty($_POST['tel'])) { echo $_POST['tel'] ; } ?>"><br>
                        <input type="email" name="adrmail" id="" value="<?php if (!empty($_POST['adrmail'])) { echo $_POST['adrmail'] ; } ?>"><br>
                        <input type="text" name="site" id="" value="<?php if (!empty($_POST['site'])) { echo $_POST['site'] ; } ?>"><br>
                        <input type="text" name="empl" id="" value="<?php if (!empty($_POST['empl'])) { echo $_POST['empl'] ; } ?>"><br>
                        <input type="radio" name="sign" value="haut" id="" <?php if (isset($_POST['sign']) && ($_POST['sign']=="haut")) { echo "checked='checked'"; } ?>> Haut 
                        <input type="radio" name="sign" value="bas" id="" <?php if (isset($_POST['sign']) && ($_POST['sign']=="bas")) { echo "checked='checked'"; } ?>> Bas <br>
                        <input type="radio" name="sign" value="gauche" id="" <?php if (isset($_POST['sign']) && ($_POST['sign']=="gauche")) { echo "checked='checked'"; } ?>> Gauche 
                        <input type="radio" name="sign" value="droite" id="" <?php if (isset($_POST['sign']) && ($_POST['sign']=="droite")) { echo "checked='checked'"; } ?>> Droite <br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000000"> <br class="br">
                        <input type="file" name="logo" id="files" value=""> <br>
                        <label for="files" id="label_file" style="display: none;"> <div class="file" style="color: black;">Parcourir...</div> <p name="filename" class="filename"> <?php
                            if (!empty($_FILES["logo"]) && is_uploaded_file($_FILES["logo"]["tmp_name"]))
                            {
                                // Importation du logo/image
                                $target='img/uploads/'.basename($_FILES['logo']['name']);
                                if(move_uploaded_file($_FILES['logo']['tmp_name'],$target)) {
                                    $fp = fopen($target, "r");
                                }
                                $_SESSION['logonom']=$_FILES['logo']['name'];
                                echo $_SESSION['logonom'];
                            }
                            else
                            {
                                echo "Aucun fichier selectionné...";
                            }
                        ?></p></label>
                    </div>
                </div>
                <input type="submit" name="ok" value="Déclarez l'entreprise" class="button entre_decla"> 
                <input type="submit" name="next" value="Déclarez les employés" class="button entre_confirm" style="display: none;">
                <input type="submit" name="connex" value="Connexion" class="button entre_connex" style="display: none;">
            </form>
        </div>
    </fieldset>
    <?php
    if (isset($_POST['ok']) && isset($_POST['sign']) && !empty($_POST['entr']) && !empty($_POST['adre']) && !empty($_POST['cp']) && !empty($_POST['vill']) && !empty($_POST['tel']) && filter_var($_POST['adrmail'], FILTER_VALIDATE_EMAIL) && !empty($_POST['site']))
    {
        if (!empty($_POST['empl']))
        {
            // Valeurs des champs récupérés en tant que variables de sessions
            $logo = $_FILES["logo"]["name"];
            $_SESSION['logo']=$_FILES['logo'];
            $_SESSION['logonom']=$_FILES['logo']['name'];
            $_SESSION['logo_tmp']=$_FILES['logo']['tmp_name'];
            $_SESSION['entr']=$_POST['entr'];
            $_SESSION['adre']=$_POST['adre'];
            $_SESSION['cp']=$_POST['cp'];
            $_SESSION['vill']=$_POST['vill'];
            $_SESSION['tel']=$_POST['tel'];
            $_SESSION['adrmail']=$_POST['adrmail'];
            $_SESSION['site']=$_POST['site'];
            $_SESSION['empl']=$_POST['empl'];
            $_SESSION['sign']=$_POST['sign'];
            // Enregistrement de l'entreprise dans la base de données
            // Connexion à la base de données
            $requete= "SELECT * FROM entreprise WHERE nom='".$_SESSION['entr']."'";
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "signature";
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Vérifie si l'entreprise existe déjà exite dans la base de données
            $requete= "SELECT * FROM entreprise WHERE nom='".$_SESSION['entr']."'";
            $result = $conn->query($requete);
            if ($result->num_rows > 0) {
                echo "<p class='confirmation' style='margin: 15px;'>Cette entreprise existe déjà dans notre base de données !</p>";
            }
            else {
                $sql = "INSERT INTO entreprise (nom, adresse, tel, ville, cp, site, employe, signature, logo, rs, ide, mdp) VALUES ('".$_SESSION['entr']."', '".$_SESSION['adre']."', ".$_SESSION['tel'].", '".$_SESSION['vill']."', ".$_SESSION['cp'].", '".$_SESSION['site']."', ".$_SESSION['empl'].", '".$_SESSION['sign']."', '".$_SESSION['logonom']."', '', '', '')";
                // echo $sql."<br>"; 
                $conn->query($sql);
                if ($conn->query($sql) === TRUE) {
                    // Message pour déclarer les employés
                    echo "<p class='confirmation' style='margin: 15px;'>Votre entreprise a bien été enregistré dans notre base de données ! A présent déclarez vos employés.</p><br>";
                    echo "<p class='confirmation' style='margin: 15px;'>Vos identifiants vous ont étés envoyés par mail</p>";
                    // Génération des identifiants
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 20; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $ide = strtolower($_SESSION['entr']).".signature-cactus.fr";
                    // Enregistrement des identifiants dans la base de données
                    $update = "UPDATE entreprise SET ide='".$ide."', mdp='".$randomString."' WHERE nom='".$_SESSION['entr']."'";
                    // echo $update;
                    $conn->query($update);
                    // Remettre le code de "select_id.php" au cas où
    ?>
    <script>
        // Récupération de l'id de l'entreprise dans la bdd et déclaration en tant que cookie pour la réutiliser plus tard
        jQuery(function ($) {
            $.get("select_id.php", function(data) {
                console.log(data)
                $.cookie("bddid", data)
            })
        })
    </script>
    <?php
                    // Envoi du mail
                    $to      = ''.$_POST['adrmail'].'';
                    $subject = 'Identifiants entreprise Signature Generator';
                    $message = 'Voici vos identifiants pour l\'accès à votre espace client dans Signature Generator : <br> Identifiant : '.$ide.'<br> Mot de passe : '.$randomString.'.<br> Ne répondez pas, ceci est un message automatique.';
                    $headers = 'From: support@signature-generator.com' . "\r\n" .
                               'Reply-To: support@signature-generator.com' . "\r\n" .
                               'X-Mailer: PHP/' . phpversion();

                    // mail($to, $subject, $message, $headers);

                    $destinataire = ''.$_POST['adrmail'].'';
                    $expediteur   = 'support.signature-generator@gmail.com';
                    $reponse      = $expediteur;
                    echo "Ce script envoie un mail à $destinataire ".
                        "en précisant que l'expediteur est $expediteur ".
                        "et que la réponse doit être envoyée à $reponse";
                    mail($destinataire,
                        $subject,
                        $message,
                        "From: $expediteur\r\nReply-To: $reponse");


                    // Nouvel essai

                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->Host = '127.0.0.1';               //Adresse IP ou DNS du serveur SMTP
                    // $mail->Port = 465;                          //Port TCP du serveur SMTP
                    $mail->Port = 3306;
                    $mail->SMTPAuth = 1;                        //Utiliser l'identification

                    if($mail->SMTPAuth){
                        $mail->SMTPSecure = 'ssl';               //Protocole de sécurisation des échanges avec le SMTP
                        $mail->Username   =  'support@gmail.com';   //Adresse email à utiliser
                        $mail->Password   =  'password';         //Mot de passe de l'adresse email à utiliser    
                    }
                    // Format de l'email
                    $mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères
                    $mail->smtpConnect();
                    $mail->From       =  'support@signature-generator@ovh.com';                //L'email à afficher pour l'envoi
                    $mail->FromName   = 'Contact de ovh.net';             //L'alias à afficher pour l'envoi
                    $mail->Subject    =  $subject;                      //Le sujet du mail
                    $mail->WordWrap   = 50; 			                   //Nombre de caracteres pour le retour a la ligne automatique
                    $mail->AltBody = $message; 	       //Texte brut
                    $mail->IsHTML(false);                                  //Préciser qu'il faut utiliser le texte brut

                    // if($Use_HTML == true){
                    // $mail->MsgHTML('<div>Mon message en <code>HTML</code></div>'); 		                //Le contenu au format HTML
                    // $mail->IsHTML(true);
                    // }
                    if (!$mail->send()) {
                        echo $mail->ErrorInfo;
                    } else{
                        echo 'Message bien envoyé';
                    }
                } else {
                    echo "<p class='confirmation' style='margin: 15px;'>Un problème a été détecté, veuillez réessayer plus tard</p>";
                }
            }
            $conn->close();
        }
    }
    else
    {
        echo "<p style='margin: 15px;'>Remplissez le formulaire</p>";
    }
    ?>
    <p class="message"></p>
</body>
</html>