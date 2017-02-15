<?php
header("Access-Control-Allow-Origin : *"); // pour que tout le monde puisse interroger ce script
header('Content-Type: application/json');
require_once 'inc/functions.php';

reconnect();
logged_only();
refreshSession();

if (!empty($_POST['dateMenu']) && !empty($_POST['entree']) && !empty($_POST['plat']) && !empty($_POST['dessert'])) { // si des choses ont été envoyées par post
    require 'inc/db_app.php';
    $req3 = $bdd_app->prepare('SELECT id_menu, date_menu FROM menus WHERE date_menu = ?');
    $req3->execute([$_POST['dateMenu']]);
    $result = $req3->fetch();
    $req3->closeCursor();

    if ($result) { // si une date de menu existe déjà
      $req = $bdd_app->prepare('UPDATE menus SET entree = ?, plat = ?, dessert = ? WHERE id_menu = ?');
      $req->execute([$_POST['entree'], $_POST['plat'], $_POST['dessert'], $result->id_menu]);
      $req->closeCursor();
      $reponse = array('reponse' => "updated");
    } else {
      $req = $bdd_app->prepare('INSERT INTO menus(entree, plat, dessert, date_menu) VALUES(:entree, :plat, :dessert, :date_menu)');
      $req->execute(["entree" => $_POST['entree'], "plat" => $_POST['plat'], "dessert" => $_POST['dessert'], "date_menu" => $_POST['dateMenu']]);
      $req->closeCursor();
      $reponse = array('reponse' => true);
    }

}
else{
    $reponse = array('reponse' => false);
}

send_json($reponse);

 ?>
