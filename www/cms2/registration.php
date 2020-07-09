<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php  include "admin/functions.php"; ?>

<?php
    if (isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $error =[
                'username'=>'',
                'email'=>'',
                'password'=>'',
        ];

        if(strlen($username)<4){
            $error['username'] = "User name should be longer";
        }
        if($username===""){
            $error['username']="User name cant be empty";
        }

        if(is_exist($username, "user_name","users")){
            $error['username'] ="User ".$username."already exists pic another one";
        }


        if($$email===""){
            $error['email']="Email  cant be empty";
        }

        if(is_exist($email, "user_email","users")){
            $error['email'] ="Email ".$email."already exists <a href='index.php'>Please login</a>";
        }

        if($password ==''){
            $error['password']='Password cannot be empty';
        }

        foreach ($error as $key=>$value){
            if(empty($value)){
               unset($error[$key]);
            }
        }

        if (empty($error)){
            register_user($username,$email,$password);
            $message = "You are seccsseful register";
        }

    }
?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <p><?php echo $message; ?></p>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username"
                                   autocomplete="on"
                                   value="<?php echo isset($username)? $username:''?>"
                                   class="form-control" placeholder="Enter Desired Username">
                                <p><?php echo isset($error['username'])? $error['username']:''?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email"
                                   autocomplete="on"
                                   value="<?php echo isset($email)? $email:''?>"
                                   class="form-control"
                                   placeholder="somebody@example.com">
                             <p><?php echo isset($error['email'])? $error['email']:''?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                             <p><?php echo isset($error['password'])? $error['password']:''?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
