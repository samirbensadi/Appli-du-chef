<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
header('Content-Type: application/json');
require 'inc/functions.php';

reconnect();
logged_only();

require 'inc/db_app.php';
$req = $bdd->prepare('SELECT * FROM menus ORDER BY date_menu DESC LIMIT 10');
$req->execute();
$result = $req->fetchAll();

if ($result) {
  $reponse = $result;
} else {
  $reponse = array('reponse' => false );
}

send_json($reponse);

 ?>
