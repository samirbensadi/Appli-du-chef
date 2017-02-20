<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
header('Content-Type: application/json');
require 'inc/functions.php';
reconnect();
logged_only();

if (isset($_SESSION['auth'])) {
    $reponse = array('reponse' => true);
    send_json($reponse);
}


?>
