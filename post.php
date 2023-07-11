
<?php include "includes/db.php"?>
<?php include "includes/header.php"?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"?>

    <!-- LIKE QUERY -->
    <?php
        if(isset($_POST['liked'])) {
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];

            $query = "SELECT *FROM posts WHERE post_id=$post_id";
            $postResult = mysqli_query($connection, $query);
            $post = mysqli_fetch_array($postResult);
            $likes = $post['likes'];
            mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id=$post_id");
            mysqli_query($connection, "INSERT INTO likes(users_id, post_id) VALUES($user_id, $post_id)");
            exit();
        }
    ?>
    <!-- Unlike Query -->
    <?php
        if(isset($_POST['unliked'])) {
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];

            $query = "SELECT *FROM posts WHERE post_id=$post_id";
            $postResult = mysqli_query($connection, $query);
            $post = mysqli_fetch_array($postResult);
            $unlike = $post['unlike'];
            mysqli_query($connection, "UPDATE posts SET unlike=$unlike+1 WHERE post_id=$post_id");
            mysqli_query($connection, "INSERT INTO likes(users_id, post_id) VALUES($user_id, $post_id)");
            exit();
        }
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 

                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];

                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                    $send_query = mysqli_query($connection, $view_query);

                    if(!$send_query){
                        die("Query failed");
                    }

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    $select_all_posts_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query))
                    {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

                        ?>
                        <!-- Blog Post -->
                            <h2>
                                <a href="#"><?php echo $post_title?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                            <hr>
                            <p><?php echo $post_content?></p>
                          
                            <hr>
                       
                             <div class="row">
                                <p class="pull-right" style="margin:0px 5px; font-size:30px;"><a class="unlike" href=""><i class="far fa-thumbs-down"></i></a></p>
                                <p class="pull-right" style="margin:0px 5px; font-size:30px;"><a class="like" href=""><i class="far fa-thumbs-up"></i></a></p>
                            </div>

                            <div class="row">
                            <?php
                            if(isset($_GET['p_id'])){
                                $the_post_id = $_GET['p_id'];
                        
                            }
                            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                            $select_posts_by_id = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_posts_by_id))
                            {
                                $likes = $row['likes'];
                                $unlikes = $row['unlike'];
                            }
                            ?>
                            <p class="pull-right" style="margin:0 10px; font-size:18px; padding: 0px 7px;"><?php echo $unlikes; ?> </p>
                            <p class="pull-right" style="margin:0 10px; font-size:18px; padding: 0px 7px;"><?php echo $likes; ?> </p>
                            

                            </div>

                            <div class="clearfix"></div>

                                    <?php  
                    } }
                    
                    else{
                        header("Location: index.php");
                    }
                ?>
               

                <?php
                    if(isset($_POST['create_comment']))
                    {
                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content))
                     {
                        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";

                        $query .="VALUES({$the_post_id},'{$comment_author}','{$comment_email}','{$comment_content}','approve',now())";

                        $create_comment_query = mysqli_query($connection, $query);

                        if(!$create_comment_query){
                            die('QUERY FAILED' . mysqli_error($connection));
                        }

                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";

                        $query .= "WHERE post_id = '$the_post_id' ";

                        $update_comment_count = mysqli_query($connection,$query);
                     }
                     else{
                         echo "<script>alert('Field cannot be empty')</script>";
                     }

                    }

                ?>

                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST" role="form">

                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author" id="Author">
                        </div>

                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email" id="Email">
                        </div>

                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3" id="comment"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                        </div>
                        
                        
                    </form>
                </div>

                <hr>

               
                
                    <?php

                    $query = "SELECT * FROM comments WHERE comment_post_id = '{$the_post_id}'";

                    $query .="AND comment_status = 'approve' ";

                    $query .="ORDER BY comment_id DESC";

                    $select_comment_query = mysqli_query($connection,$query);

                    if(!$select_comment_query)
                    {
                        die("QUERY FAILED ." . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($select_comment_query))
                    {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];
                        ?>

                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>


                    <?php }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sideber.php"?>
            

        </div>
        <!-- /.row -->

       
        <!-- Footer -->
        <?php include "includes/footer.php"?>   

        <script>
        $(document).ready(function(){
            var post_id = <?php echo $the_post_id ?>;
            var user_id = 28;
            //LIKE
            $('.like').click(function(){
                $.ajax({
                    url: "/cms/post.php?p_id=<?php echo $the_post_id;?>",
                    type: 'post',
                    data:{
                        'liked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            });
            //UNLIKE
            $('.unlike').click(function(){
                $.ajax({
                    url: "/cms/post.php?p_id=<?php echo $the_post_id;?>",
                    type: 'post',
                    data:{
                        'unliked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            });
        });
        </script>    
