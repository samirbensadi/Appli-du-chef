<?php

if (!empty($_GET['mdp'])) {
    $mdp = $_GET['mdp'];

    $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT); // hachage du mdp
    echo $mdp_hash;
}

// require 'inc/db_app.php';
//
//   $req4 = $bdd_app->prepare('INSERT INTO presence(date_presence, couleurTicket, id_client) VALUES(CURDATE(), :couleurTicket, :id_client)');
//   $req4->execute(["couleurTicket" => "pourpre", "id_client" => "5" ]);
//
//for ($i = 0; $i<70; $i++) {
//    $req3 = $bdd_app->prepare('INSERT INTO vente (ticket_vert, ticket_rose, ticket_jaune, coutVente, date_vente ,id_client) VALUES (:ticket_vert, :ticket_rose, :ticket_jaune, :coutVente, NOW() ,:id_client)');
//    $req3->execute(["ticket_vert" => 1, "ticket_rose" => 1, "ticket_jaune" => 1, "coutVente" => 10,"id_client" => 3]);
//    $req3->closeCursor();
//}





?>
