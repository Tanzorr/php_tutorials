<?php ob_start(); ?>
<?php include("includes/header.php"); ?>

<?php
if (isset($_POST['submit'])){
    $adminController->addAction($_POST);
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
                        <label for="email">Actin name</label>
                        <input name="name" type="text" class="form-control" placeholder="Action name" id="name">
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