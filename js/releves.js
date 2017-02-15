$(document).on('pagecreate', '#releves', function () {

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



    $('#formReleveVente').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            url: 'http://' + server + 'get_ventes.php',
            method: "POST",
            data: $('#formReleveVente').serialize(),
            success: function (data) {
                console.log(data);
                if (data.reponse == "disconnect") {
                    disconnect();
                } else if (data.reponse == "noticket") {
                    toast("Aucun ticket n'a été vendu dans cette plage.", 5000);
                } else {
                    toast("Erreur serveur", 5000);
                }

            },
            error: function () {
                toast("<b>Erreur</b> : l'envoi a échoué. Vérifiez votre connexion.", 5000); // erreur de liaison avec le serveur
                $("#presenceText").text("Erreur de chargement.");
            }
        });

    });


});