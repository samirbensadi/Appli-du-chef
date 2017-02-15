<?php

function str_random($length)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

// verifier le token remember
function checkRemToken($base)
{
    $token_string = str_random(60);

    $reqtoken = $base->prepare('SELECT remember_token FROM admin WHERE remember_token = ?');
    $reqtoken->execute([$token_string]);
    $result_token = $reqtoken->fetch();
    $reqtoken->closeCursor();

    // si le resultat est different de false (càd si le token existe déjà dans la bdd_app)
    if ($result_token != false) {
        checkRemToken($base);
    } else {  // sinon (si le resultat vaut false,
        return $token_string; // on renvoit le token généré
    }
}

// fonction pour limiter l'accès aux scripts aux seuls utilisateurs

function logged_only(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['auth'])) {
        $reponse = array("reponse" => "disconnect");
        send_json($reponse);
        exit();
    }
}

// fonction pour envoyer la reponse tableau en json

function send_json($tableau){
    $reponsejs = json_encode($tableau);
    echo $reponsejs;
}

// fonction pour se reconnecter automatiquement avec un cookie si la session a été perdue

function reconnect(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){
        require_once 'db_admin.php';

        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $req = $bdd_admin->prepare('SELECT * FROM admin WHERE id_admin = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        $req->closeCursor();
        if($user){
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'palpatine');
            if($expected == $remember_token){
                $_SESSION['auth'] = $user;
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 30);
            } else{
                setcookie('remember', null, -1);
            }
        }else{
            setcookie('remember', null, -1);
        }
    }
}

//rafraichir les variables de session
function refreshSession() {
    require 'db_admin.php';

    $req=$bdd_admin->prepare('SELECT * FROM admin WHERE id_admin = ?');
    $req->execute([$_SESSION['auth']->id_admin]);
    $user = $req->fetch();
    $req->closeCursor();

    if ($user) {
        $_SESSION['auth'] = $user;
    }
    else{
        exit();
    }

}

function checkTime() {
    $heure_actuelle = date('H');
    if ($heure_actuelle >= 0 && $heure_actuelle < 22 ) {
        return true;
    } else {
        return false;
    }
}