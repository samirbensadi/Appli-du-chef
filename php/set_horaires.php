<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
header('Content-Type: application/json');

require 'inc/functions.php';
reconnect();
logged_only();
refreshSession();

if (!empty($_GET['hourStart']) && !empty($_GET['hourEnd'])) {
    
    $horaires = array('start' => $_GET['hourStart'], 'end' => $_GET['hourEnd']);

    $fichier = fopen('horaires.json', "w");

    fwrite($fichier, json_encode($horaires));
    fclose($fichier);
    $reponse = array('reponse' => true);

} else {
    $reponse = array('reponse' => false);
}

send_json($reponse);

?>