<?php require("../../init.php");

$photo =new Photo();
if (isset($_POST['image_name'])){

    $photo->ajax_save_photo_image($_POST['image_name'], $_POST['photo_id']);
}

