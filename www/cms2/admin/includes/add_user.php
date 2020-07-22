<?php
    if(isset($_POST['create_user'])){

       $user_first_name = $_POST['first_name'];
        $user_last_name = $_POST['last_name'];
        $user_role = $_POST['user_role'];

//        $post_image =$_FILES['image']['name'];
//        $post_image_temp = $_FILES['image']['tmp_name'];

        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password =$_POST['user_password'];

       $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10));

        //$post_date = date('d-m-y');
        //$post_comment_count =4;

//        move_uploaded_file($post_image_temp,"../images/$post_image");
        $query = "INSERT INTO `users`( `user_name`, `user_password`, `user_first_name`, `user_last_name`,
                           `user_email`, `user_image`, `user_role`)
              VALUES ('{$user_name}','{$user_password}','{$user_first_name}','{$user_last_name}','{$user_email}',
              'image','{$user_role}')";
        $create_user = mysqli_query($connect, $query);
        confirm($create_user);
        header("Location: users.php");

//        if(isset($create_user)){
//            ?>
<!--            <p>User Created <a herf='users.php' style='cursor: pointer'>View Users</a></p>-->
<!--        --><?php
//        }



    } ?>

<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="post_tags">First Name</label>
        <input type="text" class="form-control" name="first_name">
    </div>

    <div class="form-group">
        <label for="post_tags">Last Name</label>
        <input type="text" class="form-control" name="last_name">
    </div>


    <div class="form-group">
        <label for="category">User Role</label>
        <select name="user_role" id="user_role" >
            <option value="subscruber">Select Optons</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>

    </div>

    <div class="form-group">
        <label for="post_image">User Name</label>
        <input type="text"  class="form-control"  name="user_name">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password"  class="form-control"  name="user_password">
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="add User">
    </div>


</form>