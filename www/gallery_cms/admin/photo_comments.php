<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()){redirect('login.php');} ?>
<?php
if (empty($_GET['id'])){
    redirect('photos.php');
}
$comments = Comment::find_the_comments($_GET['id']);


?>

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
                        Comments
                    </h1>
                    <a href="add_Comment.php" class="btn btn-primary">Add Comment</a>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Comment mange</th>
                                <th>Author</th>
                                <th>body</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $Comments = Comment::find_all();
                            foreach ($Comments as $Comment){
                                ?>
                                <tr>
                                    <td><?php echo $Comment->id;?></td>
                                    <td><?php echo $Comment->photo_id;?>
                                        <div class="actions_link">
                                            <a href="delete_comment.php?id=<?php echo $Comment->id?>">Delete</a>

                                        </div>
                                    </td>
                                    <td><?php echo $Comment->author;?></td>
                                    <td><?php echo $Comment->body;?></td>
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