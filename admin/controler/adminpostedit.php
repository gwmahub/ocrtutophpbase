<?php

$page = 'adminpostedit';
$action     = isset($_GET['action'])?$_GET['action']:false;
$postId     = isset($_GET['postid'])?$_GET['postid']:false;

$postDatas = getThePost($postId);

$page       = 'adminpostedit';
$titre      = isset($_POST['titre'])?$_POST['titre']:false;
$contenu    = isset($_POST['contenu'])?$_POST['contenu']:false;
$isonline   = isset($_POST['isonline'])?$_POST['isonline']:'0';

$submit     = isset($_POST['submit'])?$_POST['submit']:null;

if($submit !== null){
    if(!$titre || !$contenu){
        echo '<div class="alert alert-danger">ATTENTION : un champ un moins n\'est pas complet</div>';
    }else{
        $isonline === 'on' ? '1':null;

        $insertNewPost = updateThePost($postId,$titre, $contenu, $isonline);

        if($insertNewPost){
            $msg .= "OK !!";

            header('Location:?p=adminposthome');
        }else{
            echo '<div class="alert alert-danger">ATTENTION : problème avec la requête</div>';
        }
    }
}
