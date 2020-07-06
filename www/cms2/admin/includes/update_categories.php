<form action="" method="post">
    <div class="form-group">
        <?php
        if (isset($_GET['edit'])){
        $cat_id =$_GET['edit'];

        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $select_categories_id=
            mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_name'];
        ?>
        <label for="Cat_title">Edit Category Title</label>
        <input class="form-control" type="text" name="cat_title"
               value="<?php echo $cat_title?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_cat" value="Update Category">
    </div>
    <?php //Update query

    if (isset($_POST['update_cat'])){
        $the_cat_title =$_POST['cat_title'];

        $stmt= mysqli_prepare($connect,"UPDATE  categories SET cat_name=? WHERE cat_id = ?");
        mysqli_stmt_bind_param($stmt,'si',$the_cat_title, $cat_id);
        mysqli_stmt_execute($stmt);
        if(!$stmt){
            die("Query Failead".mysqli_error($connect));
        }
        mysqli_stmt_close($stmt);
        redirect('./categories.php');
    }
    ?>

    <?php


    }
    }?>



</form>