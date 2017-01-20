<?php
$page = 'adminpostview';

$postId = isset($_GET['postid'])?$_GET['postid']:false;
$post = !empty($postId)?getThePost($postId):false;
