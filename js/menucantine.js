$(document).on('pagecreate', '#menucantine', function () {
  function updateMenu() {
    $.ajax({
      url: 'http://' + server + 'get_menucantine.php',
      success: function (data) {
          console.log(data);
          if (data.reponse == "disconnect") {
            disconnect();
          } else if (data.length > 0) {
            $('#displayMenu').html('');
              var longueur = data.length - 1;

              for (var i = longueur ; i >= 0; i--) { // on fait une boucle pour lister les menus (je décremente pour remettre la liste dans le bon ordre)
                var dateMenu = new Date(data[i].date_menu); // je crée un objet date pour recuperer les infos utiles
                var jourMois = dateMenu.getDate();
                var jourSemaine = dateMenu.getDay();
                var moisAnnee = dateMenu.getMonth();
                var annee = dateMenu.getFullYear();

                var titre = jours[jourSemaine] + " " + jourMois + " " + mois[moisAnnee];
                $('#displayMenu').append('<div class="nd2-card"><div class="card-title"><h3 class="card-primary-title">' + titre + '</h3></div><div class="card-supporting-text"><h4>Entrée</h4><h5>' + data[i].entree + '</h5><h4>Plat</h4><h5>' + data[i].plat + '</h5><h4>Dessert</h4><h5>' + data[i].dessert + '</h5></div></div>');
              }
          } else {
            $("#displayMenu").html("<p>Aucun menu enregistré.</p>");          }
        },
      error: function () {
          toast("<b>Erreur</b> : l'envoi a échoué. Vérifiez votre connexion.", 5000); // erreur de liaison avec le serveur
          $("#displayMenu").text("Erreur de chargement.");
      }
    });
  }

  updateMenu();

  $('#editMenu').on("submit", function (event) {
      event.preventDefault();

      $.ajax({
        method: "POST",
        url: "http://" + server + 'set_menucantine.php',
        data: $(this).serialize() ,
          success: function (data) {
            updateMenu();
            console.log(data);
            if (data.reponse == "disconnect") {
              disconnect();
            } else if (data.reponse == true) {
              toast("Menu ajouté !", 5000);
            } else if (data.reponse == "updated") {
              toast("Menu mis à jour !", 5000);
            } else {
              toast("<b>Erreur</b> : le serveur n'a pas reçu vos modifications.", 5000);
            }
          },
          error: function () {
            toast("<b>Erreur</b> : l'envoi a échoué. Vérifiez votre connexion.", 5000); // erreur de liaison avec le serveur
          }
      });


  });







});
