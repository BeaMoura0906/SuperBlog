<?php

if( strstr($_SERVER['HTTP_HOST'], '51.178.86.117') ){
    $dbname = 'beatriz';
    $dblogin = 'beatriz';
    $dbpassword = 'Eg;ah9do';
} else {
    $dbname = 'blog';
    $dblogin = 'root';
    $dbpassword = '';
}

// Connexion à la base de donnÃ©es
try
{
    $db = new PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8', $dblogin, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On Ã©met une alerte Ã  chaque fois qu'une
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}