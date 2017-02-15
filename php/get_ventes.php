<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
header('Content-Type: application/json');
require 'inc/functions.php';

reconnect();
logged_only();
refreshSession();



//var_dump($_POST);
if (!empty($_POST['dateMin']) && !empty($_POST['dateMax'])) {

    require 'inc/db_app.php';

    $req = $bdd_app->prepare('SELECT v.id_vente, v.id_client, c.nom, c.prenom , v.ticket_vert, v.ticket_rose, v.ticket_jaune, v.date_vente FROM vente v INNER JOIN clients c ON v.id_client = c.id_client WHERE DATE(v.date_vente) BETWEEN ? AND ?');
    $req->execute([$_POST['dateMin'], $_POST['dateMax']]);

    $result = $req->fetchAll();
    $req->closeCursor();
    var_dump($result);


} else {
    $reponse = array("reponse" => false);
}

//send_json($reponse);

?>