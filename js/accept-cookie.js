jQuery(function ($) {

  // Acceptation des cookies
  // On vérifie si le premier cookie du site "accept_cookie" existe, si non, on bloque la page
  if (typeof $.cookie("accept_cookie") === "undefined")
  {
      console.log("Cookie non existant")
      setTimeout(() => {
          $("body").append("<div class='bloqueur'></div>")
          $(".bloqueur").append("<div class='zonecookie'></div>")
          $(".zonecookie").append("<p style='color: #FFFFFF;'>Pour pouvoir utiliser notre site vous devez accepter les cookies</p><a name='acceptbouton' href='#' class='acceptcookie' style='text-decoration: none; color: #FFFFFF; border: 1px solid green;'>Accepter les cookies</a>")
      }, 1200);
      
  }
  // Test pour vérifier que le cookie existe
  else
  {
      console.log("Cookie crée")
  }
  // Si l'internaute a bien cliqué sur le bouton on crée le cookie et on retire le bloqueur
  $(document).on("click", ".acceptcookie", function (event) {
      event.preventDefault()
      console.log("ffff")
      $.cookie("accept_cookie", "true")
      $(".bloqueur").remove()
  })
})