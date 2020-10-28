<?php ob_start(); ?>
<?php include("includes/header.php"); ?>
<?php
if(isset($_GET['id'])) {
    $adminController->deleteActon($_GET['id']);
}

?>

