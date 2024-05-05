<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Blog</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>


<?php
include_once('header.php');
?>

<section class="container-fluid">
    <?php if( $_SESSION['login'] ) { ?>
    <div class="row">
        <div class="col-12 m-2">
            Bienvenue <?=$_SESSION['login'];?>
        </div>
    </div>
    <?php
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-9 mt-3">
            <h5>Derniers billets du blog</h5>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-9">

            <?php
            include_once('db.php');

            // On rÃ©cupÃ¨re les 5 derniers billets
            $req = $db->query(
                "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
                    FROM billets 
                    ORDER BY date_creation 
                    DESC LIMIT 0, 5"
            );

            while ($donnees = $req->fetch()) {
                ?>
                <div class="card mt-5">
                    <div class="card-header">
                        <em>publié le <?=$donnees['date_creation_fr']; ?></em>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($donnees['titre']); ?></h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?></p>
                        <a href="commentaires.php?billet=<?=$donnees['id']; ?>" class="btn btn-secondary">Commentaires</a>
                    </div>
                </div>
                <?php
            } // Fin de la boucle des billets
            $req->closeCursor();
            ?>
        </div>
    </div>
</section>
</body>
</html>