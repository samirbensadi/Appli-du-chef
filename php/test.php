<?php

if (!empty($_GET['mdp'])) {
    $mdp = $_GET['mdp'];

    $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT); // hachage du mdp
    echo $mdp_hash;

}

// require 'inc/db_app.php';
//
//   $req4 = $bdd->prepare('INSERT INTO presence(date_presence, couleurTicket, id_client) VALUES(CURDATE(), :couleurTicket, :id_client)');
//   $req4->execute(["couleurTicket" => "pourpre", "id_client" => "5" ]);
//
//
// ?>
