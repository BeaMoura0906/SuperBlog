<?php
session_start();

if( isset( $_POST['commentaire'] )) {
    $commentaire = $_POST['commentaire'];
    $id_billet = $_POST['id_billet'];
    $auteur = $_SESSION['login'];
    include_once('db.php');
    $sql = 'INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES (:id_billet, :auteur, :commentaire, NOW())';
    $reponse = $db->prepare( $sql );
    $reponse->execute( [
        ':id_billet' => $id_billet,
        ':auteur' => $auteur,
        ':commentaire' => $commentaire
    ] );

    if( $reponse->rowCount() > 0 ) {
        header('Location:commentaires.php?billet='.$id_billet);
        die;
    } else {
        var_dump( $reponse->errorInfo() );
        header('Location:addCommentaire.php?billet='.$id_billet.'&error=1');
        die;
    }

}

