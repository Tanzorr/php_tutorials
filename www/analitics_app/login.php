<?php ob_start(); ?>
<?php include("includes/header.php"); ?>
        <h1 class="text-center mt-5">Login</h1>
        <?php
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $frontController->login($email, $password);
        }
        ?>

    <div class="row text-center mt-5 mb-5 ">
        <div class="col-lg-4 mt-5 ">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" id="pwd" required>
                </div>

                <input type="submit" name="submit" class="btn btn-primary">Submit</input>
            </form>
        </div>
    </div>




<?php include ("includes/footer.php") ?>





