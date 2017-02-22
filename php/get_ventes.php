<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
require 'inc/functions.php';

reconnect();
logged_only();
refreshSession();

//var_dump($_GET);
if (!empty($_GET['dateMin']) && !empty($_GET['dateMax'])) {

    require 'inc/db_app.php';

    $req = $bdd_app->prepare('SELECT v.id_vente, DATE_FORMAT(v.date_vente,"%d-%m-%Y") AS dateVente, v.id_client, c.nom, c.prenom , v.ticket_vert, v.ticket_rose, v.ticket_jaune, v.coutVente  FROM vente v INNER JOIN clients c ON v.id_client = c.id_client WHERE DATE(v.date_vente) BETWEEN ? AND ?');
    $req->execute([$_GET['dateMin'], $_GET['dateMax']]);



    $result = $req->fetchAll();
    $req->closeCursor();

//    for ($i = 0; $i < count($result); $i++) {
//        $result[$i] = get_object_vars($result[$i]);
//    }



    require 'inc/tfpdf.php';
    class PDF extends tFPDF
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

        // En-tête
        function Header()
        {
            $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $this->SetFont('DejaVu','',10);
            // Décalage à droite
            // $this->Cell(80);
            // Titre
            $this->Cell(30,10,'Liste des ventes',1,0,'C');
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
    $pdf->SetFont('DejaVu','',10);
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $datemin = date_create($_GET['dateMin']);
    $datemax = date_create($_GET['dateMax']);
    $datemin = date_format($datemin, 'd-m-Y');
    $datemax = date_format($datemax, 'd-m-Y');

    $pdf->SetTitle('Liste des ventes entre le ' . $datemin . " et le " . $datemax, true);

    $pdf->Write(5, 'Du ' . $datemin . ' au ' . $datemax);
    $pdf->Ln();
    $pdf->Ln();


    $pdf->SetFont('DejaVu','',8);

    $header = array('N°vente','Date vente','N°client', 'Nom', 'Prénom', 'Nombre Ticket vert','Nombre Ticket rose','Nombre Ticket jaune', "Coût vente €");
    $pdf->BasicTable($header,$result);
    $pdf->Output();


} else {
    header('Content-Type: application/json');
    $reponse = array("reponse" => false);
    send_json($reponse);
}



?>