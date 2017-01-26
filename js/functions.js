var server = "localhost/Appli-du-chef";

// fonction pour quitter le service
function disconnect() {
    localStorage.clear();
    sessionStorage.clear();
    $.mobile.changePage("../index.html", {transition : "slide", reverse: true});
}
