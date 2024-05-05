<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon blog</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
</head>

<?php
include_once('header.php');
?>

<section class="container">
    <div class="row mt-5">
        <div class="col-12 mb-3">
            <h3>Ajouter un commentaire</h3>
        </div>
        <?php
            if (isset($_GET['error'])) {
                echo '<div class="row"><p class="col-10 alert alert-warning">Une erreur est survenue. Veuillez reessayer.</p></div>';
            }
        ?>
        <form  name="accesform" action="validAddCommentaire.php" method="post">
            <input type="hidden" name="id_billet" value="<?= $_GET['billet'] ?>">
            <div class="mb-3 row">
                <label for="inputName" class="col-sm-2 col-form-label">Commentaire</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputName" name="commentaire" aria-label="With textarea" required></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </form>
    </div>
</section>