jQuery(function ($) {
    
    // Expressions régulières
    var maj = /^[A-Z]/
    // var ld = /^[0][0-9]{9}$/
    // var mail = /^[a-zA-Z]{4,}.[a-z]{1,}@[a-z]{1,}[-.][a-z]{2,3}$/
    var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    // var sw = /^w{3}.[a-z]{3,}.[a-z]{2,3}$/

    // creation_entre.php
    
    // Affichage du bouton pour la redirection vers la déclaration d'employés ou la connexion
    if (window.location.href.indexOf("/creation_entre.php")!=-1) {
        if ($("[name='tel']").val()!== "" && $("[name='site']").val()!== "" && $("[name='empl']").val()!== "" && $("[name='sign']").val()!=="" && $("[name='entr']").val()!== "" && $("[name='adre']").val()!== "" && $("[name='vill']").val()!== "" && $("[name='vill']").val().match(maj) && $("[name='cp']").val()!== "" && $(".filename").html() !== " Aucun fichier selectionné...") {
            if ($(".confirmation").html() !== "Votre entreprise a bien été enregistré dans notre base de données ! A présent déclarez vos employés.")
            {
                $(".entre_connex").css("display", "initial")
                $(".entre_confirm").css("display", "none")
            }
            else
            {
                $(".entre_connex").css("display", "none")
                $(".entre_confirm").css("display", "initial")
            }
            $(".entre_decla, [name='logo'], .br").css("display", "none")
            $("#label_file").css("display", "flex")
        }
    }

    // Remplissage du formulaire
    // Clic sur "Déclarez vos employés"
    $(".form_entre .entre_confirm").on("click", function (e) {
        e.preventDefault()
        // Redirection lors de la validation du formulaire
        setTimeout(function () {
            window.location.replace("creation_emplo.php")
        }, 1000)
    })
    // Clic sur "Connexion"
    $(".form_entre .entre_connex").on("click", function (e) {
        e.preventDefault()
        // Redirection lors de la validation du formulaire
        setTimeout(function () {
            window.location.replace("login.php")
        }, 1000)
    })

    // creation_emplo.php

    if ($(".logoimg").attr("src") ==  "img/uploads/")
    {
        console.log("erreur rt")
    }
    // Redirection au cas où un internaute tenterait d'accéder à la page sans avoir déclaré l'entreprise
    // if (window.location.href.indexOf(window.location.host+"/Proto/creation_emplo_test.php")!=-1)
    if (window.location.href.indexOf("/creation_emplo.php")!=-1)
    {
        if ($("[name='tel']").val()== "" && $("[name='site']").val()== "" && $("[name='empl']").val()== "" && $("[name='sign']").val("") && $("[name='entr']").val()== "" && $("[name='adre']").val()== "" && $("[name='vill']").val()== "" && $("[name='cp']").val()== "" && $(".logoimg").attr("src") ==  "img/uploads/")
        {
            window.location.replace("creation_entre.php")
        }
    }

    // Employés à déclarer
    $(document).on("click", ".enregistrer", function (e) {
        e.preventDefault()
        let emptyfield = false
        var fild = []
        const formId = $(this).data('formId')
        $.cookie("formid", formId)
        const form = "#form_employ_" + formId
        const zone = "#zone_" + formId
        const tableau = $(form).serializeArray()
        $.each(tableau, function (index, field) {
            // Toujours utile de garder le morceau de code en-dessous en guise d'exemple
            // if (field.value === "" && ((field.value = "nom") === "") && ((field.value = "prenom") === "") && ((field.value = "fonction") === "") && ((field.value = "ld") === "") && ((field.value = "mail") === "")) {
            //     alert("Remplissez tous les champs du formulaire")
            //     $(".erreur_" + formId).text("Remplissez tous les champs du formulaire")
            //     emptyfield = true
            //     return emptyfield;

            // }
            // On insère la valeur des champs dans un tableau
            fild.push(field.value)
            
        })

        // Si on détecte d'une seule valeur est vide ou comporte juste un espace
        if (fild.indexOf("")!==-1 | fild.indexOf(" ")!==-1)
        {
            $(zone).html("")
            $(".erreur_" + formId).text("Remplissez tous les champs du formulaire")
            emptyfield=true
            return emptyfield
        }

        // Enregistrement d'un employé si tous les champs sont bien remplies
        if (emptyfield==false && $.isNumeric($("[name='ld_" + formId + "']").val()) && $("[name='ld_" + formId + "']").val().length >= 10 && $("[name='nom_" + formId + "']").val().match(maj) && $("[name='prenom_" + formId + "']").val().match(maj) && $("[name='fonction_" + formId + "']").val().match(maj) && $("[name='mail_" + formId + "']").val().match(mail)) {
            // Création des cookies pour le téléchargement et l'insertion des employés dans la base de données
            var nomm= $("[name='nom_"+formId+"']").val()
            var prenomm= $("[name='prenom_"+formId+"']").val()
            var fonctionm= $("[name='fonction_"+formId+"']").val()
            var ldm= $("[name='ld_"+formId+"']").val()
            var mailm= $("[name='mail_"+formId+"']").val()
            $.cookie("nom_"+formId, nomm)
            $.cookie("prenom_"+formId, prenomm)
            $.cookie("fonction_"+formId, fonctionm)
            $.cookie("ld_"+formId, ldm)
            $.cookie("mail_"+formId, mailm)
            $.cookie("id", formId)
            // Appel du fichier "insert_database.php" pour enregistrer les employés
            $.get("functions/insert_database.php", function(data){
                console.log(data)
                $("#zone_"+formId+">p").html(data)
            })
            // Aperçu des RS
            $(".trait.ele").css("display", "initial")
            $(".champsrs").css("display", "initial")
            $(".formRS").css("display", "flex")
            // Création des boutons d'aperçu, de téléchargement et de connexion
            $(zone).html("<p style='margin-left: 15px; font-weight: bold;'>La signature de cette personne a bien été créé !</p> <br> <div style='display: flex; justify-content: left;'><input type='submit' name='apercu_" + formId + "' value='Aperçu' class='button apercu_submit' id='apercu_" + formId + "' style='margin-left: 15px;' data-form-id='" + formId + "'> <a href='signatures/Signature_"+$("[name='nom_"+formId+"']").val()+"_"+$("[name='prenom_"+formId+"']").val()+".htm' download class='button telecharger' style='border-top: 1px solid #FFF; margin-left: 15px;' data-form-id='"+ formId +"' name='telecharger_" + formId + "'> Télécharger </a> <a class='button connexion' style='border-top: 1px solid #FFF; margin-left: 15px;' href='/login.php'>Connexion</a> </div>");
            // Signatures
            var signaturehaut = `<table style="font-family:Arial, Helvetica, sans-serif !important; margin-right:0; margin-left:auto; line-height:19px; width: 100%; " cellpadding="0" cellspacing="0" id="table">
                    <tbody>
                        <tr style="font-size: 14px;">
                            <!-- Identité -->
                            <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
                                <span>
                                <!-- Michel Platinni -->
                                    <img src="img/uploads/${$(".logonom").data("nomId")}" alt="agence-cactus.fr" style="max-height:150px; height:auto; border:0;" height="150">
                                </span>
                                <br>
                                <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif;">${$("[name='prenom_" + formId + "']").val()} ${$("[name='nom_" + formId + "']").val().toUpperCase()}</span>
                                <br>
                                <!-- Poste -->
                                    <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
                                        ${$("[name='fonction_" + formId + "']").val()}
                                    </span>
                                    <br>
                                <!-- Mail -->
                                    <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;"><a href="${$("[name='mail_" + formId + "']").val()}" style="color: rgb(100, 99, 99); text-decoration: none;">${$("[name='mail_" + formId + "']").val()}</a></span>
                                <br>
                                    <!-- Numéro de teléphone -->
                                <span style="font-weight: bold; color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;">
                                    Tél : <a style="color: rgb(100, 99, 99); text-decoration: none;" href="tel:${$("[name='ld_" + formId + "']").val()}">${$("[name='ld_" + formId + "']").val()} (ligne directe)</a>
                                </span>
                                <br> <br> 
                                <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                    ${$("[name='adre']").val()}, ${$("[name='cp']").val()} ${$("[name='vill']").val()}
                                </span>
                                <br>
                                <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                    Tél : <a href="tel: ${$("[name='tel']").val()}" style="color: #156cad; text-decoration: none;">${$("[name='tel']").val()}</a>
                                </span>
                                <br>
                                <span style="display: flex;" class='cacher'>
                                    <!-- Site web -->
                                    <span style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
                                        <a style="color: #156cad; text-decoration: none;" href="${$("[name='site']").val()}">${$("[name='site']").val()}</a>
                                    </span>
                                    <span class="signRS" style='display: flex; margin-left: 5px;'></span> 
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>`
            var signaturebas = `<table style="font-family:Arial, Helvetica, sans-serif !important; margin-right:0; margin-left:auto; line-height:19px; width: 100%; " cellpadding="0" cellspacing="0" id="table">
                    <tbody>
                        <tr style="font-size: 14px;">
                            <!-- Identité -->
                            <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
                                <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif;">${$("[name='prenom_" + formId + "']").val()} ${$("[name='nom_" + formId + "']").val().toUpperCase()}</span>
                                <br>
                            <!-- Poste -->
                                <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
                                    ${$("[name='fonction_" + formId + "']").val()}
                                </span>
                                <br>
                            <!-- Mail -->
                                <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;"><a href="${$("[name='mail_" + formId + "']").val()}" style="color: rgb(100, 99, 99); text-decoration: none;">${$("[name='mail_" + formId + "']").val()}</a></span>
                            <br>
                                <!-- Numéro de teléphone -->
                            <span style="font-weight: bold; color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;">
                                Tél : <a style="color: rgb(100, 99, 99); text-decoration: none;" href="tel:${$("[name='ld_" + formId + "']").val()}">${$("[name='ld_" + formId + "']").val()} (ligne directe)</a>
                            </span>
                            <br> <br> 
                            <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                ${$("[name='adre']").val()}, ${$("[name='cp']").val()} ${$("[name='vill']").val()}
                            </span>
                            <br>
                            <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                Tél : <a href="tel: ${$("[name='tel']").val()}" style="color: #156cad; text-decoration: none;">${$("[name='tel']").val()}</a>
                            </span>
                            <br>
                            <span style="display: flex;" class='cacher'>
                                <!-- Site web -->
                                <span style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
                                    <a style="color: #156cad; text-decoration: none;" href="${$("[name='site']").val()}">${$("[name='site']").val()}</a>
                                </span>
                                <span class="signRS" style='display: flex; margin-left: 5px;'></span> 
                            </span>
                            <br>
                            <span>
                                <img src="img/uploads/${$(".logonom").data("nomId")}" alt="agence-cactus.fr" style="max-height:150px; height:auto; border:0;" height="150">
                            </span>
                            </td>
                        </tr>
                    </tbody>
                </table>`
            var signaturegauche = `<div style="font-family: Arial, Helvetica, sans-serif !important; min-height: 250px; min-width: 320px; max-width: 650px; min-height: 250px; display: flex; align-items: center">
                                            <table style="padding: 2px; border-style: none; border-color: black; border-style: none; border-collapse: inherit; direction: ltr; width: 100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:1pt; vertical-align:top; width: 95px;" valign="top">               
                                                            <table style="" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <!-- Logo ou photo de profil d'une largeur de 150 px -->
                                                                        <td style="height:55px; vertical-align:top;" valign="top">
                                                                            <img src="img/uploads/${$(".logonom").data("nomId")}" style="border:0;" height="70">
                                                                        </td>
                                                                    </tr>      
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="padding-left:5px; text-align: left; vertical-align:top; " valign="top">
                                                            <table style=" margin-right:0; margin-left:auto; line-height:19px; width: 100%; height: 100%; " cellpadding="0" cellspacing="0" id="table">
                                                                <tbody>
                                                                    <tr style="font-size: 14px;">
                                                                        <!-- Identité -->
                                                                        <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
                                                                            <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif !important;">${$("[name='prenom_" + formId + "']").val()} ${$("[name='nom_" + formId + "']").val().toUpperCase()}</span>
                                                                            <br>
                                                                        <!-- Poste -->
                                                                            <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
                                                                                ${$("[name='fonction_" + formId + "']").val()}
                                                                            </span>
                                                                            <br>
                                                                        <!-- Mail -->
                                                                            <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important;"><a href="mailto:${$("[name='mail_" + formId + "']").val()}" style="color: rgb(100, 99, 99); text-decoration: none;">${$("[name='mail_" + formId + "']").val()}</a></span>
                                                                            <br>
                                                                            <!-- Numéro de téléphone -->
                                                                        <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important; font-weight: bold;">
                                                                            Tél : <a style="text-decoration: none; color: rgb(100, 99, 99);" href="tel:${$("[name='ld_" + formId + "']").val()}">${$("[name='ld_" + formId + "']").val()} (ligne directe)</a>
                                                                        </span>
                                                                        <br> <br> 
                                                                        <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                                                            ${$("[name='adre']").val()}, ${$("[name='cp']").val()} ${$("[name='vill']").val()}
                                                                        </span>
                                                                        <br>
                                                                        <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                                                            Tél : <a href="tel: ${$("[name='tel']").val()}" style="color: #156cad; text-decoration: none;">${$("[name='tel']").val()}</a>
                                                                        </span>
                                                                        <br>
                                                                        <span style="display: flex;" class='cacher'>
                                                                            <!-- Site web -->
                                                                            <span style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
                                                                                <a style="color: #156cad; text-decoration: none;" href="${$("[name='site']").val()}">${$("[name='site']").val()}</a>
                                                                            </span>
                                                                            <span class="signRS" style='display: flex; margin-left: 5px;'></span> 
                                                                        </span>
                                                                        <div class="signRS" style="display: flex;"></div>
                                                                        </td>
                                                                    </tr>
                                                                        
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> `
            var signaturegauche = `<div style="font-family: Arial, Helvetica, sans-serif !important; min-height: 250px; min-width: 320px; max-width: 650px; min-height: 250px; display: flex; align-items: center">
                                            <table style="padding: 2px; border-style: none; border-color: black; border-style: none; border-collapse: inherit; direction: ltr; width: 100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:1pt; vertical-align:top; width: 95px;" valign="top">               
                                                            <table style="" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <!-- Logo ou photo de profil d'une largeur de 150 px -->
                                                                        <td style="height:55px; vertical-align:top;" valign="top">
                                                                            <img src="img/uploads/${$(".logonom").data("nomId")}" style="border:0;" height="70">
                                                                        </td>
                                                                    </tr>      
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="padding-left:5px; text-align: left; vertical-align:top; " valign="top">
                                                            <table style=" margin-right:0; margin-left:auto; line-height:19px; width: 100%; height: 100%; " cellpadding="0" cellspacing="0" id="table">
                                                                <tbody>
                                                                    <tr style="font-size: 14px;">
                                                                        <!-- Identité -->
                                                                        <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
                                                                            <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif !important;">${$("[name='prenom_" + formId + "']").val()} ${$("[name='nom_" + formId + "']").val().toUpperCase()}</span>
                                                                            <br>
                                                                        <!-- Poste -->
                                                                            <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
                                                                                ${$("[name='fonction_" + formId + "']").val()}
                                                                            </span>
                                                                            <br>
                                                                        <!-- Mail -->
                                                                            <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important;"><a href="mailto:${$("[name='mail_" + formId + "']").val()}" style="color: rgb(100, 99, 99); text-decoration: none;">${$("[name='mail_" + formId + "']").val()}</a></span>
                                                                            <br>
                                                                            <!-- Numéro de téléphone -->
                                                                        <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important; font-weight: bold;">
                                                                            Tél : <a style="text-decoration: none; color: rgb(100, 99, 99);" href="tel:${$("[name='ld_" + formId + "']").val()}">${$("[name='ld_" + formId + "']").val()} (ligne directe)</a>
                                                                        </span>
                                                                        <br> <br> 
                                                                        <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                                                            ${$("[name='adre']").val()}, ${$("[name='cp']").val()} ${$("[name='vill']").val()}
                                                                        </span>
                                                                        <br>
                                                                        <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                                                            Tél : <a href="tel: ${$("[name='tel']").val()}" style="color: #156cad; text-decoration: none;">${$("[name='tel']").val()}</a>
                                                                        </span>
                                                                        <br>
                                                                        <span style="display: flex;" class='cacher'>
                                                                            <!-- Site web -->
                                                                            <span style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
                                                                                <a style="color: #156cad; text-decoration: none;" href="${$("[name='site']").val()}">${$("[name='site']").val()}</a>
                                                                            </span>
                                                                            <span class="signRS" style='display: flex; margin-left: 5px;'></span> 
                                                                        </span>
                                                                        <div class="signRS" style="display: flex;"></div>
                                                                        </td>
                                                                    </tr>
                                                                        
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> `
            var signaturedroite = `<div style="font-family: Arial, Helvetica, sans-serif !important; min-height: 250px; min-width: 320px; max-width: 650px; min-height: 250px; display: flex; align-items: center">
                                        <table style="padding: 2px; border-style: none; border-color: black; border-style: none; border-collapse: inherit; direction: ltr; min-width: 320px" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="padding-left:5px; text-align: left; vertical-align:top; " valign="top">
                                                        <table style=" margin-right:0; margin-left:auto; line-height:19px; width: 235px; height: 100%; " cellpadding="0" cellspacing="0" id="table">
                                                            <tbody>
                                                                <tr style="font-size: 14px;">
                                                                    <!-- Identité -->
                                                                    <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
                                                                        <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif !important;">${$("[name='prenom_" + formId + "']").val()} ${$("[name='nom_" + formId + "']").val().toUpperCase()}</span>
                                                                        <br>
                                                                    <!-- Poste -->
                                                                        <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
                                                                            ${$("[name='fonction_" + formId + "']").val()}
                                                                        </span>
                                                                        <br>
                                                                    <!-- Mail -->
                                                                        <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important;"><a href="mailto:${$("[name='mail_" + formId + "']").val()}" style="color: rgb(100, 99, 99); text-decoration: none;">${$("[name='mail_" + formId + "']").val()}</a></span>
                                                                        <br>
                                                                        <!-- Numéro de téléphone -->
                                                                    <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif !important; font-weight: bold;">
                                                                        Tél : <a style="text-decoration: none; color: rgb(100, 99, 99);" href="tel:${$("[name='ld_" + formId + "']").val()}">${$("[name='ld_" + formId + "']").val()} (ligne directe)</a>
                                                                    </span>
                                                                    <div class="signRS" style="display: flex;"></div>
                                                                    </td>
                                                                </tr>
                                                                    
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td style="font-size:1pt; vertical-align:top; width: 95px;" valign="top">               
                                                        <table style="" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <!-- Logo ou photo de profil d'une largeur de 150 px -->
                                                                    <td style="height:55px; vertical-align:top;" valign="top">
                                                                        <img src="img/uploads/${$(".logonom").data("nomId")}" style="border:0;" height="70">
                                                                    </td>
                                                                </tr>      
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> `

            // Affichage de l'aperçu
            $(".apercu_submit").on("click", function (e) {
                e.preventDefault()
                // Changement d'aperçu en fonction du choix de signature
                if ($("#haut").prop("checked")) {
                    $(".apercu").html(signaturehaut)
                //         +`<div class='pub'>
                //     <a href='${site}' target='_blank' rel='noopener noreferrer'>
                //         <img src='img/${banniere}' alt='' style='width: 600px; height: 150px; margin-top: 15px;'>
                //     </a>
                // </div>`)
                }
                if ($("#bas").prop("checked")) {
                    $(".apercu").html(signaturebas)
                //     +`<div class='pub'>
                //     <a href='${site}' target='_blank' rel='noopener noreferrer'>
                //         <img src='img/${banniere}' alt='' style='width: 600px; height: 150px; margin-top: 15px;'>
                //     </a>
                // </div>`)
                }
                if ($("#gauche").prop("checked")) {
                    $(".apercu").html(signaturegauche)
                //     +`<div class='pub'>
                //     <a href='${site}' target='_blank' rel='noopener noreferrer'>
                //         <img src='img/${banniere}' alt='' style='width: 600px; height: 150px; margin-top: 15px;'>
                //     </a>
                // </div>`)
                }
                if ($("#droite").prop("checked")) {
                    $(".apercu").html(signaturedroite)
                //     +`<div class='pub'>
                //     <a href='${site}' target='_blank' rel='noopener noreferrer'>
                //         <img src='img/${banniere}' alt='' style='width: 600px; height: 150px; margin-top: 15px;'>
                //     </a>
                // </div>`)
                }
                // Intégration des RS  
                if ($(".RS").length > 0) {
                    var RS = []
                    var icones = $(".signRS").html()
                    $.each($(".RS"), function (l, k) {
                        var valeur = $(".RS:eq(" + l + ")").data("id")
                        var href = $(".URL:eq(" + l + ")").val()
                        RS.push(valeur)
                        icones = $(".signRS").html()
                        $(".signRS").append(`<span style="margin-left: 5px; margin-top: 3px;">
                                                    <a style="text-decoration: none;" href="${href}" target="_blank" rel="noopener noreferrer" style="" >
                                                        <div style="display: flex; width: 14px; height: 14px; justify-content: space-between;" class="icon ${valeur}"></div>
                                                    </a>
                                                </span>`)
                        $.cookie("rs_href_"+l, href)
                        readFiles()
                        function readFiles() {
                            // $.get('img/Logos/' + $("[name='style']:checked").val() + '/' + valeur + '.svg', function (data) {
                            //     $(".icon." + valeur).html(data)
                            //     console.log(data)
                            //     $.cookie("rs_icon_"+l, data)
                            //     return data
                            // }, "html");
                            // $.get('img/Logos/' + $("[name='style']:checked").val() + '/' + valeur + '.png', function (data) {
                            //     $(".icon." + valeur).html("<img width='14' height='14' src='"+data+"'>")
                            //     console.log(data)
                            //     $.cookie("rs_icon_"+l, data)
                            //     return data
                            // }, "html");
                            $(".icon." + valeur).html("<img width='14' height='14' src='https://generator.agence-cactus.fr/img/Logos/" + $("[name='style']:checked").val() + "/" + valeur + ".png'>")
                            $.cookie("rs_icon_"+l, "img/Logos/" + $("[name='style']:checked").val() + "/" + valeur + ".png")
                            console.log($.cookie("rs_icon_"+l))
                        }
                    })
                }
            })
            $(".erreur_" + formId).text("")
        }
        
        // Téléchargement
        $("[name='telecharger_"+formId+"']").on("click", function () {
            $.get("functions/download.php", function(data){
                console.log(data)
                $("[id='zone_"+formId+"']").append("<b>"+data+"</b>")
            })    
        })
    })
    
    // Gestion des réseaux sociaux
    $(document).on("click", ".rs", function (e) {
        e.preventDefault()
        if ($("[name='style']").is(":checked")) {
            var check = [];
            ($("input[type='checkbox']:checked").prop("checked", true)).each(function (c) {
                check.push($(this).val());
                // Suppresion de la première valeur "bloc" inutile
                var myIndex = check.indexOf('bloc');
                if (myIndex !== -1) {
                    check.splice(myIndex, 1);
                }
                // Aperçu du formulaire pour les RS
                $(".pp, .style").css("display", "initial")
                $(".rs").val("Enregistrer les liens")
                // Récupération des cases à cocher pour les liens des RS             
                return check
            })
            
            // Génération des champs pour les liens des RS
            $(".champsrs").html("")
            for (let r = 0; r < check.length; r++) {
                $(".champsrs").append(`<input type="url" name="${check[r]}" id="" placeholder="URL ${check[r]}" class="URL" value=""><br>`)
            }
            console.log("check :"+check)
            $(".champsrs > :first-child").css("margin-top", "15px")
                
            // Récupération des styles de RS
            if ($(".rs").val() == "Enregistrer les liens") {
                $.cookie("rs_style", $("[name='style']:checked").val())
                // console.log("Cookie :"+$("[name='style']").is(":checked"))
                // $("body").append(`<div class="values"></div>`)
                $(".rs").on("click", function () {
                    $(".values").html(" ")
                    $("#infoRS").html(" ")
                    // Stockage des RS
                    $.each(check, function (q, a) {
                        if ($("[name='" + check[q] + "']").val() !== "") {
                            console.log("Stockage")
                            $("#infoRS").append(`<div class="RS" data-id="${check[q]}"></div>`)
                            $(".values").append(`<div class="RSvalue" data-id="${$("[name='" + check[q] + "']").val()}"></div>`)
                            // Ajout des réseaux sociaux sur la version téléchargeable
                            var rsnbr = check.length
                            $.cookie("rsnbr", rsnbr)
                            $.cookie("rs_"+q, a)
                            console.log("HREF :"+check[q])
                        }
                    })
                    for (let d = 0; d < check.length; d++) {
                        $.cookie("rs_href_"+d, $(".URL:eq("+d+")").val(), { expires:-1, path: '/' })
                        $.cookie("rs_"+d, check[d], { expires:-1, path: '/' })
                        $.cookie("rs_href_"+d, $(".URL:eq("+d+")").val())
                        $.cookie("rs_"+d, check[d])
                        
                    }
                    // Enregistrement des informations propres aux réseaux sociaux dans la base de données
                    $.get("functions/add_social_media.php", function(data){
                        console.log(data)
                        $(".messagerassur").html("Les réseaux sociaux ont bien étés enregistrés")
                        window.location.reload()
                    })
                })
            }
            if ($(".RSvalue").length > 0)
            {
                $.each(check, function (q, a) {
                    var RSvalue = $(".RSvalue:eq("+q+")").data("id")
                    $(".URL:eq("+q+")").val(RSvalue)
                })
            }
        }
    })

    // Zone d'aperçu
    // Mise en place de la publicité
    if (typeof $.cookie('pub') === 'undefined')
    {
        console.log("Non définie")
        var site = $.cookie("site")
    }
    else
    {
        console.log("Défini")
        site = $.cookie("pub")
    }
    if (typeof $.cookie('banniere') === 'undefined')
    // if (typeof $.cookie('bannierenom') === 'undefined')
    {
        console.log("Non définie")
        // var banniere = $.cookie("banniere", "banniere.png")
        var banniere = 'banniere.png'
    }
    else
    {
        console.log("Défini")
        banniere = "uploads/"+$.cookie("banniere")
    }
    // Mise en place de la publicité
    $(".apercu").html(`<div style='display: flex; justify-content: center; align-items: center; width: 100%; height: 290px;'>
                            <strong>APERCU</strong>
                        </div>
                        <!-- <a href='${site}' target='_blank' rel='noopener noreferrer'>
                            <img src='img/${banniere}' alt='' style='width: 600px; height: 150px; margin-top: 15px;'>
                        </a> -->`)

    // client.php

    // Redirection au cas où on tenterait d'accéder à l'epsace client sans s'être authentifié
    // if (window.location.href.indexOf("client.php")!=-1)
    // {
    //     if (typeof $.cookie('nom_0') === 'undefined' && typeof $.cookie('prenom_0') === 'undefined' && typeof $.cookie('fonction_0') === 'undefined' &&typeof $.cookie('mail_0') === 'undefined' && typeof $.cookie('admin_0') === 'undefined' && typeof $.cookie('ld_0') === 'undefined' && typeof $.cookie('nb_client') === 'undefined' && typeof $.cookie('idd_0') === 'undefined')
    //     {
    //         window.location.replace("/login.php")
    //     }
    // }
    
    
    if (window.location.href.indexOf("client.php")!=-1)
    {
        // On vérifie si la zone des employés est visible à l'écran, s'il l'est on affiche le bouton pour le retour au début de page
        // while ($("#fieldset_client_emplo").is(":visible")) {
        //     $(".parentretour").css("display", "initial")
        // }

        // Affichage de l'aperçu Espace Client
        $(".apercu_submit").on("click", function (w) {
            w.preventDefault()
            var tab = $(this).attr("name")
            var tabb = tab.split('_')
            // console.log(tabb)
            formId = tabb[1]
            // Création du cookie Id pour l'apercu et le téléchargement
            $.cookie("id", tabb[1])
            console.log($.cookie("id"))
            // Afficher l'URL sans le "https://" et éventuellement le "/" s'il est présent
            // var url = $(".cacher>span>a").html().split("/")
            // console.log(url)
            // console.log(url[2])
            // url = url[2]
            // $.cookie("sitee", url)
            // $(".cacher>span>a").html(url)
            // Changement d'aperçu en fonction du choix de signature
            $.get("objects/signature"+$.cookie("signature")+"c.php", function(data) {
                $(".apercu").html(data)
                // +`<div class='pub'>
                //     <a href='${site}' target='_blank' rel='noopener noreferrer'>
                //         <img src='img/${banniere}' alt='' style='width: 600px; height: 150px; margin-top: 15px;'>
                //     </a>
                // </div>`)
                $(".apercu").css("height", "")
            }, "text")
            
        })
        
        // Fonction de téléchargement
        $(".button.telech").on("click", function (b) {
        // $("[name='telecharger_"+tabb[1]+"']").on("click", function (b) {
            b.preventDefault()
            var tab = $(this).attr("name")
            console.log(tab)
            var tabb = tab.split('_')
            formId = tabb[1]
            // Appel du fichier pour générer le fichier HTML et télécharger le fichier sur le client
            $.get("functions/download_client.php", function(data){
                console.log(data)
                $.cookie("id", formId)
                var structure = $(".formclient_"+formId).html()
                $(".formclient_"+formId).html(structure+"<br>"+data)
            })
        })
        
        // On enregistre dans des cookies la valeur des champs avant modification de l'internaute
        // for (let bn = 0; bn < $.cookie("nb_client"); bn++) {
        //     $.cookie("nom_pre_"+bn, $("[name='nom_"+bn+"']").val())
        //     $.cookie("prenom_pre_"+bn, $("[name='prenom_"+bn+"']").val())
        //     // $.cookie("fonction_pre_"+bn, $("[name='fonction_"+bn+"']").val())
        // }

        // Même fonction mais fonctionnelle
        $("[type='text']").focus(function() {
            console.log("Oh jaja")
            var tab = $(this).attr("name")
            console.log(tab)
            var tabb = tab.split('_')
            formId = tabb[1]
            $.cookie("nom_pre_"+formId, $("[name='nom_"+formId+"']").val())
            $.cookie("prenom_pre_"+formId, $("[name='prenom_"+formId+"']").val())
        })

        // Fonction d'enregistrement/modification dans la base de données
        $(".enregistrer").on("click", function (f) {
            f.preventDefault()
            var tab = $(this).attr("name")
            console.log(tab)
            var tabb = tab.split('_')
            formId = tabb[1]

            
            
            $.cookie("id", formId)
            console.log("formID est égal à :"+$.cookie("id"))
            // Vérifie qu'on a pas modifié les données pas des valeurs vides
            if ($("[name='nom_"+formId+"']").val()!=="" && $("[name='prenom_"+formId+"']").val()!=="" && $("[name='mail_"+formId+"']").val()!=="" && $("[name='ld_"+formId+"']").val()!=="" && $("[name='fonction_"+formId+"']").val()!=="")
            {
                $.cookie("nom_"+formId, $("[name='nom_"+formId+"']").val())
                $.cookie("prenom_"+formId, $("[name='prenom_"+formId+"']").val())
                $.cookie("mail_"+formId, $("[name='mail_"+formId+"']").val())
                $.cookie("ld_"+formId, $("[name='ld_"+formId+"']").val())
                $.cookie("fonction_"+formId, $("[name='fonction_"+formId+"']").val())
                // Appel du fichier pour générer le fichier HTML et télécharger le fichier sur le client
                $.get("functions/client_save.php", function(data){
                    console.log(data)
                    console.log("nom_pre enregistré")
                    // $.cookie("nom_pre_"+$.cookie("id"), $("[name='nom_"+$.cookie("id")+"']").val())
                    // $.cookie("prenom_pre_"+$.cookie("id"), $("[name='prenom_"+$.cookie("id")+"']").val())
                })
                $(".reponse_client"+formId).text("Vos modifications ont bien étés enregistrés !")
            }
        })

        // Suppression d'un utilisateur
        $(".croix>img").on("click", function (g) {
            g.preventDefault()
            console.log('image détecté')
            var tab = $(this).attr("name")
            
            formId = $(this).data("formId")
            console.log(formId)
            $.cookie("id", formId)
            // Suppression du formulaire correspondant à l'employé
            $("#"+formId).parent().parent().remove()
            // Appel du fichier pour générer le fichier HTML et télécharger le fichier sur le client
            $.get("functions/client_delete.php", function(data){
                console.log(data)
                // Suppression des cookies liés au formulaire supprimé
                $.removeCookie("nom_"+formId)
                $.removeCookie("prenom_"+formId)
                $.removeCookie("mail_"+formId)
                $.removeCookie("ld_"+formId)
                $.removeCookie("fonction_"+formId)
                $.removeCookie("admin_"+formId)
            })
            
            // Actualisation du nombre d'employés après la suppression du formulaire
            $.cookie("nb_client", $(".formclientt").length)
            // Nouvelle déclaration des cookies
            for (let j = formId; j < $.cookie("nb_client"); j++) {
                // $("#"+formId).parent().parent().remove()
                // Alternance des valeurs
                $.cookie("nom_"+j, $("[name='nom_"+(j+1)+"']").val())
                $.cookie("prenom_"+j, $("[name='prenom_"+(j+1)+"']").val())
                $.cookie("mail_"+j, $("[name='mail_"+(j+1)+"']").val())
                $.cookie("ld_"+j, $("[name='ld_"+(j+1)+"']").val())
                $.cookie("fonction_"+j, $("[name='fonction_"+(j+1)+"']").val())
                $.cookie("admin_"+j, $("[name='admin_"+(j+1)+"']").val())
                $.cookie("idd_"+j, $.cookie("idd_"+(j+1)))
                // Renommage des id
                $(".form_"+(j+1)).attr("id", j)
                // Renommage des champs
                $("[name='nom_"+(j+1)+"']").attr("name", "nom_"+j)
                $("[name='prenom_"+(j+1)+"']").attr("name", "prenom_"+j)
                $("[name='mail_"+(j+1)+"']").attr("name", "mail_"+j)
                $("[name='ld_"+(j+1)+"']").attr("name", "ld_"+j)
                $("[name='fonction_"+(j+1)+"']").attr("name", "fonction_"+j)
                $("[name='confirm_"+(j+1)+"']").attr("name", "confirm_"+j)
                $("[name='apercu_"+(j+1)+"']").attr("name", "apercu_"+j)
                $("[name='telecharger_"+(j+1)+"']").attr("name", "telecharger_"+j)
                // Renommage des classes
                $("[name='telecharger_"+(j+1)+"']").attr("class", "button enregistrer_"+j+" enregistrer")
                $("[name='apercu_"+(j+1)+"']").attr("class", "button apercu_"+j+" apercu_submit")
                $("img[data-form-id='"+(j+1)+"']").attr("data-form-id", j)
                // Changement du numéro des employé dans les titres H2
                $(".formclient_"+(j+1)+">div>h2").html("Employé n° "+j)
            }

            // console.log($(".formclient>div>h2"))
            $.each($(".formclient>div>h2"), function (x, y)
            {
                console.log(y)
                $(y).html("Employé n°"+(x+1))
            })

            // Actualisation des numéros des employés
            $(".reponse_client_"+formId).text("L'employé a bien été supprimé !")
            $(".reponse_client_"+formId).css("margin", "15px 0px")

            // Enregistrement dans la base de données
            $("[name='empl']").val($.cookie("nb_client"))
            $("[name='ok']").click()
        })

        // Fonction d'ajout de client
        $("[name='confirm']").on("click", function (g) {
            g.preventDefault()
            console.log("Nombre : "+$.cookie("nb_client"))
            let nb_client = parseInt($.cookie("nb_client"))
            // Si les champs ont étés remplis in crée les cookies qui permettront de stocker l'utilisateur et l'ajouter à la liste
            if ($(".ajout_employ>.col6>.nom").val()!== "" && $(".ajout_employ>.col6>.prenom").val()!== "" && $(".ajout_employ>.col6>.mail").val()!== "" && $(".ajout_employ>.col6>.ld").val()!== "" && $(".ajout_employ>.col6>.fonction").val()!== "")
            {
                // Déclaration des cookies nécessaires au bon fonctionnement de l'enregistrement
                $.cookie("nom", $(".ajout_employ>.col6>.nom").val())
                $.cookie("prenom", $(".ajout_employ>.col6>.prenom").val())
                $.cookie("fonction", $(".ajout_employ>.col6>.fonction").val())
                $.cookie("mail", $(".ajout_employ>.col6>.mail").val())
                $.cookie("ld", $(".ajout_employ>.col6>.ld").val())
                console.log($(".ajout_employ>.col6>.nom").val())
                var contenu = $("fieldset:last>form").html()
                
                $.get("functions/add_client.php", function(data){
                    var new_nb = $.cookie("nb_client", $.cookie("nb_client")-1)
                    console.log($.cookie("nb_client"))
                    $.cookie("nom_"+$.cookie("nb_client"), $("[name='nom']").val())
                    $.cookie("prenom_"+$.cookie("nb_client"), $("[name='prenom']").val())
                    $.cookie("mail_"+$.cookie("nb_client"), $("[name='mail']").val())
                    $.cookie("fonction_"+$.cookie("nb_client"), $("[name='fonction']").val())
                    $.cookie("ld_"+$.cookie("nb_client"), $("[name='ld']").val())
                    console.log(data)

                    $(".confirmuti").append(data)
                    // console.log($(".confirmuti"))
                    // console.log($.cookie("nom_"+nb))
                })
                // On ajoute le nouvel employé
                let nb = $.cookie("nb_client")
                var recognize = "nom_"+($.cookie("nb_client"));
                var recognizee = "prenom_"+($.cookie("nb_client"));
                var nommm = $.cookie(recognize)
                var prenommm = $.cookie(""+recognizee+"")
                console.log(nb)
                
                // $(".field_client>.droite").append(`<form action='' method='post' class='formclient_${$.cookie("nb_client")} formclient'>
                $(".list-employes").append(`<form action='' method='post' class='formclient_${$.cookie("nb_client")} formclient'>
                    <div class='${$.cookie("nom_"+$.cookie("nb_client"))} formclientt'>
                    <h2 style='margin-top: 25px; margin-bottom: 25px; padding-left: 15px;'>Employé n° ${nb_client+1}</h2>
                        <div class='form form_${$.cookie("nb_client")}' id='0'>
                            <div class='col5 client'>
                                <p>Nom :</p> <br>
                                <p>Prénom :</p> <br>
                                <p>Fonction :</p> <br>
                                <p>Ligne directe :</p> <br>
                                <p>Mail :</p> <br>
                            </div>
                            <div class='col6 client'>
                                <input type='text' name='nom_${$.cookie("nb_client")}' id='' value='${$.cookie("nom")}'><br>
                                <input type='text' name='prenom_${$.cookie("nb_client")}' id='' value='${$.cookie("prenom")}'><br>
                                <input type='text' name='fonction_${$.cookie("nb_client")}' id='' value='${$.cookie("fonction")}'><br>
                                <input type='text' name='ld_${$.cookie("nb_client")}' id='' value='${$.cookie("ld")}'><br>
                                <input type='text' name='mail_${$.cookie("nb_client")}' id='' value='${$.cookie("mail")}'> <br>
                            </div>
                            <div class='croix ${recognize}'>
                              <img src='img/croix.png' alt='Icone supression - Signature Generator' loading='lazy' data-form-id='${$.cookie("nb_client")}'>
                          </div>
                        </div>
                    </div>
                    <input type='submit' name='confirm_${$.cookie("nb_client")}' value='Enregistrer' class='button enregistre_${$.cookie("nb_client")} enregistrer'>
                    <input type='submit' name='apercu_${$.cookie("nb_client")}' value='Aperçu' class='button apercu_${$.cookie("nb_client")} apercu_submit' style='margin-left: 95px;'>
                    <a href='signatures/Signature_${nommm}_${prenommm}.htm' download value='Télécharger' class='button telecharger button telech' name='telecharger_${$.cookie("rsnbr")}' style='border-top: 1px solid #FFF; margin-left: 15px;'>Télécharger</a>
                </form>
                <div class='reponse_client reponse_client_${$.cookie("nb_client")}'></div>`)
                
                

                console.log("Resulttt t : "+nb_client)
                $.cookie("nb_client", nb_client)
                $.cookie("empl", nb_client)
                $("[name='empl']").val(nb_client)
                console.log($.cookie("empl")+1)
                
                // Incrémentation du cookie
                nb_client++

                // Enregistrement dans la base de données
                // $("[name='empl']").val($.cookie("nb_client"))
                // $("[name='ok']").click()
                
                // setTimeout(() => {
                //     var cookies = $.cookie();
                //     for(var cookie in cookies) {
                //         $.removeCookie(cookie);
                //     }
                //     localStorage.ide = sessionStorage.getItem("ide")
                //     var ide = JSON.parse(localStorage.ide)
                //     console.log(ide)
                //     // window.location.href="/login.php"
                //     // $("[name='identifiant']").val(localStorage.getItem("ide"))
                //     // $("[name='mdp']").val(localStorage.getItem("mdp"))
                //     // $(".button").click()
                //     // window.location.reload()
                // }, 2000);

                return nb_client
            }

            // $.cookie("nb_client", nb_client)

            // $(".ajout_employ>.col6>.nom")
        })

        // Fonction de modification du lien de la publicité
        // $("[name='enregi_confirm']").on("click", function (g) {
        //     g.preventDefault()
        //     $.cookie("pub", $("[name='pub']").val())
        //     $.cookie("banniere", "")
        //     $.get("functions/update_ad.php", function(data){
        //         // La page recharge pour actualiser les cookies de la publicité
        //         // window.location.reload()
        //         console.log(data)

        //         $(".confirmutii").append(data)
        //     })
        //      $.get("functions/banniere_save.php", function(data){
        //          console.log(data)

        //         $(".php_inser").append(data)
        //     })
        // })
    }

    // Fonction de déconnexion
    $("[name='deconnexion']").on("click", function(x){
        x.preventDefault()
        // Suppression de tous les cookies
        var cookies = $.cookie();
        for(var cookie in cookies) {
            $.removeCookie(cookie);
        }
        // Redirection vers l'authentification
        window.location.href= "/login.php";
    })
    console.log(sessionStorage.getItem("ide"))
})