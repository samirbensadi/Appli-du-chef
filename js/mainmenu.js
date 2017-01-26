$(document).on("pagecreate", "#mainmenu", function() {

  $('#logOut').on('tap', function () {
      $.ajax({
          method: "POST",
          url: 'http://' + server + '/php/log_out.php'
      });
      disconnect();
  });
});
