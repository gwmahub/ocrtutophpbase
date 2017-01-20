<?php

$page       = 'adminpostcreate';
$titre      = isset($_POST['titre'])?$_POST['titre']:false;
$contenu    = isset($_POST['contenu'])?$_POST['contenu']:false;
$isonline   = isset($_POST['isonline'])?$_POST['isonline']:'0';
$submit     = isset($_POST['submit'])?$_POST['submit']:null;

if($submit !== null){
    if(!$titre || !$contenu || !$isonline){
        echo '<div class="alert alert-danger">ATTENTION : un champ un moins n\'est pas complet</div>';
    }else{
        $isonline == 'on'?'1':'0';
        $insertNewPost = insertNewPost($titre, $contenu, $isonline);
        if($insertNewPost){
            $msg .= "OK !!";

            header('Location:?p=adminposthome');
        }else{
            throw new \Exception('Erreur lors de l\'insertion dans la DB');
        }
    }
}
