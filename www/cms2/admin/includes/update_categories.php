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

        $query= "UPDATE  categories SET cat_name='{$the_cat_title}' WHERE cat_id = {$cat_id}";
        $update_query = mysqli_query($connect,$query );
        if(!$update_query){
            die("Query Failead".mysqli_error($connect));
        }
    }
    ?>

    <?php


    }
    }?>



</form>