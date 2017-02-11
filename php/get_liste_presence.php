<?php
header('Content-Type: application/json');
require 'inc/functions.php';
reconnect();
logged_only();
refreshSession();

require 'inc/db_app.php';

$req = $bdd->prepare('SELECT p.date_presence, p.id_presence, p.couleurTicket, p.id_client, c.nom, c.prenom, c.formation, c.codeQR, c.id_statut FROM presence p INNER JOIN clients c ON p.id_client = c.id_client WHERE p.date_presence = CURDATE()');
$req->execute();
$result=$req->fetchAll();

// var_dump($result);

if ($result) {
  $reponse = $result;
} else {
  $reponse = array('reponse' => false );
}

send_json($reponse);


 ?>
