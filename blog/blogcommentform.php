<?php

include_once '../includes/connect.php';
include_once '../includes/head.php';
include_once '../lib/fctglobal.php';

$blogPseudo     = isset($_POST['blogpseudo'])? $_POST['blogpseudo']:false;
$blogComment    = isset($_POST['blogcomment'])? $_POST['blogcomment']:false;
$postId         = isset($_POST['postid'])?$_POST['postid']:false;
$submit         = isset($_POST['submit'])?$_POST['submit']:null;

if(( !empty($blogPseudo)) && !empty($blogComment) && !empty($postId) ){
    if($submit !== null){

        try{
            $sql = $bdd->prepare('INSERT INTO ocr_phpbase.commentaires(id_billet, auteur, commentaire, date_commentaire) 
                                  VALUES (:id_billet, :auteur, :commentaire, :date_commentaire)');
            $sql->execute(
                array(
                    'id_billet'         => $postId,
                    'auteur'            => $blogPseudo,
                    'commentaire'       => $blogComment,
                    'date_commentaire'  => date("Y-m-d H:i:s")
                )
            );

            $sql->closeCursor();

            $_GET['msg'] = "ok";

            header('Location:bloghome.php?page='.$_POST['page'].'&msg='.htmlspecialchars($_GET['msg']));

        }catch(Exception $e){
            die('Erreur : '. $e->getMessage());
        }

    }else{
        $_GET['msg'] = "nok";

    }

}else{
    throw new Exception('One or more parameter is empty');

}
