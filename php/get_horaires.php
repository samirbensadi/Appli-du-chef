<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
header('Content-Type: application/json');

require 'inc/functions.php';
reconnect();
logged_only();
refreshSession();

$fichier = fopen('horaires.json', "r");

$lecture = fgets($fichier);
fclose($fichier);

$lecture = json_decode($lecture);

if ($lecture) {
    $reponse = array('reponse' => true, "start" => $lecture->start, "end" => $lecture->end);
} else {
    $reponse = array('reponse' => false);
}
send_json($reponse);



 ?>
