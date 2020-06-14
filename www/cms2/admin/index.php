<?php  session_start();
if($_SESSION['user_role']!=='admin'){
    header('Location:../index.php');
}
?>
<?php include"./includes/admin_header.php";?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include"./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Panel
                            <small><?php  echo  $_SESSION['username'];?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
                <!--Wiget row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM posts";
                                            $select_all_post = mysqli_query($connect,$query);
                                            $post_counts = mysqli_num_rows($select_all_post);
                                             echo "<div class='huge'>{$post_counts}</div>"
                                        ?>


                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM comments";
                                        $select_all_comments = mysqli_query($connect,$query);
                                        $comments_counts = mysqli_num_rows($select_all_post);
                                        echo "<div class='huge'>{$comments_counts}</div>"
                                        ?>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM users";
                                        $select_all_users = mysqli_query($connect,$query);
                                        $users_counts = mysqli_num_rows($select_all_users);
                                        echo "<div class='huge'>{$users_counts}</div>"
                                        ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories = mysqli_query($connect,$query);
                                        $categories_counts = mysqli_num_rows($select_all_categories);
                                        echo "<div class='huge'>{$categories_counts}</div>"
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End widjet row-->
                <?php
                        $query = "SELECT * FROM posts ";
                        $select_all_post = mysqli_query($connect,$query);
                        $post_counts = mysqli_num_rows($select_all_post);

                        $query = "SELECT * FROM posts WHERE post_status='draft'";
                        $select_all_darft_post = mysqli_query($connect,$query);
                        $post_draft_counts = mysqli_num_rows($select_all_darft_post);

                        $query = "SELECT * FROM comments WHERE comment_status= 'unapproved'";
                        $select_all_unapproved_comments = mysqli_query($connect,$query);
                        $comments_unapproved_counts = mysqli_num_rows($select_all_unapproved_comments);

                        $query = "SELECT * FROM users WHERE user_role='subscriber'";
                        $select_all_subscriber_users = mysqli_query($connect,$query);
                        $users_subscriber_count = mysqli_num_rows($select_all_subscriber_users);


                ?>
                <!--Chart row-->
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Date', 'Count'],
                                <?php
                                    $element_text = ["All posts",'Active Posts','Draft Posts','Comments',
                                        'Panding Comments','Users','Subscribers'
                                        ,'Categories'];
                                    $element_count = [$post_counts,$post_counts,$post_draft_counts, $comments_counts,
                                        $comments_unapproved_counts,
                                        $users_counts,
                                        $users_subscriber_count,
                                        $categories_counts];
                                    for ($i =0; $i < 8; ++$i){
                                        echo "['{$element_text[$i]}'".","."'{$element_count[$i]}'],";
                                    }
                                ?>


                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
                <!--end row-->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include"./includes/admin_footer.php" ?>