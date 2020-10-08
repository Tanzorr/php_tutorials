<?php require("../../init.php");

$photo =new Photo();
if (isset($_POST['image_name'])){

    $photo->ajax_save_photo_image($_POST['image_name'], $_POST['photo_id']);
}

if (isset($_POST['image_id'])){
    echo "Photo id is worcs";
    $this_photo = Photo::find_by_id($_POST['image_id']);
    echo $this_photo->title."<br>";
    echo $this_photo->description."<br>";
    echo $this_photo->size."<br>";
}

