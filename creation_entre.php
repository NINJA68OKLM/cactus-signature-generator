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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_O.css" media="screen and (min-width: 1200px)">
    <title>Signature Generator</title>
    <script async src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap"></script>
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
    </script>
</head>
<body>
    <fieldset>
        <div class="gauche">
            <img src="img/logo.png" alt="" style="width: 100%;">
            <h1 style="margin-top: 10px; margin-bottom: 0px !important;">Signature Generator</h1>
        </div>
        <div class="droite">
            <h1>Votre entreprise</h1>
            <form enctype="multipart/form-data" action="creation_emplo.php" method="post">
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
                        <p>Numéro de téléphone :</p> <br>
                        <p>Site internet :</p> <br>
                        <p>Nombre d'employés :</p> <br>
                        <p>Signature :</p> <br>
                        <p>Logo :</p> <br>
                    </div>
                    <div class="col4">
                        <input type="text" name="tel" id="" maxlength="10" value="<?php if (!empty($_POST['tel'])) { echo $_POST['tel'] ; } ?>"><br>
                        <input type="text" name="site" id="" value="<?php if (!empty($_POST['site'])) { echo $_POST['site'] ; } ?>"><br>
                        <input type="text" name="empl" id="" value="<?php if (!empty($_POST['empl'])) { echo $_POST['empl'] ; } ?>"><br>
                        <input type="radio" name="sign" value="bloc" id="" <?php if (isset($_POST['sign']) && ($_POST['sign']=="bloc")) { echo "checked='checked'"; } ?>> Bloc 
                        <input type="radio" name="sign" value="colonnes" id="" <?php if (isset($_POST['sign']) && ($_POST['sign']=="colonnes")) { echo "checked='checked'"; } ?>> Colonnes <br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000"><br>
                        <input type="file" name="logo" id="" value="">
                    </div>
                </div>
                <input type="submit" name="ok" value="Confirmer" class="button">
            </form>
        </div>
    </fieldset>
    <?php
    if (isset($_POST['ok']) && isset($_POST['sign']) && !empty($_POST['entr']) && !empty($_POST['adre']) && !empty($_POST['cp']) && !empty($_POST['vill']) && !empty($_POST['tel']) && !empty($_POST['site']) && !empty($_POST['empl']))
    {
        if (!empty( $_FILES["logo"] ) && is_uploaded_file( $_FILES["logo"]["tmp_name"] ) && $_FILES["logo"]["error"] == 0 )
        {
          if (!((int)$_POST['cp']) | strlen($_POST['cp']) < 5 | !((int)$_POST['tel']) | strlen($_POST['tel']) < 10 | !((int)$_POST['empl']))
            {
                echo "<p>Remplissez correctement le formulaire !</p>";
            }
            else
            {
                $_SESSION['logo']=$_FILES['logo'];
                $_SESSION['logonom']=$_FILES['logo']['name'];
                $_SESSION['logo_tmp']=$_FILES['logo']['tmp_name'];
                $_SESSION['entr']=$_POST['entr'];
                $_SESSION['adre']=$_POST['adre'];
                $_SESSION['cp']=$_POST['cp'];
                $_SESSION['vill']=$_POST['vill'];
                $_SESSION['tel']=$_POST['tel'];
                $_SESSION['site']=$_POST['site'];
                $_SESSION['empl']=$_POST['empl'];
                $_SESSION['sign']=$_POST['sign'];
                echo "<script type='text/javascript'> document.location.href('/Proto/creation_emplo.php');</script>";
            }  
        }
        else
        {
            echo $_FILES['logo']['error']."<br>";
            echo "Renseignez une image";
        }
        
    }
    else
    {
        echo "Remplissez le formulaire !";
    }
    // function geocode($address) {
    //     $return = array();
    //     $address = urlencode($address);
    //     $key = "put your key here,,,";
    //     $url = "https://maps.google.com/maps/api/geocode/json?key=$key&address={$address}";
    //     $resp_json = file_get_contents($url);
    //     $resp = json_decode($resp_json, true);
    
    //     if ($resp['status']!=='OK') return false;
    
    //     foreach($resp['results'] as $res) {
    //         $loc = array(
    //             "zipcode"=>null,
    //             "formatted"=>null
    //         );
    
    //         foreach ($res['address_components'] as $comp) {
    //             if (in_array("postal_code", $comp['types'])) 
    //                 $loc['zipcode'] = $comp['short_name'];
    //         }
    
    //         $loc['formatted'] = $res['formatted_address'];
    //         $loc['lng'] = $res['geometry']['location']['lng'];
    //         $loc['lat'] = $res['geometry']['location']['lat'];
    //         $return[] = $loc;
    //     }
    
    //     return $return;
    // }

    ?>
</body>
</html>