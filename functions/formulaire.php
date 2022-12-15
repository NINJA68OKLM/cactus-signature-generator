<?php
session_id();
// Connexion à la base de données
$servername = "localhost";
$username = "admin__";
$password = "5YbsW6lVuo4wwh^a";
$dbname = "signature";
$conn = new mysqli($servername, $username, $password, $dbname);
// Requête
$requete= $requete= "SELECT * FROM entreprise WHERE id='".$_COOKIE['idd']."'";
$result = $conn->query($requete);
// Déclaration de cookies généraux pour l'entreprise
$ligne = $result->fetch_array(MYSQLI_ASSOC);
$entr = $ligne["nom"];
$adre = setcookie("adre", $ligne["adresse"], time()+3600);
$adre = $_SESSION['adre']=$ligne['adresse'];
$cp = setcookie("cp", $ligne["cp"], time()+3600);
$vill = setcookie("vill", $ligne["ville"], time()+3600);
$site = setcookie("site", $ligne["site"], time()+3600);
$tel = setcookie("tel", $ligne["tel"], time()+3600);
$logo = setcookie("logo", $ligne["logo"], time()+3600);
$signature = setcookie("signature", $ligne["signature"], time()+3600);
$rs = setcookie("rs", "", time()+3600);
$_SESSION["logonom"] = $_COOKIE['logo'];
// Cookies spécifiques pour chaque employé
for ($z=0; $z < $_COOKIE['nb_client']; $z++) { 
    $_SESSION['nom_'.$z]=$_COOKIE['nom_'.$z];
}

// Changement de la valeur du cookie logo après changement d'image
if (isset($_POST['ok']) | isset($_POST['sign']) | !empty($_POST['entr']) | !empty($_POST['adre']) | !empty($_POST['cp']) | !empty($_POST['vill']) | !empty($_POST['tel']) | !empty($_POST['site']) | !empty($_POST['empl']))
{
    if (isset($_FILES["logo"]) && is_uploaded_file($_FILES["logo"]["tmp_name"]))
    {
        // Importation du logo/image
        $target='img/uploads/'.basename($_FILES['logo']['name']);
        if(move_uploaded_file($_FILES['logo']['tmp_name'],$target)) {
            $fp = fopen($target, "r");
        }
        $_SESSION['logonom']=$_FILES['logo']['name'];
        setcookie("logo", $_SESSION['logonom'], time()+3600);
    }
    $requete = "UPDATE entreprise SET logo='".$_COOKIE['logo']."' WHERE id='".$_COOKIE['bddid']."'";
    $result = $conn->query($requete);
}
?>
<!-- Corps du formulaire -->




<fieldset>
    <div class="gauche">
        <img src="img/logo.png" alt="" style="width: 100%;">
        <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
    </div>
    <div class="droite">
        <h1>Les informations de votre entreprise</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="formprinc" enctype="multipart/form-data">
            <div class="flex">
                <div class="flex" style="flex-direction: column;">
                    <div class="form">
                        <div class="col1">
                            <p>*Nom d'entreprise :</p> <br>
                            <p>*Adresse :</p> <br>
                            <p>*Ville :</p> <br>
                            <p>*Code postal :</p> <br>
                        </div>
                        <div class="col2">
                            <input type="text" name="entr" id="" value="<?php if (!empty($_POST['entr'])) { echo $_POST['entr'] ; } else { echo $_COOKIE['entr']; } ?>"><br>
                            <input type="text" name="adre" id="" value="<?php if (!empty($_POST['adre'])) { echo $_POST['adre'] ; } else { echo $_COOKIE['adre']; } ?>"><br>
                            <input type="text" name="vill" id="" value="<?php if (!empty($_POST['vill'])) { echo $_POST['vill'] ; } else { echo $_COOKIE['vill']; } ?>"><br>
                            <input type="text" name="cp" id="" maxlength="5" value="<?php if (!empty($_POST['cp'])) { echo $_POST['cp'] ; } else { echo $_COOKIE['cp']; } ?>">
                        </div>
                    </div>
                    <div class="form">
                        <div class="col3">
                            <p>*Numéro de teléphone :</p> <br>
                            <p>*Site internet :</p> <br>
                            <p>*Nombre d'employés :</p> <br>
                            <p>*Signature :</p> <br>
                            <p class="plogo">*Logo :</p> <br>
                        </div>
                        <div class="col4">
                            <input type="tel" name="tel" id="" maxlength="10" value="<?php if (!empty($_POST['tel'])) { echo $_POST['tel'] ; } else { echo $_COOKIE['tel']; } ?>"><br>
                            <input type="url" name="site" id="" value="<?php if (!empty($_POST['site'])) { echo $_POST['site'] ; } else { echo $_COOKIE['site']; } ?>"><br>
                            <input type="text" name="empl" id="" value="<?php if (!empty($_POST['empl'])) { echo $_POST['empl'] ; }  else { echo $_COOKIE['empl']; } ?>" class="employ"><br>
                            <input type="radio" name="sign" value="haut" id="haut" <?php if ($_COOKIE['sign']=="haut" | (isset($_POST['sign']) && ($_POST['sign']=="haut"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Haut 
                            <input type="radio" name="sign" value="bas" id="bas" <?php if ($_COOKIE['sign']=="bas" | (isset($_POST['sign']) && ($_POST['sign']=="bas"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Bas <br>
                            <input type="radio" name="sign" value="gauche" id="gauche" <?php if ($_COOKIE['sign']=="gauche" | (isset($_POST['sign']) && ($_POST['sign']=="gauche"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Gauche 
                            <input type="radio" name="sign" value="droite" id="droite" <?php if ($_COOKIE['sign']=="droite" | (isset($_POST['sign']) && ($_POST['sign']=="droite"))) { echo "checked='checked'"; } ?> style="margin-bottom: 10px;"> Droite <br>
                            <br>
                            <?php 
                            // echo "<p style='color: black;' id='namelogo'>$logonom</p>";
                            echo "<img class='logoimg' src='img/uploads/".$_COOKIE['logo']."' width='120'>";
                            ?> <br> 
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                            <input type="file" name="logo" id="files" value=""> <br>
                            <br>
                        </div>
                    </div>
                </div>
                <p class="trait"></p>
                <div class="flex" style="flex-direction: column;">
                    <div class="form formRS">
                        <div class="col5">
                            <p class="ele">Réseaux sociaux :</p> <br>
                        </div>
                        <div class="col6">
                            <div class="ele">
                                <input type="checkbox" name="rs[]" id="" value="facebook" <?php if (!empty($_POST['rs']) && ($_POST['rs']=="Facebook")) { echo "checked=\"checked\""; } ?>>Facebook
                                <input type="checkbox" name="rs[]" id="" value="twitter" <?php if (!empty($_POST['rs']) && ($_POST['rs']=="Twitter")) { echo "checked=\"checked\""; } ?>>Twitter 
                                <input type="checkbox" name="rs[]" id="" value="instagram" <?php if (!empty($_POST['rs']) && ($_POST['rs']=="Instagram")) { echo "checked=\"checked\""; } ?>>Instagram <br>
                                <input type="checkbox" name="rs[]" id="rs" value="linkedIn" <?php if (!empty($_POST['rs']) && ($_POST['rs']=="LinkedIn")) { echo "checked=\"checked\""; } ?>>LinkedIn 
                                <input type="checkbox" name="rs[]" id="rs" value="youtube" <?php if (!empty($_POST['rs']) && ($_POST['rs']=="youtube")) { echo "checked=\"checked\""; } ?>>YouTube <br>
                                <input type="radio" name="style" id="" value="StyleUn" style="margin-bottom: 15px; ">Style 1
                                <input type="radio" name="style" id="" value="StyleDeux" style="margin-bottom: 15px; ">Style 2
                                <input type="radio" name="style" id="" value="StyleTrois" style="margin-bottom: 15px; ">Style 3 <br>
                                <div class="champsrs"></div>
                                <input type="submit" name="val" id="okk" value="<?php if (!isset($_POST['rs'])) { echo "Confirmer le style"; } else { echo "Renseigner les réseaux"; } ?>" class="button rs" style="margin-bottom: 15px;"> <br>
                                <p class="messagerassur"></p>
                            </div> 
                        </div>
                    </div>
                    <div class="form ele" style="display: flex; flex-direction: column;">
                        <div class="col7">
                            <p style="color: #000000 !important;">Styles réseaux sociaux :</p> <br>
                            <img src="img/rendu rs.jpg" alt="Exemple réseaux sociaux" width="185px">
                        </div>
                    </div>
                </div>
            </div>
            <p>Tous les champs précédés d'un "<b> * </b>" sont obligatoires !</p> <br>
            <input type="submit" name="ok" id="okk" value="Enregistrer" class="button">
            <input type="submit" value="Deconnexion" name="deconnexion" class="button">
        </form>
    </div>
    <div id="infoRS"></div>
    <div class="employes"></div>
    <div class="values"></div>
</fieldset>
<!-- Enregistrement des modifications de l'entreprise dans la base de données -->
<?php
if (isset($_POST['ok']) | isset($_POST['sign']) | !empty($_POST['entr']) | !empty($_POST['adre']) | !empty($_POST['cp']) | !empty($_POST['vill']) | !empty($_POST['tel']) | !empty($_POST['site']) | !empty($_POST['empl']))
{
    echo "Ton grand-père l'opposum !";
    $requete = "UPDATE entreprise SET nom='".$_POST['entr']."', adresse='".$_POST['adre']."', tel='".$_POST['tel']."', ville='".$_POST['vill']."', cp='".$_POST['cp']."', site='".$_POST['site']."', employe='".$_POST['empl']."', signature='".$_POST['sign']."' WHERE id='".$_COOKIE['bddid']."'";
    $result = $conn->query($requete);
}
?>