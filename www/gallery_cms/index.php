<?php include("includes/header.php"); ?>

    <body>

    <!-- Navigation -->
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
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <div class="thumbnails row">
            <?php
            $page = !empty($_GET['page']) ? (int)$_GET['page'] :1;
            $items_per_page = 4;
            $items_total_count = Photo::count_all();
            $paginate = new Paginate($page, $items_per_page, $items_total_count);

            $sql = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
            $photos = Photo::find_by_query($sql);
            //$photos = Photo::find_all();
                foreach ($photos as $photo){
                    ?>

                 <div class="col-xs-6 col-lg-3 col-lg-offset-1">
                     <a href="photo.php?id=<?php echo $photo->id?>" >
                         <img class="thumbnail home_page_photo img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="picture">
                     </a>
                 </div>
                <?php } ?>
            </div>
            <div class="row">
                <ul class="pager">
                    <?php
                    if ($paginate->page_total() > 1){
                        if ($paginate->has_prev()) {
                            echo "<li><a href='index.php?page={$paginate->prev()}' class='next'>Prev</a></li>";
                        }
                            for ($i=1; $i<=$paginate->page_total(); $i++){
                                if ($i == $paginate->current_page) {
                                    echo "<li class='active'><a href='index.php?page={$i}'>$i</a></li>";
                                }else{
                                    echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                                }
                            }

                        if ($paginate->has_next()) {
                            echo "<li><a href='index.php?page={$paginate->next()}' class='next'>Next</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
            <?php include("includes/sidebar.php"); ?>

        </div>

    </div>
    <!-- /.row -->

<?php include("includes/footer.php"); ?>