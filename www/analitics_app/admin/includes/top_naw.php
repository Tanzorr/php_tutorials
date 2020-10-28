<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="/analitics_app/index.php">Wisit site</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-primary" href="add_user.php">Add User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-success" href="add_action.php">Add Action</a>
        </li>
        <?php
        foreach($adminController->allActions() as $action){
        ?>
        <li class="nav-item">
            <span class="nav-link "><b><?php echo $action->name; ?></b><a class="nav-link" href="delete_action.php?id=<?php echo $action->id?>">x</a></span>
        </li>
        <?php }; ?>
        <?php  if($session->signed_in === false){ ?>
            <li class="nav-item">
                <a class="nav-link" href="/analitics_app/login.php">login</a>
            </li>
        <?php }else{?>
            <li class="nav-item">
                <a class="nav-link" href="/analitics_app/logout.php">logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" disabled> Hi <?php echo $_SESSION['user_name'];?></a>
            </li>

        <?php } ?>
    </ul>
</nav>
<?php
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    $model = new Model();
    $model->redirect('/analitics_app/index.php');
}
    ?>