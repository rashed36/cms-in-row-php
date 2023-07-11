<?php

    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];

    }
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_posts_by_id))
     {
        $post_id = $row['post_id'];
        $post_author  = $row['post_author'];
        $post_title  = $row['post_title'];
        $post_category_id   = $row['post_category_id'];
        $post_image  = $row['post_image'];
        $post_content  = $row['post_content'];
        $post_tags  = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date  = $row['post_date'];
    }

    if(isset($_POST['update_post']))
    {
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];

        $post_image = $_FILES['image']['name'];
        $post_images_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_images_temp, "../images/$post_image");

        if(empty($post_image))
        {
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

            $select_image = mysqli_query($connection,$query);

            while($row = mysqli_fetch_array($select_image))
            {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_category_id = '{$post_category_id}',post_title='{$post_title}',post_author ='{$post_author}',post_date = now(),post_image ='{$post_image}',post_content = '{$post_content}',post_tags='{$post_tags}' WHERE post_id = {$the_post_id}";

        $update_post = mysqli_query($connection,$query);

        ConfirmQuery($update_post);

        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit more post</a></p>";


    }

?>

<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="post_title" id="title">
    </div>

    <div class="form-group">
        <label for="post_cat_id">Post Category Id</label>
        <select class="form-control" name="post_category_id" id="post_cat_id">
        <?php
             $query = "SELECT * FROM categories";

             $select_categories = mysqli_query($connection,$query);

             ConfirmQuery($select_categories);

             while($row = mysqli_fetch_assoc($select_categories))
             {
                 $cat_id = $row['cat_id'];
                 $cat_title = $row['cat_title'];

                 if($cat_id == $post_category_id){

                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                 }else{
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                 }
             }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select class="form-control" name="post_author" id="post_author">
        <?php         
            echo "<option value='{$_SESSION['users_name']}'>{$_SESSION['users_name']}</option>";
        ?>
        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="Image">
        <input type="file" name="image" id="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <div id="editor">
        <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"> <?php echo $post_content; ?> </textarea>
        </div>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" VALUE="Update Post">
    </div>

</form>