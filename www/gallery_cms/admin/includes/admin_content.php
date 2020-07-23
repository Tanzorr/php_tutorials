<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
        </h1>
        <?php

//        $result_set = User::find_all_users();
//        while ($row = mysqli_fetch_array($result_set)){
//            echo $row['user_name'].'<br>';
//        }
            $users =  User::find_all_users();

            foreach ($users as $user){
                echo  $user->user_name."<br>";
            }





        ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>