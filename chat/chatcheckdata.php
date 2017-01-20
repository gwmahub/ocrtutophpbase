<?php
// modif1 on chat branch
include_once '../includes/connect.php';

$pseudochat     = isset($_POST['pseudochat']) && !empty($_POST['pseudochat'])? $_POST['pseudochat']:false;
$messagechat    = isset($_POST['messagechat']) && !empty($_POST['messagechat'])? $_POST['messagechat']:false;


if($pseudochat && $messagechat){
    $pseudochat     = htmlspecialchars($pseudochat);
    $messagechat    = htmlspecialchars($messagechat);

    $q = $bdd->prepare('INSERT INTO minichat(pseudo,message,datecrea) VALUES(:pseudochat, :messagechat, :datecrea)');
    $q->execute(
        array(
            'pseudochat'    => $pseudochat,
            'messagechat'   => $messagechat,
            'datecrea'      => date("Y-m-d H:i:s")

        )
    );

    if($q) {
        setcookie('pseudo',$pseudochat,time()+3600,'/','',false,true);
        $q->closeCursor();
    }else{
        echo 'Erreur dans la requête ';
    }

}
header('Location:chathome.php');
?>

