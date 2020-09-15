<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
        </h1>
        <?php

        $user = Photo::find_by_id(1);
        var_dump($user);
        echo $user->filename;

//        $photos = Photo::find_all();
//            foreach ($photos as $photo) {
//                echo $photo->title;
//            }

//        $photo = new Photo();
//        $photo->title = "Photo title 2";
//        $photo->save();


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