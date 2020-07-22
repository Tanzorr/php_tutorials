<?php  include "./includes/db.php";
session_start();
error_reporting(E_ALL);
include "./admin/functions.php"
?>

<?php  include "./includes/header.php"?>
    <!-- Navigation -->
<?php include "./includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">

    <div class="row">
        <?php
        $url = 'https://covidnigeria.herokuapp.com/api';
        // Collection object
       $ch = curl_init();
       curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
       curl_setopt($ch,CURLOPT_URL,$url);

        $response = curl_exec($ch);
        $data=  json_decode($response,true);

        curl_close($ch);

      //  var_dump($data['data']);



        //var_dump($response);

        ?>
        <!-- Blog Entries Column -->
      <div class="col-lg-8">
          <h2>All cases</h2>
         <h1>Covid 19 in Nigeria</h1>
          <table class="table table-bordered table-hover">
              <thead>
                <tr>
                    <td>totalSamplesTested</td>
                    <td>totalConfirmedCases</td>
                    <td>totalActiveCases</td>
                    <td>discharged</td>
                    <td>death</td>
                </tr>
              </thead>
              <tbody>
              <?php
                echo "<tr>";
                echo "<td>".$data['data']['totalSamplesTested']."</td>";
                echo "<td>".$data['data']['totalConfirmedCases']."</td>";
                echo "<td>".$data['data']['totalActiveCases']."</td>";
                echo "<td>".$data['data']['discharged']."</td>";
                echo "<td>".$data['data']['death']."</td>";
                echo "</tr>";
              ?>

              </tbody>
          </table>

          <h2>In states</h2>
          <h1>Covid 19 in Nigeria</h1>
          <table class="table table-bordered table-hover">
              <thead>
              <tr>
                  <td>state</td>
                  <td>confirmedCases</td>
                  <td>casesOnAdmission</td>
                  <td>discharged</td>
                  <td>death</td>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach ($data['data']['states']as $state){
                  echo "<tr>";
                  echo "<td>".$state['state']."</td>";
                  echo "<td>".$state['confirmedCases']."</td>";
                  echo "<td>".$state['casesOnAdmission']."</td>";
                  echo "<td>".$state['discharged']."</td>";
                  echo "<td>".$state['death']."</td>";
                ;
                  echo "</tr>";
              }

              ?>

              </tbody>
          </table>



      </div>



        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php"?>

    </div>
    <!-- /.row -->
    <!-- Footer -->

<?php include "./includes/footer.php"?>