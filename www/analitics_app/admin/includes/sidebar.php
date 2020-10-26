
    <ul class="nav flex-column">
        <?php foreach ( $adminController->allUsers() as $user){ ?>
        <li class="nav-item">
            <a class="nav-link" href="#"><?php echo $user->name;?></a>
        </li>
        <?php }?>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>
    </ul>
