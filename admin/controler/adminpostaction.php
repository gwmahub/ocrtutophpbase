<?php
$action = isset($_GET['action'])?$_GET['action']:'view';
?>


<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
<?php
switch($action){
    case 'view':
        include_once 'adminpostview.php';
        break;

    case 'create':
        include_once 'adminpostcreate.php';
        break;

    case 'edit':
        include_once 'adminpostedit.php';
        break;

    case 'delete':
        include_once 'adminpostdelete.php';
        break;

} // END swtich $action
?>
        </div>
    </div>
</div>
