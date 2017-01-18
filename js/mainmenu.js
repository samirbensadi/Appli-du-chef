$(document).on("pagecreate", "#mainmenu", function() {

    $('#logOut').on('tap', function() {
        $.mobile.changePage("../index.html", {
            transition: "slide",
            reverse: true
        });
    })
})
