<?php
require 'inc/functions.php'

reconnect();
logged_only();

require 'inc/db_app.php';
$req = $bdd->prepare('SELECT * FROM vente WHERE date_vente'); 
$req->execute()
$req->fetchAll();






 ?>