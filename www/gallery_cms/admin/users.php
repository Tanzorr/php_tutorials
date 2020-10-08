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
                        Users
                    </h1>
                    <p class="bg-success"><?php echo $session->message;?></p>
                    <a href="add_user.php" class="btn btn-primary">Add User</a>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Photo</th>
                                <th>User Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $users = User::find_all();
                            foreach ($users as $user){
                                ?>
                                <tr>
                                    <td><?php echo $user->id;?></td>
                                    <td><img class="user_image" src="<?php echo $user->image_path_and_placeholder();?>" alt=""></td>
                                    <td><?php echo $user->user_name;?>
                                        <div class="actions_link">
                                            <a href="delete_user.php?id=<?php echo $user->id?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id?>">Edit</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user->first_name;?></td>
                                    <td><?php echo $user->last_name;?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>