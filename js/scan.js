$(document).on('pagecreate', "#scan", function () {

  function scan() {
    QRScanner.scan(function (err, text){
        if(err){
            // an error occurred, or the scan was canceled (error code `6`)
            alert("Erreur : " + err);
        } else {
            var liste = JSON.parse(localStorage.liste);

            for (var i = 0; i < liste.length; i++) {
                if (liste[i].codeQR == text) {
                    i = liste.length + 1;
                    $('#infosDate').text(liste[i].date_presence);
                    $('#infosCode').text(liste[i].codeQR);
                    $('#infosNum').text(liste[i].num);
                    $('#infosNom').text(liste[i].nom);
                    $('#infosPrenom').text(liste[i].prenom);
                    $('#infosFormation').text(liste[i].formation);
                    $('#infosStatut').text(liste[i].id_statut);
                    $('#infosCouleur').text(liste[i].couleurTicket);
                }
            }

            // while (trouve == false || i < liste.length) {
            //   if (liste[i].codeQR == text) {
            //     alert("yes !");
            //     trouve = true;
            //   } else {
            //     i++;
            //   }
            // }
            scan();
        }
    });
  }

  if (localStorage.liste) {
    QRScanner.show();
    scan();
  } else {
    toast("<b>Erreur : </b>, impossible de trouver la liste de présence");
  }

});

$(document).on('pagebeforehide', '#scan',function () {
  QRScanner.destroy(function(status){
    console.log(status);
  });

});
