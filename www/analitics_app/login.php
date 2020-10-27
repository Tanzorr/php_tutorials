<?php include("includes/header.php"); ?>

<div class="conatainer">
    <form action="#" method="post">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" id="email" required>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" id="pwd" required>
        </div>

        <input type="submit" name="submit" class="btn btn-primary">Submit</input>
    </form>
</div>


<?php include ("includes/footer.php") ?>





