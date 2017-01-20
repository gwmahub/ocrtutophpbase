<?php
session_start();
include_once('base/config.php');
include_once(PATH_LIBS.'lib_q_posts.php');

$page = ifsetor($_GET["p"],ADMIN_START_FILENAME."home");

// messages utilisateurs
$msg = "";

// CONTROLER
if(file_exists(PATH_CONTROLER.$page.'.php')){
    include_once(PATH_CONTROLER.$page.'.php');
}else{
    include_once(PATH_CONTROLER.'404.php');
}

// head & header
include_once(PATH_INC.'head.php');
include_once(PATH_INC.'header.php');



// VIEW
if(file_exists(PATH_VIEW.$page.'.php')){
    include_once(PATH_VIEW.$page.'.php');
}else{
    include_once(PATH_VIEW.'404.php');
}

// footer
include_once(PATH_INC.'footer.php');

