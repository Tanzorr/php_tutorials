<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
        </h1>
        <?php
            $user = new User();
            $user->username = "Vasil";
            $user->password = "123";
            $user->first_name = "Vasil";
            $user->last_name = "Ivanov";

            $user->create();
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