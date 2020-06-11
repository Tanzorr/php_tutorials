<?php session_start();?>
<?php include"./includes/admin_header.php";?>
<?php
    if (isset($_SESSION['username'])){

        $this_user_name = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE user_name = '{$this_user_name}'";
        $select_user_query = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($select_user_query)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_first_name = $row['user_first_name'];
            $user_last_name = $row['user_last_name'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }

    }
?>
<?php
if(isset($_POST['update_profile'])){

    $user_first_name = $_POST['first_name'];
    $user_last_name = $_POST['last_name'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password =$_POST['user_password'];


    //  move_uploaded_file($post_image_temp,"../images/$post_image");
    $query = "UPDATE `users` SET 
                        `user_name`='{$user_name}',
                        `user_password`='{$user_password}',
                        `user_first_name`='{$user_first_name}',
                        `user_last_name`='{$user_last_name}',
                        `user_email`='{$user_email}',
                        `user_image`='imageU',
                         `user_role`='{$user_role}'
                           WHERE user_name = '{$this_user_name}'";
}

$update_user = mysqli_query($connect, $query);

confirm($update_user);

?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include"./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Panel
                            <small>Admin</small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="post_tags">First Name</label>
                                <input type="text" value="<?php echo $user_first_name; ?>" class="form-control" name="first_name">
                            </div>

                            <div class="form-group">
                                <label for="post_tags">Last Name</label>
                                <input type="text" class="form-control" value="<?php echo $user_last_name; ?>" name="last_name">
                            </div>


                            <div class="form-group">
                                <label for="category">CUser  Role</label>
                                <select name="user_role" id="user_role" >
                                    <option value="<?php echo $user_role?>"><?php echo $user_role?></option>
                                    <?php
                                    if ($user_role === 'admin'){
                                        echo "<option value = 'subscriber'>subscriber</option>";

                                    }else{
                                        echo "<option value = 'admin'>admin</option>";
                                    }
                                    ?>

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="post_image">User Name</label>
                                <input type="text"  class="form-control" value="<?php echo $user_name; ?>"  name="user_name">
                            </div>

                            <div class="form-group">
                                <label for="post_tags">Email</label>
                                <input type="email" class="form-control"  value="<?php echo $user_email; ?>"   name="user_email">
                            </div>

                            <div class="form-group">
                                <label for="post_content">Password</label>
                                <input type="text"  class="form-control"  value="<?php echo $user_password; ?>"   name="user_password">
                            </div>



                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                            </div>


                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include"./includes/admin_footer.php" ?>