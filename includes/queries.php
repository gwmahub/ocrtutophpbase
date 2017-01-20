<?php

include_once '../lib/fctglobal.php';
include_once 'connect.php';

/**
 * @return mixed
 * @description return the total posts number
 */
function getNbPosts(){
    global $bdd;
    $nbPosts = $bdd->query('SELECT COUNT(billets.id) FROM billets')->fetch();

    return $nbPosts;
}

/**
 * @return array
 * @description return all posts and all comments associated
 */
function getAllPostsAndAllCommentsAssoc(){
    global $bdd;
    $commentsByPost = $bdd
        ->query('
                    SELECT billets.id, titre, contenu, date_creation,(SELECT COUNT(id_billet) FROM commentaires WHERE id_billet = billets.id) AS nbcommentsbypost
                    FROM billets
                    LEFT JOIN commentaires ON (billets.id = commentaires.id_billet)
                    GROUP BY billets.id
                    ORDER BY date_creation DESC
                    ')
        ->fetchAll();

    if(count($commentsByPost) >1){
        return $commentsByPost;
    }

    return false;
}

function getThePost($postId){
    global $bdd;
    if(empty($postId) || !is_numeric($postId)){
        return false;
    }
    $sql = 'SELECT billets.id, titre, contenu, date_creation FROM billets WHERE billets.id=:billet_id';
    $post = $bdd->prepare($sql);
    $post->execute(
        array(
            'billet_id' => $postId
        )
    );

    if(!empty($post)){return $post->fetchObject();}

    return false;
}

function insertNewPost($titre, $contenu, $isonline){
    global $bdd;
    $date = date("Y-m-d H:i:s");

    $sql = $bdd->prepare('INSERT INTO billets(titre, contenu, date_creation, is_online) VALUES(?,?,?,?);');
    $sql->execute(array($titre,$contenu,$date,$isonline));

    return $sql? true:false;
}

