<?php

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
 * @description return all posts and all associated comments
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

    if(count($commentsByPost) > 1){
        return $commentsByPost;
    }

    return false;
}

function getThePost($postId){
    global $bdd;
    if(empty($postId) || !is_numeric($postId)){
        return false;
    }
    $sql = 'SELECT billets.id, titre, contenu, date_creation, is_online FROM billets WHERE billets.id=:billet_id';
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
    $titre   = htmlspecialchars($titre);
    $contenu = htmlspecialchars($contenu);

    $sql = $bdd->prepare('INSERT INTO billets(titre, contenu, date_creation, is_online) VALUES(?,?,?,?);');
    $sql->execute(array($titre,$contenu,$date,$isonline));

    return $sql? true:false;
}

function updateThePost($postId, $titre, $contenu, $isonline){
    global $bdd;

    if(empty($postId) || !is_numeric($postId)){
        return false;
    }

    $titre   = htmlspecialchars($titre);
    $contenu = htmlspecialchars($contenu);

    $sql = 'UPDATE ocr_phpbase.billets
            SET titre = :titre, contenu = :contenu, is_online = :isonline 
            WHERE billets.id = :billet_id ';
    $post = $bdd->prepare($sql);
    $post->execute(
        array(
            'billet_id' => $postId,
            'titre'     => $titre,
            'contenu'   => $contenu,
            'isonline'  => $isonline
        )
    );

    return $post? true:false;
}

function deleteThePost($postId){
    global $bdd;

    if(empty($postId) || !is_numeric($postId)){
        return false;
    }

    $sql = $bdd->prepare('DELETE FROM `ocr_phpbase`.`billets` WHERE `billets`.`id` = :postid ');
    $sql->execute(array(
        'postid' => $postId
    ));
    return $sql?true:false;
}

