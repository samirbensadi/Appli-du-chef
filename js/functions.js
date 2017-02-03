/**
 * Created by coda on 24/01/17.
 */
var server = "localhost/Appli-du-chef";

// fonction pour quitter le service
function disconnect() {
    localStorage.clear();
    sessionStorage.clear();
    $.mobile.changePage("../index.html", {transition : "slide", reverse: true});
    toast("Vous êtes déconnecté.", 5000);
}

// fonction pour créer un toast
function toast(msg, time) {
    new $.nd2Toast({
        message : msg , // Required
        ttl : time // optional, time-to-live in ms (default: 3000)
    });
}