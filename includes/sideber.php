<div class="col-md-4">




<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" name="submit" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Login -->
<div class="well">
    <?php if(isset($_SESSION['user_role'])): ?>

    <h4>Login in as <?php echo $_SESSION['users_name'] ?></h4>

    <a href="admin/includes/logout.php" class="btn btn-primary">Log Out</a>

    <?php else: ?>
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Enter UserName">
        </div>
        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Submit</button>
            </span>
        </div>
        
        </form>

    <?php endif; ?>

    
    <!-- /.input-group -->
</div>




<!-- Blog Categories Well -->
<div class="well">
    
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
            <?php
        $query = "SELECT * FROM categories";

        $select_categories_sideber = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_assoc($select_categories_sideber)){

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
        }

    ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <!-- <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div> -->
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Blog Widget Well</h4>
    <?php
    if(isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];
    }
     $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT 15";

     $select_all_post_title = mysqli_query($connection,$query);
     
     while($row = mysqli_fetch_assoc($select_all_post_title)){

        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
    ?>
     <p><a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a></p>
     <?php } ?>
</div>

</div>