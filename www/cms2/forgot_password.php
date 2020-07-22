<?php
require './vendor/autoload.php';
//require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
//require './classes/Config.php';
?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "./admin/functions.php"; ?>


<?php


if(!ifItIsMethod('get') && !$_GET['forgot']){
    redirect('index');
}

if(ifItIsMethod('post')){
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $lenght = 50;
        $tocken = bin2hex(openssl_random_pseudo_bytes($lenght));


        if(is_exist($email,'user_email','users')){

           if($stmt = mysqli_prepare($connect,"UPDATE users SET token='{$tocken}' WHERE  user_email=?")){

               mysqli_stmt_bind_param($stmt,"s", $email);
               mysqli_stmt_execute($stmt);

              // mysqli_stmt_close($stmt);

               //Configer phpmailer
               $mail = new PHPMailer();

               echo get_class($mail);

               //Server settings
               //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
               $mail->isSMTP();                                            // Send using SMTP
               $mail->Host       = Config::SMTP_HOST;                    // Set the SMTP server to send through
               $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
               $mail->Username   = Config::SMTP_USER;                     // SMTP username
               $mail->Password   = Config::SMTP_PASSWORD;                               // SMTP password
               //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
               $mail->Port       = Config::SMTP_PORT;
               $mail->isHTML(true);
               $mail->CharSet='UTF-8';

               $mail->setFrom('alexx1984@urk.net', 'Edwin Diaz');
               $mail->addAddress($email);
               $mail->Subject ='This is a test email';
               $mail->Body='<p>Pleas klik to reset your password
                        <a href="localhost/cms2/reset.php?email='.$email.'&token='.$tocken.'">Reset password</a>
                    </p>';
               if($mail->send()){
                   $emailSent =true;
               }else{
                   echo 'Not Sent';
               }
           }else{
               echo "WRONG";
           }

        }
    }
}
?>


<!-- Page Content -->
<div class="container">

        <?php if(!$emailSent){ ?>

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">
                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
        <h2>Please check your email</h2>
    <?php } ?>
    <hr>


    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

