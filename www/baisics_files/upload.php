<?php
if (isset($_POST['submit'])) {
//    echo "<pre>";
//    print_r($_FILES['file_upload']);
//    echo "</pre>";


    $upload_errors = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file execeeds the upload_max_filesize directive",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file execeeds the MAX_FILE_SIZE directive",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file waw uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."

    );


    echo $the_file = $_FILES['file_upload']['tmp_name'];
    echo "<br>";
    echo $temp_name = $_FILES['file_upload']['name'];
    $directory = "uploads";
   ;

    if ( move_uploaded_file($the_file,"uploads/$temp_name")) {
        echo $the_message = "File uploaded successfully";
    } else {
        $the_error = $_FILES['file_upload']['error'];
        $the_message = $upload_errors[$the_error];
   }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <?php
        if (!empty($upload_errors)){
            echo $the_message;
        }
    ?>
    <input type="file" name="file_upload"><br>
    <input type="submit" name="submit">
</form>
</body>
</html>
