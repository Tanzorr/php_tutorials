<?php  session_start();
if($_SESSION['user_role']!=='admin'){
    header('Location:../index.php');
}
//include "functions.php";
?>
<?php include"./includes/admin_header.php";?>
<?php users_online();?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include"./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin Dashboard
                            <small><?php  echo strtoupper(get_user_name());?></small>
                        </h1>


                    </div>
                </div>
                <!-- /.row -->
                <!--Wiget row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        ;
                                        $post_counts = recordCount("posts");
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
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php

                                        //$comments_counts =recordCount('comments');
                                        $comments_counts = count_record(get_all_posts_user_comments());
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
<!--                    <div class="col-lg-3 col-md-6">-->
<!--                        <div class="panel panel-yellow">-->
<!--                            <div class="panel-heading">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-xs-3">-->
<!--                                        <i class="fa fa-user fa-5x"></i>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-9 text-right">-->
<!--                                        --><?php
//
//                                        $users_counts = recordCount("users");
//                                        echo "<div class='huge'>{$users_counts}</div>"
//                                        ?>
<!--                                        <div> Users</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <a href="users.php">-->
<!--                                <div class="panel-footer">-->
<!--                                    <span class="pull-left">View Details</span>-->
<!--                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>-->
<!--                                    <div class="clearfix"></div>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $categories_counts = count_record(get_all_user_categories());
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

                $post_counts =count_record(get_all_user_post());
                $post_published_counts = count_record(get_all_users_published_posts());
                $post_draft_counts = count_record(get_all_users_draft_posts());
                $comments_unapproved_counts = count_record(get_all_unupproved_posts_comments());
                $comments_approved_counts = count_record(get_all_upproved_posts_comments());

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
                                    'Upproved Comments',
                                    'UnUpproved Comments',
                                    'Categories'];
                                $element_count = [$post_counts,$post_published_counts,$post_draft_counts, $comments_counts,
                                    $comments_unapproved_counts,
                                    $comments_approved_counts,
                                    $categories_counts];
                                for ($i =0; $i < count($element_count); ++$i){
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