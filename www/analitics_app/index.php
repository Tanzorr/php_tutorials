<?php include("includes/header.php"); ?>
<?php include ("includes/navigation.php") ?>
    <!-- Page Content -->
<div class="container">

    <div class="row text-center">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php
            if (isset($_SESSION['user_id']) && isset($_GET['act_id']) ){
                $user_id = $_SESSION['user_id'];
                $action_id = $_GET['act_id'];
                $frontController->setActionData($user_id, $action_id);
            }

            $colors = ['btn btn-success', 'btn-danger', 'btn-primary'];
            foreach ($frontController->allActions() as $action){?>
                <a class="btn <?php echo $colors[array_rand($colors)]; ?> mt-5 " href="index.php?act_id=<?php echo $action->id;?>"><?php  echo $action->name;?></a>
            <?php }?>
            </div>
        </div>


    </div>
    <!-- /.row -->
    <?php include ("includes/footer.php") ?>


