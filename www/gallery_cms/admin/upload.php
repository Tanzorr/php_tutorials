<?php include("includes/header.php"); ?>
<?php if
(!$session->is_signed_in()){
    redirect("login.php");
}?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">SB Admin</a>
        </div>
        <!-- Top Menu Items -->
        <?php include("includes/top_naw.php"); ?>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php"); ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">
            <?php
                $message = "";
            if (isset($_FILES['file'])) {
               $photo = new Photo();
               $photo->title = $_POST['title'];
               $photo->set_file($_FILES['file']);
               if ($photo->save_with_image()) {
                   $message = "User uploaded Successfully";
               }else {
                   if(count($photo->errors)>2){
                       $message = join("<br>", $photo->errors);
                   }

               }

            }
            ?>
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Uploads
                        <small>Subheading</small>
                    </h1>
                    <div class="col-md-6">
                        <?php echo $message; ?>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file">
                            </div>
                            <input type="submit" name="submit">
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form action="upload.php" class="drpzone">

                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>