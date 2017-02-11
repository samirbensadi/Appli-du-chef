document.addEventListener('deviceready', function () {
    QRScanner.prepare(function (err, status) {
        if (err) {
            alert("Erreur : " + err);
        }
        if (status.authorized) {
            toast('ok !!',3000);

        } else if (status.denied) {

        } else {

        }
    });

});

$(document).on("pagecreate", "#home", function() {

    if (localStorage.remember) {
        $.ajax({
            url: "http://" + server + 'reconnect.php',
            success: function (data) {
                console.log(data);
                if (data.reponse == true) {
                    $.mobile.changePage("views/mainmenu.html", {transition: "slide", reverse: false});
                } else {
                    disconnect();
                }
            }
        });
    }


    $('#formConnexion').on("submit", function(event) {
        event.preventDefault();
        if ($("#login").val().length > 0 && $("#mdp").val().length >= 4) { // si le login et le mot de passe ont bien été entré

            $.ajax({
                method: "POST",
                url : 'http://' + server + 'log_in.php', // envoi vers ce script
                data: $('#formConnexion').serialize() ,
                success: function (data) { // en cas de succes
                    console.log(data);
                    if (data.reponse == true) { // si la reponse vaut true
                        localStorage.setItem('remember', true);
                        $.mobile.changePage("views/mainmenu.html",{transition : "slide", reverse: false}); // je charge la page 2
                    } else {
                        toast("L'identifiant n'existe pas ou le mot de passe est incorrect.", 5000); // php n'a pas reçu les bonnes infos
                    }
                },
                error: function () {
                    toast("<b>Erreur</b> : l'envoi a échoué. Vérifiez votre connexion.", 5000); // erreur de liaison avec le serveur
                }
            });

        } else {
            toast("Le mot de passe doit contenir au moins 6 caractères.", 5000);
        }
    });
});
