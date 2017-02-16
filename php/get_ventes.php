<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
require 'inc/functions.php';

reconnect();
logged_only();
refreshSession();

//var_dump($_GET);
if (!empty($_GET['dateMin']) && !empty($_GET['dateMax'])) {

    require 'inc/db_app.php';

    $req = $bdd_app->prepare('SELECT v.id_vente, v.id_client, c.nom, c.prenom , v.ticket_vert, v.ticket_rose, v.ticket_jaune, DATE_FORMAT(v.date_vente,"%d-%m-%Y") AS dateVente FROM vente v INNER JOIN clients c ON v.id_client = c.id_client WHERE DATE(v.date_vente) BETWEEN ? AND ?');
    $req->execute([$_GET['dateMin'], $_GET['dateMax']]);



    $result = $req->fetchAll();
    $req->closeCursor();

//    for ($i = 0; $i < count($result); $i++) {
//        $result[$i] = get_object_vars($result[$i]);
//    }


//    var_dump($result);

    require 'inc/fpdf.php';
    class PDF extends FPDF
    {
// Tableau simple
        function BasicTable($header,$data)
        {
            // En-tête
            foreach($header as $col)
                $this->Cell(30,4,$col,1);
            $this->Ln();

            // Données
            foreach ($data as $row) {
                foreach ($row as $col)
                    $this->Cell(30, 4, $col, 1);
                $this->Ln();
            }
        }
    }

    $pdf = new PDF();

    $pdf->SetFont('Arial','',8);
    $pdf->AddPage(["L"]);
    $datemin = date_create($_GET['dateMin']);
    $datemax = date_create($_GET['dateMax']);
    $pdf->SetTitle("Liste des ventes entre le " . date_format($datemin, 'd-m-Y') . " et le " . date_format($datemax, 'd-m-Y'), true);
    $header = array('N°vente', 'N°client', 'Nom', 'Prénom', 'Ticket vert','Ticket rose','Ticket jaune','Date vente',);
    $pdf->BasicTable($header,$result);
    $pdf->Output();


} else {
    header('Content-Type: application/json');
    $reponse = array("reponse" => false);
    send_json($reponse);
}



?>