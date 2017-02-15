<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
require 'inc/functions.php';

reconnect();
logged_only();
refreshSession();



//var_dump($_POST);
if (!empty($_POST['dateMin']) && !empty($_POST['dateMax'])) {

    require 'inc/db_app.php';

    $req = $bdd_app->prepare('SELECT v.id_vente, v.id_client, c.nom, c.prenom , v.ticket_vert, v.ticket_rose, v.ticket_jaune, DATE_FORMAT(v.date_vente,\'%m-%d-%Y\') FROM vente v INNER JOIN clients c ON v.id_client = c.id_client WHERE DATE(v.date_vente) BETWEEN ? AND ?');
    $req->execute([$_POST['dateMin'], $_POST['dateMax']]);

    $result = $req->fetchAll();
    $req->closeCursor();
//    var_dump($result);

    require 'inc/fpdf.php';
    $PDF = new FPDF();
    $PDF->AddPage();
    $PDF->SetFont('Arial', 'B',16);
    $PDF->Text(40,10, "Mon texte");
    $PDF->Output("test.pdf", "F");

} else {
    header('Content-Type: application/json');
    $reponse = array("reponse" => false);
    send_json($reponse);
}



?>