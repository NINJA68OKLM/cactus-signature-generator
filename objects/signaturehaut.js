`<table style="font-family:Arial, Helvetica, sans-serif !important; margin-right:0; margin-left:auto; line-height:19px; width: 100%; height: 100%; " cellpadding="0" cellspacing="0" id="table">
                    <tbody>
                        <tr style="font-size: 14px;">
                            <!-- Identité -->
                            <td style=" height:35px; vertical-align:center; text-align: left;" valign="center" align="right">
                                <span>
                                    <img src="img/uploads/${$(".logonom").data("nomId")}" alt="agence-cactus.fr" style="max-height:150px; height:auto; border:0;" height="150">
                                </span>
                                <br>
                                <span id="nom" style="font-weight:bold; font-size: 18px; font-family: Arial, Helvetica, sans-serif;">${$.cookie("prenom_" + formId)} ${$.cookie("nom_" + formId).toUpperCase()}</span>
                                <br>
                                <!-- Poste -->
                                    <span style="color: rgb(100, 99, 99); font-style: italic; font-family: Arial, Helvetica, sans-serif;">
                                        ${$.cookie("fonction_" + formId)}
                                    </span>
                                    <br>
                                <!-- Mail -->
                                    <span style="color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;"><a href="${$("[name='mail_" + formId + "']").val()}" style="color: rgb(100, 99, 99); text-decoration: none;">${$("[name='mail_" + formId + "']").val()}</a></span>
                                <br>
                                    <!-- Numéro de teléphone -->
                                <span style="font-weight: bold; color: rgb(100, 99, 99); font-family: Arial, Helvetica, sans-serif;">
                                    Tél : <a style="color: rgb(100, 99, 99); text-decoration: none;" href="tel:${$.cookie("ld" + formId)}">${$.cookie("ld_" + formId)} (ligne directe)</a>
                                </span>
                                <br> <br> 
                                <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                    ${$.cookie("adre")}, ${$.cookie("cp")} ${$.cookie("ville")}
                                </span>
                                <br>
                                <span style="color: #156cad; font-family: Arial, Helvetica, sans-serif;">
                                    Tél : <a href="tel: ${$.cookie("tel")}" style="color: #156cad; text-decoration: none;">${$.cookie("tel")}</a>
                                </span>
                                <br>
                                <span style="display: flex;" class='cacher'>
                                    <!-- Site web -->
                                    <span style="font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
                                        <a style="color: #156cad; text-decoration: none;" href="${$.cookie("site")}">${$.ccokie("site")}</a>
                                    </span>
                                    <span class="signRS" style='display: flex; margin-left: 5px;'></span> 
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>`