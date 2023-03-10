<?php
session_start();
session_id();
// Connexion à la base de données
$servername = "localhost";
$username = "admin__";
$password = "5YbsW6lVuo4wwh^a";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Vérifie si la personne s'est bien authentifié via le login si ce n'est pas le cas, la personne est redirigé
if (isset($_COOKIE['nom_0']) && isset($_COOKIE['prenom_0']) && isset($_COOKIE['mail_0']) && isset($_COOKIE['ld_0']) && isset($_COOKIE['fonction_0']))
{
    // $_COOKIE['logo'];
    $cookie="dd";
}
// Vérification de la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Mise en place d'un cookie avant le head pour ne plus avoir de soucis
setcookie("bannierenom", "", time()+3600);
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
    <title>Signature Generator : Espace client</title>
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="js/jquery-cookie-master/src/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/app.js"></script>
</head>
<style>
    html
    {
        scroll-behavior: smooth;
    }
    .parentretour
    {
        display: none;
        position: fixed;
        bottom: 10px;
        right: 10px;
    }
    .boutonretour
    {
        background: #FFFFFF;
        padding: 15px;
        border-radius: 50%;
        border: 1px solid #000000;
    }
</style>
<body id="loaded">
    <?php
    // Affichage des employés
    // Si la personne authentifié est administrateur on va afficher les informations de l'entreprise qui peuvent êtres modifiables
    if ($_COOKIE['nb_client'] > 1) 
    {
        $servername = "localhost";
        $username = "admin__";
        $password = "5YbsW6lVuo4wwh^a";
        $dbname = "signature";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Récupération de l'id de l'entreprise en cookie "bddid"
        $requete= "SELECT * FROM entreprise WHERE id='".$_COOKIE['bddid']."'";
        $result = $conn->query($requete);
        $result =$result -> fetch_array(MYSQLI_ASSOC);
        // Récupération de la pub et bannière s'il y a eu une modification
        // S'il détecte que le champ de la pub dans la base de données est vide c'est qu'il n'y a eu aucune modification, donc il met le lien du site de l'entreprise par défaut
        if ($result['pub'] !== "" && $result['pub'] !== " ")
        {
            setcookie("pub", $result['pub'], time()+3600);
        }
        // S'il détecte que le champ de la bannière dans la base de données est vide c'est qu'il n'y a eu aucune modification, donc il met la bannière du site du site par défaut
        if ($result['banniere'] !== "" && $result['banniere'] !== " ")
        {
            setcookie("banniere", $result['banniere'], time()+3600);
        }
        else
        {
            setcookie("banniere", $_COOKIE['site'], time()+3600);
        }
        // Mise en place du cookie de bannière qui récupérera le nom de l'image si l'image ets uploadé
        setcookie("bannierenom", $_SESSION['bannierenom'], time()+3600);
        
        // Cookies entreprise
        setcookie("entr", $result["nom"], time()+3600);
        setcookie("adre", $result["adresse"], time()+3600);
        setcookie("vill", $result["ville"], time()+3600);
        setcookie("cp", $result["cp"], time()+3600);
        setcookie("tel", $result["tel"], time()+3600);
        setcookie("site", $result["site"], time()+3600);
        setcookie("empl", $result["employe"], time()+3600);
        setcookie("sign", $result["signature"], time()+3600);
        setcookie("signature", $result["signature"], time()+3600);
        setcookie("logo", $result["logo"], time()+6300); 
        // echo "Cookie base : ".$result['logo'];
        setcookie("rsnbr", $result["rs"], time()+3600);
        setcookie("rs_style", $result["rs_style"], time()+3600);
        // setcookie("facebook", $result["facebook"], time()+3600);
        // setcookie("instagram", $result["instagram"], time()+3600);
        // setcookie("twitter", $result["twitter"], time()+3600);
        // setcookie("linkedin", $result["linkedin"], time()+3600);
        // setcookie("youtube", $result["youtube"], time()+3600);
        // 
        // Sélection de tous les champs de réseaux sociaux
        $requetes= "SELECT facebook, twitter, instagram, youtube, linkedin FROM entreprise WHERE id='".$_COOKIE['idd']."'";
        $results = $conn->query($requetes);
        // Déclaration des cookies
        $tab = ["facebook", "twitter", "instagram", "linkedin", "youtube"];
        // Récupération des réseaux sociaux en vérifiant chacune des valeurs dans la base de données
        foreach ($results as $cle => $val) {
            $ch=0;
            for ($r=0; $r < 5; $r++) {
                // Tant qu'aucune des valeurs n'est vide on déclare la valeur en cookie 
                if ($val[$tab[$r]] !== "")
                {
                    // En-dessous -> exemples pour voir les résultats pris en compte pour voir ce que la base de données retourne
                    // echo $r." : ".$val[$tab[$r]]."<br>";
                //    $svg = file_get_contents("img/Logos/".$_COOKIE['rs_style']."/".$tab[$ch].".svg");
                    setcookie("rs_".$ch, $tab[$r], time()+4600);
                    setcookie("rs_href_".$ch, $val[$tab[$r]], time()+4600);
                    setcookie("rs_icon_".$ch, "<img src='https://generator.agence-cactus.fr/img/Logos/".$_COOKIE['rs_style']."/".$tab[$r].".png'>", time()+3600);
                    // echo $_COOKIE['rs_icon_0'];
                    $ch++; 
                }
            }
        }
        echo $_result['rs'];
        
        // Récupération du formulaire :
        include("functions/formulaire.php");
        // Affichage de l'option pour modifier la publicité
        echo "
        <fieldset>
            <div class='gauche'>
                <img src='img/logo.png' alt='' style='width: 100%;'>
                <h1 style='margin-top: 10px; margin-bottom: 0px !important;'>Signature Generator</h1>
            </div>
            <div class='droite'>
                <h1>Modifier la publicité</h1>
                <form action='". $_SERVER['PHP_SELF'] ."' method='post' class='formprinc' enctype='multipart/form-data'>
                    <div class='form' id='".$i."'>
                        <div class='col5'>
                            <p style='color: #000000 !important;'>Lien :</p> <br>
                            <p style='color: #000000 !important;'>Bannière :</p> <br>
                        </div>
                        <div class='col6'>
                            <!--  Modification du lien de la pub -->
                            <input type='text' name='pub' id='' class='nom' value='";
                            if (!empty($_POST['pub']))
                            {
                                echo $_POST['pub'];
                                $_SESSION['pub'] = $_POST['pub'];
                            }
                            echo "' id='pub' data-name-id='' placeholder='Ex : https://google.com'><br>
                            <!-- Modification de la bannière de la poblicité -->
                            <input type='hidden' name='MAX_FILE_SIZE' value='100000000'> 
                            <input type='file' name='banniere' id='banniere' style='margin-bottom: 15px;'> <br>
                            <input type='submit' name='enregi_confirm' value='Enregistrer' class='button' data-form-id=".$i." > <br> <br>
                            <label for='banniere' id='label_file'> <p name='filename' class='filename'>";
                                // Si on clique sur le bouton l'image de la bannière sera uploadé sur le serveur et stocké sur la base de données
                                if (!empty($_FILES["banniere"]) && is_uploaded_file($_FILES["banniere"]["tmp_name"]))
                                {
                                    // Importation du logo/image
                                    $target='img/uploads/'.basename($_FILES['banniere']['name']);
                                    if(move_uploaded_file($_FILES['banniere']['tmp_name'],$target)) {
                                        $fp = fopen($target, "r");
                                    }
                                    echo "Nom du fichier : ".$_FILES['banniere']['name'];
                                    $_SESSION['bannierenom'] = $_FILES['banniere']['name'];
                                    echo "<p style='color: #000000;'>La bannière a bien été remplacé !</p><br>";
                                    $updateee = "UPDATE entreprise SET banniere='".$_SESSION['bannierenom']."' WHERE id=".$_COOKIE['idd']."";
                                    $conn->query($updateee);
                                    // setcookie("bannierenom", $_SESSION['bannierenom'], time()+3600);
                                }
                                // Si on clique sur le bouton le lien de la publicité sera modifié et remplacé par la base de données
                                if (isset($_POST['enregi_confirm']))
                                {
                                    if (!empty($_POST['pub']))
                                    {
                                        $updatee = "UPDATE entreprise SET pub='".$_POST['pub']."' WHERE id='".$_COOKIE['idd']."'";
                                        $conn->query($updatee);
                                        echo "<p style='color: #000000;'>La publicité a bien été modifié !</p><br>";
                                        setcookie("pub", $_POST['pub'], time()+3600);
                                    }
                                }
                            echo "</p></label>
                            
                        </div>
                    </div>
                </form>
<<<<<<< HEAD
                <div class='confirmutii'><b>Pour que votre bannière ne soit pas déformé, il est recommandé de publier une image d'une résolution de 600x150</b></div>
=======
                <div class='confirmutii'></div>
>>>>>>> f4dbbec0ad4884910deac2ca173971d24997607c
            </div>
        </fieldset>";
        
    }
    // Fin
<<<<<<< HEAD
    echo "<fieldset class='field_client' id='fieldset_client_emplo'>
=======
    echo "<fieldset class='field_client'>
>>>>>>> f4dbbec0ad4884910deac2ca173971d24997607c
                <div class='gauche'>
                    <img src='img/logo.png' alt='' style='width: 100%;'>
                    <h1 style='margin-top: 10px; margin-bottom: 0px !important;'>Signature Generator</h1>
                </div>";
                if ($_COOKIE['nb_client'] == 1)
                {
                  echo "<div class='droite'>
                  <h1>Vos informations personnelles</h1>
                  <form action='".$_SERVER['PHP_SELF']."' method='post' class='formclient_0 formclient'>
                          <div class='".$_COOKIE['nom_0']." formclientt'>
                              <div class='form form_0' id='0'>
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
                                  <div class='croix ".$_COOKIE['nom_0']."'>
                                    <img src='img/croix.png' alt='Icone supression - Signature Generator' loading='lazy' data-form-id='0'>
                                </div>
                              </div>
                          </div>
                          <input type='submit' name='confirm_0' value='Enregistrer' class='button enregsitre_0 enregistrer'>
                          <input type='submit' name='apercu_0' value='Aperçu' class='button apercu_0 apercu_submit' style='margin-left: 95px;'>
                          <a href='signatures/Signature_".$_COOKIE['nom_0']."_".$_COOKIE['prenom_0'].".htm' download value='Télécharger' class='button telecharger button telech' name='telecharger_0' style='border-top: 1px solid #FFF; margin-left: 15px;'>Télécharger</a>
                      </form>
                <div class='reponse_client reponse_client_0'></div>
              </div>";
                }
                else
                {
                  echo "<div class='droite'>
                    <h2 style='font-size: 35px;'>Les employés de votre entreprise</h2>";
                    for ($z=0; $z < $_COOKIE['nb_client']; $z++) { 
                        echo "<form action='".$_SERVER['PHP_SELF']."' method='post' class='formclient_".$z." formclient'>
                                <div class='".$_COOKIE['nom_'.$z]." formclientt'>
                                <h2 style='margin-top: 25px; margin-bottom: 25px; padding-left: 15px;'>Employé n° ".($z+1)."</h2>
                                    <div class='form form_".$z."' id='".$z."'>
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
                                        <div class='croix ".$_COOKIE['nom_'.$z]."'>
                                            <img src='img/croix.png' alt='Icone supression - Signature Generator' loading='lazy' data-form-id='".$z."'>
                                        </div>
                                    </div>
                                </div>
                                <input type='submit' name='confirm_".$z."' value='Enregistrer' class='button enregistrer_".$z." enregistrer'>
                                <input type='submit' name='apercu_".$z."' value='Aperçu' class='button apercu_".$z." apercu_submit' style='margin-left: 95px;'>
                                <a href='signatures/Signature_".$_COOKIE['nom_'.$z]."_".$_COOKIE['prenom_'.$z].".htm' download value='Télécharger' class='button telecharger button telech' name='telecharger_".$z."' style='border-top: 1px solid #FFF; margin-left: 15px;'>Télécharger</a>
                                <!-- <hr class='hrclient' style='background: black; width: 350px; margin-left: 0px;'> -->
                            </form>
                        <div class='reponse_client reponse_client_".$z."'></div>";
                    }
                echo "</div>";
                }
                // Si la personne a déclaré son entreprise mais pas ses employés, on fait une redirection
                if ($_COOKIE['nb_client'] == 0)
                {
                    echo "<div style='display: flex; flex-direction: column;'><p style='color: #000000;'>Il semble que vous ayez déclaré votre entreprise mais pas vos employés</p><br><a href='creation_emplo.php' class='button' style='color: #000000; text-decoration: none; padding: 10px;'>Déclarer les employés</a></div>";
                }
                echo "<div class='droitedeux'>
                    <div class='coldeux' style='display: flex; flex-direction: column; width: 70%;'>
<<<<<<< HEAD
                        <div class='apercu' style='padding: 25px;'>
                            <!-- <div class='pub'>
=======
                        <div class='apercu' style='height: 450px; padding: 25px;'>
                            <div class='pub'>
>>>>>>> f4dbbec0ad4884910deac2ca173971d24997607c
                                <a href='";
                                if (isset($_COOKIE['pub']))
                                {
                                    echo $_COOKIE['pub'];
                                }
                                else
                                {
                                    echo $_COOKIE['site'];
                                }
                                echo "' target='_blank' rel='noopener noreferrer'>
                                    <img src='https://tse2.mm.bing.net/th?id=OIP.zLgHnkbN3rZ_ElIH1PXThgHaE7&pid=Api' alt='' style='width: 600px; height: 150px;'>
                                </a>
<<<<<<< HEAD
                            </div> -->
=======
                            </div>
>>>>>>> f4dbbec0ad4884910deac2ca173971d24997607c
                        </div>
                    </div>
                    <form action='".$_SERVER['PHP_SELF']."' method='post'>
                        <input name='deconnexion' class='button' type='submit' value='Deconnexion' style='margin-top: 105px; margin-left: 85px;'>
                    </form>
                </div>
            </fieldset>";
    ?>
    <!-- Formulaire pour ajouter un employé (affiché seulement pour les admin) -->
    <?php
    if ($_COOKIE['nb_client'] > 1)
    {
        echo "
        <fieldset>
            <div class='gauche'>
                <img src='img/logo.png' alt='' style='width: 100%;'>
                <h1 style='margin-top: 10px; margin-bottom: 0px !important;'>Signature Generator</h1>
            </div>
            <div class='droite'>
                <h1>Ajouter un employé</h1>
                <form action='". $_SERVER['PHP_SELF'] ."' method='post' class='formprinc'>
                    <div class='form ajout_employ' id='".$i."'>
                        <div class='col5'>
                            <p style='color: #000000 !important;'>Nom :</p> <br>
                            <p style='color: #000000 !important;'>Prénom :</p> <br>
                            <p style='color: #000000 !important;'>Fonction :</p> <br>
                            <p style='color: #000000 !important;'>Ligne directe :</p> <br>
                            <p style='color: #000000 !important;'>Mail :</p> <br>
                        </div>
                        <div class='col6'>
                            <input type='text' name='nom' id='' class='nom' value='";
                            if (!empty($_POST['nom']))
                            {
                                echo $_POST['nom'];
                                $_SESSION['nom'] = $_POST['nom'];
                            }
                            echo "' id='nom' data-name-id='' placeholder='Ex : Durand'><br>
                            <input type='text' name='prenom' id='' class='prenom' value='";
                            if (!empty($_POST['prenom']))
                            {
                                echo $_POST['prenom'];
                                $_SESSION['prenom'] = $_POST['prenom'];
                            }
                            echo "' id='prenom' data-firstname-id='' placeholder='Ex : Martin'><br>
                            <input type='text' name='fonction' id='' class='fonction' value='";
                            if (!empty($_POST['fonction']))
                            {
                                echo $_POST['fonction'];
                                $_SESSION['fonction'] = $_POST['fonction'];
                            }
                            echo "' id='fonction' data-function-id='$i' placeholder='Ex : Stagiaire'><br>
                            <input type='tel' name='ld' id='' class='ld' value='";
                            if (!empty($_POST['ld']))
                            {
                                echo $_POST['ld'];
                                $_SESSION['ld'] = $_POST['ld'];
                            }
                            echo "' id='ld' data-ld-id='' maxlength='10' placeholder='Ex : 06********'><br>
                            <input type='email' name='mail' id='' class='mail' value='";
                            if (!empty($_POST['mail']))
                            {
                                        echo $_POST['mail'];
                                        $_SESSION['mail'] = $_POST['mail'];
                            }
                            echo "' id='mail' data-mail-id='' placeholder='Ex : prenom.nom@mail.fr'>
                            <input type='submit' name='confirm' value='Enregistrer' class='button' data-form-id=".$i." >
                        </div>
                    </div>
                </form>
                <div class='confirmuti'></div>
            </div>
        </fieldset>";
    }
    ?>
    <!-- Ajouter le client à la base de données -->
    <?php
    // if (isset($_POST['confirm']))
    // {
    //     $requete= "INSERT INTO employes (id, nom, prenom, mail, ld, fonction, admin, ide, mdp) VALUES ('".$_COOKIE['idd']."', '".$_POST['nom']."', '".$_POST['prenom']."', '".$_POST['mail']."', '".$_POST['ld']."', '".$_POST['fonction']."', 0, '', '')";
    //     $result = $conn->query($requete);
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < 20; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     $ide = strtolower($_SESSION['entr']).".signature-cactus.fr";
    //     $update = "UPDATE employes SET ide='".$ide."', mdp='".$randomString."' WHERE id='".$_COOKIE['idd']."'";
    //     $conn->query($update);
    //     echo "<p>Votre nouvel employé a bien été ajouté !</p>";
    // }
    ?>
    <!-- Bouton pour revenir au début de page -->
    <!-- <a href="#fieldset_client_emplo" class="parentretour">
        <div class="boutonretour">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V6M5 12l7-7 7 7"/></svg>
        </div>
    </a> -->
    <!-- La page est d'abord chargé mais ne reconnait pas les cookies, on actualise la page puis on change l'URL afin qu'il ne recharge pas à l'infini -->
    <script defer type="text/javascript">
        window.onload = function() {
            if(!window.location.hash) {
                window.location = window.location + '#loaded';
                window.location.reload();
            }
        }
    </script>
</body>
</html>