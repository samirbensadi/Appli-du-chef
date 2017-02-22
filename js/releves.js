$(document).on('pagecreate', '#releves', function () {

  if (!localStorage.liste) {
    $('#presenceP').text("Aucune liste de présence n'est enregistrée aujourd'hui.");
  } else {
      var liste = JSON.parse(localStorage.liste);

      var totalJaune = 0, totalVert = 0, totalRose = 0;

      for (var i = 0; i < liste.length; i++) {
          if (liste[i].couleurTicket == "jaune") {
              totalJaune++;
          }
          if (liste[i].couleurTicket == "vert") {
              totalVert++;
          }
          if (liste[i].couleurTicket == "rose") {
              totalRose++;
          }
      }

      console.log(totalJaune + " " + totalVert + " " + totalRose);
      $('#totalJaune').text(totalJaune);
      $('#totalVert').text(totalVert);
      $('#totalRose').text(totalRose);
      $('#releveConso').append('<button type="" id="downloadPresence" class="ui-btn ui-btn-inline clr-primary">Télécharger le pdf</button>');
  }


   $('#formReleveVente').on('change', function (event) {

       var dateMin = $('#dateMin').val();
       var dateMax = $('#dateMax').val();

       $('#downloadVente').prop('href', 'http://' + server + 'get_ventes.php?dateMin=' + dateMin + '&dateMax=' + dateMax);
    });


});