<?php
session_start();
include_once('db.php');
?>
<html lang="fr">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>


<body>

<?php
include_once( 'header.php')
?>


<?php
// Vérifier si le login existe déjà
$login = htmlspecialchars( $_POST['login'] );
$password = htmlspecialchars( $_POST['password'] );
$passwordConfirm = htmlspecialchars( $_POST['passwordConfirm'] );

$req = $db->prepare( 'SELECT * FROM users WHERE login =:login' );
$req->execute( [':login'=>$login] );
if( $req->rowCount() ) {
    header( 'Location: createUserStep1.php?pseudo=1' );
    die();
}

// Vérifier le mot de passe et la confirm
if( strlen( $password ) < 8 ) {
    header( 'Location: createUserStep1.php?invalidpass=1' );
    die();
}
if( $password != $passwordConfirm ) {
    header( 'Location: createUserStep1.php?invalidconfirm=1' );
    die();
} 


$passHash = sodium_crypto_pwhash_str(
    $password,
    SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
    SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
);

$req = $db->prepare( 
    "INSERT INTO users( login, password ) VALUES ( :login, :password )"
 );
$isInsertOk = $req->execute([
    ':login'   => $login,
    ':password' => $passHash
 ]);
 if( !$isInsertOk ) {
    echo "Erreur lors de l'enregistrement";
    die;
 } else {
     $idUser = $db->lastInsertId();
     $_SESSION['id'] = $idUser;
     $_SESSION['login'] = $login;
 }


?>


<section class="container mt-5">
    <div class="row">
        <div class="col-12">
            <form name="accesform" method="post" action="validUser.php" enctype="multipart/form-data">
                <input type="hidden" value="<?=$idUser?>" name="idUser">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Fichier</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="photo">Choisissez votre photo de profil</label>
                    </div>
                </div>
                <div class="mb-3 row justify-content-end">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary mb-3">Valider</button>
                        <a href="index.php" class="btn btn-secondary mb-3">Ignorer</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>



<footer class="container">

</footer>


</body>