<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="./search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>
    <!--Login-->
    <div class="well">
        <?php if (isset($_SESSION['user_role'])){ ?>
            <h4>Loged in as <?php echo $_SESSION['username'] ?></h4>
            <a href="/cms2/includes/logout.php" class="btn btn-primary">Logout</a>
        <?php }else{?>
        <h4>Login</h4>
        <form action="/cms2/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username"/>
            </div>

            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password"/>
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
        <?php }?>

    </div>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>

        <?php
        $query = "SELECT * FROM categories ";
        $slect_all_categories_sidebar = mysqli_query($connect, $query);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($slect_all_categories_sidebar)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_name'];
                        echo "<li><a href='/cms2/category/$cat_id''>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php";?>

</div>