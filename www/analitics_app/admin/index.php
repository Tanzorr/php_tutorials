<?php include("includes/header.php"); ?>
    <!-- Top Menu Items -->
<?php include("includes/top_naw.php"); ?>

    <div class="container-fluid  h-100">

            <div class="row h-100">
                <div class="col-lg-2 h-100 bg-dark">
                    <?php include("includes/sidebar.php"); ?>
                </div>
                <div class="col-lg-9 h-100 ">
                        <?php
                        if (isset($_GET['u_stat_id'])){
                        $user_id = $_GET['u_stat_id'];
                        $action_array = $adminController->getAllUsersActions($user_id);
                        $checkedUser = $adminController->getUser($user_id);

                        if ($action_array === null) {
                            echo "<h2>User does not did any action</h2>";
                        }
                        ?>
                    <h2>Selected User <?php echo $checkedUser->name; ?> </h2>

                    <script type="text/javascript">

                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Users action activity'],
                                <?php


                                foreach ($action_array as $action){
                                    ?>
                                ['<?php echo $action['name'];?>',     <?php echo $action['count_times'];?>],
                                <?php }
                                }
                                ?>
                            ]);

                            var options = {
                                legend: "none",
                                poeSliceText: "label",
                                title: 'Users actions activetis',
                                backgrounColor: 'transparent'
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            var chart2 = new google.visualization.ColumnChart(document.getElementById('column_chart'));

                            chart.draw(data, options);
                            chart2.draw(data, options);
                        }
                    </script>
                    <div id="piechart"></div>
                    <div id="column_chart"></div>
                </div>
            </div>

            <!-- Page Heading -->

            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>