var server = "localhost/Appli-du-chef/php/";

// tableaux qui contiennent la liste des jours de la semaine et des mois de l'année pour que ecrire les dates en français
var jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
var mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

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
