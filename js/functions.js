/**
 * Created by coda on 24/01/17.
 */
var server = "localhost/Appli-du-chef";

// fonction pour quitter le service
function disconnect() {
    localStorage.clear();
    sessionStorage.clear();
    $.mobile.changePage("../index.html", {transition : "slide", reverse: true});
}
