<?php
//CONNEXION A LA BASE DE DONNEES
//On essaie qqch avec try, si il ya une erreur, on exécute qqch avec catch
try {
  //Création de l'objet bdd via le constructeur PDO (issu de l'extension PHP Data Objects). C'est ainsi que l'on se connecte à MySQL. On active également la détection d'erreurs SQL.
  $bdd = new PDO('mysql:host=localhost;dbname=admin_application;charset=utf8', 'root', 'pipi');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // on modifie l'option pour que la requete soit fetchée en tant qu'objet

} //On récupère le code erreur renvoyé par PHP, on met fin à l'exécution de la page, et on affiche le message correspondant au code erreur.
catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}

 ?>
