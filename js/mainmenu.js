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
                    localStorage.removeItem("liste");
                } else if (data.length == 1){
                    $('#presenceText').text("La liste comprend actuellement " + data.length + " personne.");
                    localStorage.setItem("liste", JSON.stringify(data));
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


      $.ajax({
          url: 'http://' + server + 'get_horaires.php',
          success: function (data) {
              console.log(data);
              if (data.reponse == true) {
               $('#hourStart').val(data.start);
               $('#hourEnd').val(data.end);
              }
          },
          error: function () {
              toast("<b>Erreur</b> : impossible d'afficher les horaires.", 5000); // erreur de liaison avec le serveur
          }
      });
  }
  updateMain();

  $("#refreshBtn").on('tap', function () {
    updateMain();
  });

    
  $('#hourForm').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
          url: 'http://' + server + 'set_horaires.php',
          method: 'GET',
          data: $(this).serialize(),
          success: function (data) {
              console.log(data);
              if (data.reponse == "disconnect") {
                  disconnect();
              } else if (data.reponse == false) {
                toast("<b>Erreur</b> : Le serveur n'a recu aucune donnée.", 5000);
              } else {
                toast("Horaires mis à jour !",5000);
              }

          },
          error: function () {
              toast("<b>Erreur</b> : l'envoi a échoué. Vérifiez votre connexion.", 5000); // erreur de liaison avec le serveur
       }
      });
  });

});
