
    <ul class="nav flex-column">
        <?php foreach ( $adminController->allUsers() as $user){ ?>
        <li class="nav-item row">
            <a class="nav-link" href="index.php?u_stat_id=<?php echo $user->id;?> "><?php echo $user->name;?></a>
            <a class="nav-link" href="delete_user.php?id=<?php echo $user->id;?>">x</a>
        </li>
        <?php }?>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>
    </ul>
