<?php ob_start(); ?>
<?php include("includes/header.php"); ?>


<?php
if (isset($_POST['submit'])){
    $adminController->addUser($_POST);
}
?>

    <!-- Top Menu Items -->
<?php include("includes/top_naw.php"); ?>

    <div class="container-fluid  h-100">

        <div class="row h-100">
            <div class="col-lg-2 h-100 bg-dark">
                <?php include("includes/sidebar.php"); ?>
            </div>
            <div class="col-lg-9 h-100 ">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="email">User name</label>
                        <input type="text" name="name" class="form-control" placeholder="User name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="role">User role</label>
                        <select class="form-control" name="role">
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
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

        <!-- Page Heading -->

        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>