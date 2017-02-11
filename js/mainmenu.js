$(document).on("pagecreate", "#mainmenu", function() {

  $('#logOut').on('tap', function () {
      $.ajax({
          method: "POST",
          url: 'http://' + server + 'log_out.php'
      });
      disconnect();
  });

  function updateMain() {
        $.ajax({
            url: 'http://' + server + 'get_liste_presence.php',
            success: function (data) {
                console.log(data[0]);
                if (data.reponse == "disconnect") {
                  disconnect();
                } else if (data.reponse == false) {
                  $("#presenceText").text("La liste est vide.");
                } else {
                    $('#presenceText').text("La liste comprend actuellement " + data.length + " personnes.");
                    localStorage.setItem("liste", JSON.stringify(data));
                }

            },
            error: function () {
                toast("<b>Erreur</b> : l'envoi a échoué. Vérifiez votre connexion.", 5000); // erreur de liaison avec le serveur
                $("#presenceText").text("Erreur de chargement.");
            }
        });
  }
  updateMain();

  $("#refreshBtn").on('tap', function () {
    updateMain();
  });

});
