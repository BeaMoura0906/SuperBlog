<?php
session_start();
?>
<html lang="fr">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<?php
$mess = '';
$login = '';
if( isset( $_GET['error'] ) ) {
    if( isset( $_GET['loginerror'] ) ) {
        $mess = 'Erreur : Votre login est non valide !';
    }
    if( isset( $_GET['passerror'] ) ) {
        $mess = 'Erreur : Votre mot de passse est non valide !';
        if( isset( $_SESSION['login'] ) ) {
            $login = $_SESSION['login'];
            session_destroy();
        }
    }
}
?>
<body>

<?php
include_once('header.php');
?>

<div class="row justify-content-center">
    <div class="col-9 mt-3">
        <h5>Se connecter</h5>
    </div>
</div>

<section class="container mt-5">

    <?php
    if( isset( $_GET['error'] ) ) {
        echo '<div class="row"><p class="col-10 alert alert-danger">' . $mess .'</p></div>';
    }
    ?>
    <div class="row">
        <div class="col-12">
            <form name="accesform" method="post" action="validlogin.php">

                <div class="mb-3 row">
                    <label for="login" class="col-sm-2 col-form-label">Login</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="login" value="<?=$login?>" placeholder="Votre login" name="login" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="inputPassword" name="password" required>
                    </div>
                </div>

                <div class="mb-3 row justify-content-end">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary mb-3">OK</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>



<footer class="container">

</footer>


</body>