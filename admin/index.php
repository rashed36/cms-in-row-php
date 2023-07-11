<?php include "includes/admin_header.php"?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WellCome To Admin

                            <small><?php echo $_SESSION['users_name'] ?></small>
                        </h1>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM posts";
                                                $select_all_post = mysqli_query($connection,$query);
                                                $post_count = mysqli_num_rows($select_all_post);

                                                echo "<div class='huge'>{$post_count}</div>";
                                                ?>
                                        
                                                <div>Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                $query = "SELECT * FROM comments";
                                                $select_all_comments = mysqli_query($connection,$query);
                                                $comments_count = mysqli_num_rows($select_all_comments);

                                                echo "<div class='huge'>{$comments_count}</div>";
                                                ?>
                                            <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                $query = "SELECT * FROM users";
                                                $select_all_users = mysqli_query($connection,$query);
                                                $users_count = mysqli_num_rows($select_all_users);

                                                echo "<div class='huge'>{$users_count}</div>";
                                                ?>
                                                <div> Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                $query = "SELECT * FROM categories";
                                                $select_all_cat = mysqli_query($connection,$query);
                                                $cat_count = mysqli_num_rows($select_all_cat);

                                                echo "<div class='huge'>{$cat_count}</div>";
                                                ?>
                                                <div>Categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="categories.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $select_all_draft_post = mysqli_query($connection,$query);
                    $post_active_count = mysqli_num_rows($select_all_draft_post);

                    $query = "SELECT * FROM posts WHERE post_status = 'unpublished'";
                    $select_all_draft_post = mysqli_query($connection,$query);
                    $post_draft_count = mysqli_num_rows($select_all_draft_post);

                    $query = "SELECT * FROM comments WHERE comment_status = 'unapprove'";
                    $select_all_unapprove_comments = mysqli_query($connection,$query);
                    $comments_unapprove_count = mysqli_num_rows($select_all_unapprove_comments);

                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $select_all_subscriber_users = mysqli_query($connection,$query);
                    $comments_subscriber_count = mysqli_num_rows($select_all_subscriber_users);
                ?>

                <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                        <?php
                            $element_text = ['Active Post','Draft Posts', 'Categories', 'Users', 'Subscriber', 'Comments', 'Unapprove Comments'];
                            $element_count = [$post_active_count, $post_draft_count, $cat_count, $users_count, $comments_subscriber_count, $comments_count, $comments_unapprove_count];

                            for($i=0; $i<7; $i++)
                            {
                                echo"['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }
                        ?>
                        
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>
                     <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>

    </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php"?>
    