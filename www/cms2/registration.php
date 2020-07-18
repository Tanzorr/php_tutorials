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

<?php
if(isset($_GET['lang']) && !empty($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];
    if(isset($_SESSION['lang']) && $_SESSION['lang'] ==$_GET['lang']){
        echo "<script>loction.reload() </script>";

        if(isset($_SESSION['lang'])){
            include "includes/languages/".$_SESSION['lang'].".php";
        }else{
            include "includes/languages/en.php";
        }
    }

}
?>
<!-- Page Content -->
<div class="container">
    <form action="" id="language_form" class="navbar-form navbar-right form-control" method="get">
        <div class="form-group" >
            <select name="lang" onchange="changeLanguage()" >
                <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=='en'){echo "selected";} ?>>English</option>
                <option value="es"<?php if(isset($_SESSION['lang']) && $_SESSION['lang']=='es'){echo "selected";} ?>>Spanish</option>
            </select>
        </div>
    </form>
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER;?></h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <p><?php echo $message; ?></p>
                        <div class="form-group">
                            <label for="username" class="sr-only"><?php echo _USERNAME;?></label>
                            <input type="text" name="username" id="username"
                                   autocomplete="on"
                                   value="<?php echo isset($username)? $username:''?>"
                                   class="form-control" placeholder="<?php echo _USERNAME;?>">
                                <p><?php echo isset($error['username'])? $error['username']:''?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only"><?php echo _EMAIL;?></label>
                            <input type="email" name="email" id="email"
                                   autocomplete="on"
                                   value="<?php echo isset($email)? $email:''?>"
                                   class="form-control"
                                   placeholder="somebody@example.com">
                             <p><?php echo isset($error['email'])? $error['email']:''?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only"><?php echo _PASSWORD;?></label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD;?>">
                             <p><?php echo isset($error['password'])? $error['password']:''?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="<?php echo _REGISTER;?>">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>
    <script>
        function changeLanguage() {
            document.getElementById('language_form').submit()
        }
    </script>


<?php include "includes/footer.php";?>
