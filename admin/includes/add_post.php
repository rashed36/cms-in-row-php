<?php

    if(isset($_POST['create_post'])){

        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_images_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        //$post_comment_count = 4;

        move_uploaded_file($post_images_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";
        
        $query .="VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        ConfirmQuery($create_post_query);
        
         $the_post_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post Created.<a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit more post</a></p>";


    
    }
   

?>


<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" id="title">
    </div>

    <div class="form-group">
        <label for="post_cat_id">Post Category</label>
        <select class="form-control" name="post_category_id" id="post_cat_id">
        <?php
             $query = "SELECT * FROM categories";

             $select_categories = mysqli_query($connection,$query);

             ConfirmQuery($select_categories);

             while($row = mysqli_fetch_assoc($select_categories))
             {
                 $cat_id = $row['cat_id'];
                 $cat_title = $row['cat_title'];

                 echo "<option value='{$cat_id}'>{$cat_title}</option>";
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
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status" id="post_status">
        <option value="published">Published</option>
        <option value="unpublished">UnPublished</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image" id="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <div id="editor">
        <textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>
        </div>
    </div>
    </br>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" VALUE="Publish Post">
    </div>

</form>