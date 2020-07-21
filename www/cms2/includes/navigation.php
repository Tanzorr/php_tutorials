<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms2">CMS Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            <?php
                $query = "SELECT * FROM categories LIMIT 3 ";
                $select_all_categories_query = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_assoc($select_all_categories_query)){
                    $cat_title = $row['cat_name'];
                    $cat_id = $row['cat_id'];
                    $category_class='';
                    $registration_class='';
                    $contact_class='';
                    $pageName = basename($_SERVER['PHP_SELF']);
                    $registration = 'registration.php';
                    $contact = 'contact.php';

                    if(isset($_GET['category']) && $_GET['category']===$cat_id){

                        $category_class ='active';
                    }elseif ($pageName ==$registration){
                        $registration_class ="active";
                    }elseif ($pageName ==$contact){
                        $contact_class = "active";
                    }


                    echo "<li class='$category_class'><a href='/cms2/category/$cat_id'>{$cat_title}</a></li>";

                }

            ?>

                    <?php  if(isset($_SESSION['user_role']) && $_SESSION['user_role'] ==='admin'){
                        echo "<li><a href='/cms2/admin'>Admin</a></li>";

                        if (isset($_GET['p_id'])){
                            $the_post_id = $_GET['p_id'];
                            echo "<li><a href='/cms2/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                        }
                    }else{
                       echo " <li><a href='/cms2/login.php'>Login</a></li>";
                    } ?>

                     <li class="<?php echo $registration_class ?>"><a href='/cms2/registration'>Registration</a></li>
                     <li class="<?php echo $contact_class ?>"><a href='/cms2/contact'>Contact</a></li>
                     <li ><a href='/cms2/lend_test.php'>land_test</a></li>
                     <li ><a href='/cms2/covid_api.php'>covid_app</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
