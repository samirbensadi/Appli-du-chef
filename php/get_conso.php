<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
require 'inc/functions.php';

reconnect();
logged_only();
refreshSession();

require 'inc/db_app.php';

$req = $bdd_app->prepare('SELECT COUNT(*) FROM presence p INNER JOIN clients c ON p.id_client = c.id_client WHERE p.date_presence = CURDATE() AND p.couleurTicket = ?');
$req->execute(['jaune']);
$result=$req->fetch();
$req->closeCursor();

$req = $bdd_app->prepare('SELECT COUNT(*) FROM presence p INNER JOIN clients c ON p.id_client = c.id_client WHERE p.date_presence = CURDATE() AND p.couleurTicket = ?');
$req->execute(['vert']);
$result1=$req->fetch();
$req->closeCursor();

$req = $bdd_app->prepare('SELECT COUNT(*) FROM presence p INNER JOIN clients c ON p.id_client = c.id_client WHERE p.date_presence = CURDATE() AND p.couleurTicket = ?');
$req->execute(['rose']);
$result2=$req->fetch();
$req->closeCursor();




var_dump($result);
var_dump($result1);
var_dump($result2);

//    require 'inc/tfpdf.php';
//    class PDF extends tFPDF
//    {
//    // Tableau simple
//        function BasicTable($header,$data)
//        {
//            // En-tête
//            foreach($header as $col)
//                $this->Cell(30,4,$col,1);
//            $this->Ln();
//
//            // Données
//            foreach ($data as $row) {
//                foreach ($row as $col)
//                    $this->Cell(30, 4, $col, 1);
//                $this->Ln();
//            }
//        }
//
//
//
//        // En-tête
//        function Header()
//        {
//
//            $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
//            $this->SetFont('DejaVu','',10);
//            // Décalage à droite
////            $this->Cell(80);
//            // Titre
//            $this->Cell(30,10,'Liste des ventes',1,0,'C');
//            // Saut de ligne
//            $this->Ln(20);
//        }
//    }
//
//    $pdf = new PDF();
//    $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
//    $pdf->SetFont('DejaVu','',8);
//
//    $pdf->AddPage(["L"]);
//    $datemin = date_create($_GET['dateMin']);
//    $datemax = date_create($_GET['dateMax']);
//    $pdf->SetTitle("Liste des ventes entre le " . date_format($datemin, 'd-m-Y') . " et le " . date_format($datemax, 'd-m-Y'), true);
//    $header = array('N°vente','Date vente','N°client', 'Nom', 'Prénom', 'Nombre Ticket vert','Nombre Ticket rose','Nombre Ticket jaune', "Coût vente €");
//    $pdf->BasicTable($header,$result);
//    $pdf->Output();


?>