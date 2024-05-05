<?php

$envFilePath = '.env';

if( file_exists( $envFilePath ) ) {
    $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
    foreach ($lines as $line) { 
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name); 
        $value = trim($value);

        if (!array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
        }
    }
}

if( strstr($_SERVER['HTTP_HOST'], $_ENV['DB_HOST'] )){
    $dbname = getenv('DB_NAME');
    $dblogin = getenv('DB_LOGIN');
    $dbpassword = getenv('DB_PASSWORD');
} else {
    $dbname = 'superblog';
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