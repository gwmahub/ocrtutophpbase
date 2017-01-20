<?php


include_once '../includes/connect.php';

$getChatMessages = $bdd->query('SELECT ID, pseudo, message, datecrea FROM minichat ORDER BY ID DESC');
