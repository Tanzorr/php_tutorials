<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <?php if ($_SESSION['user_roel']) { ?>
        <li class="nav-item">
            <a class="nav-link" href="admin/index.php">Dashboard</a>
        </li>
        <?php }?>
    <?php  if($session->signed_in === false){ ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">login</a>
        </li>
        <?php }else{?>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">logout</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" disabled> Hi <?php echo $_SESSION['user_name']?></a>

        </li>
        <?php } ?>
    </ul>
</nav