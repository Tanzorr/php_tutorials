<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()){redirect('login.php');} ?>

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

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        User Edit
                    </h1>
                    <?php
                    $user = new User();
                    if(isset($_POST['create'])){
                        if($user) {
                            $user->user_image =$_FILES['user_image']['name'];
                            $user->user_name =  $_POST['user_name'];
                            $user->first_name = $_POST['first_name'];
                            $user->last_name =  $_POST['last_name'];
                            $user->password =  $_POST['password'];
                            $user->set_file($_FILES['user_image']);
                            $user->save_with_image();
                        }
                    }

                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <input type="file" name="user_image" />
                            </div>
                            <div class="form-group">
                                <label for="user_name">Useer Name</label>
                                <input type="text" name="user_name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="user_name">First Name</label>
                                <input type="text" name="first_name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="user_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="user_name">Password</label>
                                <input type="password" name="password" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="create" class="btn btn-success pull-right"/>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>