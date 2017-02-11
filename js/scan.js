$(document).on('pagecreate', "#scan", function () {

  function scan() {
    QRScanner.scan(function (err, text){
        if(err){
            // an error occurred, or the scan was canceled (error code `6`)
            alert("Erreur : " + err);
        } else {
            var liste = JSON.parse(localStorage.liste);
            var trouve = false;
            var i = 0;
            while (trouve == false || i < liste.length) {
              if (liste[i].codeQR == text) {
                alert("yes !");
                trouve = true;
              } else {
                i++;
              }
            }
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
