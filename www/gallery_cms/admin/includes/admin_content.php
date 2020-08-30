<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
        </h1>
        <?php
            $user = new User();
            $user->user_name= "Edvin 45";
            $user->save();


//             $user = User::find_user_by_id(3);
//             $user->user_name = "WhatAwerNew";
//             $user->password = "WhatAwerNew";
//             $user->last_name ="WILLIAMSNEw";
//             $user->update();

       // $user->delete();

//        $users = User::find_all();
//        //var_dump($users);
//        echo 'Use';
//        foreach ($users as $user) {
//            //var_dump($user);
//            echo $user->user_name;
//        }


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