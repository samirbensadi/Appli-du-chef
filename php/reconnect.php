<?php

require 'inc/functions.php';
reconnect();
logged_only();

if (isset($_SESSION['auth'])) {
    $reponse = array('reponse' => true);
    send_json($reponse);
}


?>
