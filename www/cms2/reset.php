<?php ob_start();?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "./admin/functions.php"; ?>


<?php
    if(!isset($_GET['email']) && !isset($_GET['token'])){
        redirect('index');
    }



if($stmt = mysqli_prepare($connect, 'SELECT user_name, user_email, token FROM users WHERE token=?')) {
    mysqli_stmt_bind_param($stmt, 's', $_GET['token']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $email, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);



//    if ($_GET['token'] !==$token || $_GET['email'] !==$email){
//        redirect('index');
//    }
    if (isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
        if ($_POST['password'] === $_POST['passwordConfirm']) {
            $password = $_POST['password'];
            $hashPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

            if ($stmt = mysqli_prepare($connect, "UPDATE users SET token='',
user_password='{$hashPassword}' WHERE user_email = ?")) {

                var_dump($_GET['email']);
                mysqli_stmt_bind_param($stmt, 's', $_GET['email']);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) >= 1) {
                     redirect('/cms2/login.php');
                }
                //mysqli_stmt_close($stmt);
            }else{
                echo "Wrong connection";
            }
        }else{
            echo "Confirm Password are different";
        }

    }
}
?>

<!-- Navigation -->
<?php include "./includes/navigation.php"?>



<!-- Page Content -->
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <input id="password" name="password" placeholder="password1" class="form-control"  type="password">
                                    </div>
                                    <div class="form-group">
                                        <input id="passwordConfirm" name="passwordConfirm" placeholder="password2" class="form-control "  type="password">
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                            <h2>Please check your email</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->
