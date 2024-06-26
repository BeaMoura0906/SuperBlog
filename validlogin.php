<?php
session_start();

if( isset( $_POST['login'] ) && isset( $_POST['password'] ) ) {
    $login = $_POST['login'];
    include_once('db.php');
    $sql = 'SELECT * FROM users WHERE login=:login';
    $reponse = $db->prepare( $sql );
    $reponse->execute( [':login'=>$login] );

    if( $acces = $reponse->fetch(PDO::FETCH_ASSOC) ) {
        if( sodium_crypto_pwhash_str_verify( $acces['password'], $_POST['password'] ) ) {
            $_SESSION['login'] = $login;
            header('Location:index.php?error=0');
            die;
        } else {
            header('Location:login.php?error=1&passerror=1');
            die;
        }
    } else {
        header('Location:login.php?error=1&loginerror=1');
        die;
    }

}


