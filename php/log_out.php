<?php

if(isset($_SESSION['auth'])){
    unset($_SESSION['auth']);
}

if(isset($_COOKIE['remember'])) {
  setcookie('remember', NULL, -1);
}

if(session_status() == PHP_SESSION_ACTIVE){
    session_destroy();
}
?>
