<?php
/**
 * Created by PhpStorm.
 * User: coda
 * Date: 24/01/17
 * Time: 10:34
 */
if (!empty($_GET['mdp'])) {
    $mdp = $_GET['mdp'];

    $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT); // hachage du mdp
    echo $mdp_hash;

}

?>