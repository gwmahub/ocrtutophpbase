<?php
$page       = 'adminpostdelete';
$action     = isset($_GET['action'])?$_GET['action']:false;
$postId     = isset($_GET['postid'])?$_GET['postid']:false;


if($action === 'delete' && $postId){
    deleteThePost($postId);
    $msg .= '<p class="alert alert-success">Billet supprimé avec succès.</p>';
    $posts  = getAllPostsAndAllCommentsAssoc();
    $page = 'adminposthome';

}else{
    $msg .= '<p class="alert alert-danger">Erreur dans la requête</p>';
}


