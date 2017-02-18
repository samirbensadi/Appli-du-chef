<?php
require 'inc/functions.php';
reconnect();
logged_only();
refreshSession();

if (!empty($_GET['hourStart']) && !empty($_GET['hourEnd'])) {

    $partsStart = explode(":",$_GET['hourStart']);
    $partsEnd = explode(":",$_GET['hourEnd']);

//    var_dump($partsEnd);

    require 'inc/Hours.php';
    $horaires = new Hours($partsStart[0], $partsStart[1], $partsEnd[0], $partsEnd[1]);

//    var_dump($horaires);


} else {
    $reponse = array('reponse' => false);
}

send_json($reponse);

?>