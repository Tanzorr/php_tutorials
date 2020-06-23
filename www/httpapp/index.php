<?php
if(isset($_POST['submit'])) {
    $appUrl = "https://www.coredna.com/assessment-endpoint.php";

    echo $name = $_POST['name'];
    $email = $_POST['email'];
    $my_url = $_POST['url'];

     $data = array("name"=>$name, "email"=>$email,"my_url"=>$my_url );

     $data = json_encode($data);

     var_dump($data);
//
//    $postdata = http_build_query(
//        array("name" => $name, "email" => $email, "my_url" => $my_url)
//    );
//    $opts = array('http' =>
//        array(
//            'method' => 'POST',
//            'header' => 'Content-type: application/x-www-form-urlencoded',
//            'content' => $postdata
//        )
//    );
//    $context = stream_context_create($opts);
//    $result = file_get_contents($appUrl, false, $context);

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>HttpApp</title>
</head>
<body>
<div class="container">
    <h2>Stacked form</h2>
    <form action="" method="post" >
        <div class="form-group">
            <label for="text">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="email">Url</label>
            <input type="text" class="form-control" id="url" placeholder="Ypur url" name="url">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</body>
</html>
