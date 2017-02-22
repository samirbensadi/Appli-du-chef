<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
require 'inc/functions.php';

reconnect();
logged_only();
refreshSession();

require 'inc/db_app.php';

$req = $bdd_app->prepare('SELECT p.date_presence, p.id_presence, p.couleurTicket, p.id_client, c.nom, c.prenom, c.formation, c.codeQR, c.id_statut FROM presence p INNER JOIN clients c ON p.id_client = c.id_client WHERE p.date_presence = CURDATE()');
$req->execute();
$result=$req->fetchAll();
$req->closeCursor();

if ($result) {

    $totalJaune = 0;
    $totalVert = 0;
    $totalRose = 0;


    foreach ($result as $object){
        if ($object->couleurTicket == "jaune") {
            $totalJaune++;
        }
        if ($object->couleurTicket == "vert") {
            $totalVert++;
        }
        if ($object->couleurTicket == "rose") {
            $totalRose++;
        }
    }


    require 'inc/tfpdf.php';
    class PDF extends tFPDF
    {
            // En-tête
        function Header()
        {

            $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $this->SetFont('DejaVu','',18);
            // Décalage à droite
            $this->Cell(80);
            // Titre
            $this->Cell(30,10,'Nombre de tickets consommés',0,0,'C');
            // Saut de ligne
            $this->Ln(20);
        }

        function Footer()
        {
            // Positionnement à 1,5 cm du bas
            $this->SetY(-15);
            // Numéro de page
            $this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF('L', 'mm', 'A4');
    $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $pdf->SetFont('DejaVu','',17);
    $pdf->AliasNbPages();

    $pdf->AddPage();
    $date = date_create();
    $date = date_format($date, 'd-m-Y');
    $pdf->SetTitle("Nombre de tickets consomés au" . $date, true);

    $pdf->Write(5, "Date : " . $date );
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Write(5, 'Tickets jaunes : ' . $totalJaune);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Write(5, 'Tickets verts : ' . $totalVert);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Write(5, 'Tickets roses : ' . $totalRose);
    $pdf->Output();



} else {
    header('Content-Type: application/json');
    $reponse = array("reponse" => false);
    send_json($reponse);
}


?>