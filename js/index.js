$(document).on("pagecreate", "#home", function() {

    //au tap du bouton se CONNECTER
    $('#btnCo').on("tap", function(event) {
        event.preventDefault();
        $.mobile.changePage("views/mainmenu.html", {
            transition: "slide",
            reverse: false
        }); // je charge la page 2
    })
})
