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
                            <small>
                            <?php
                                if(isset($_SESSION['users_name'])){
                                    echo $_SESSION['users_name'];
                                }
                            ?> 
                            </small>
                        </h1>
                        <div class="col-xs-6">
                        <?php insert_categories(); ?>                        
                            <form action="" method="POST">
                                <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title" id="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                           <?php
                           if(isset($_GET['edit'])){
                               $cat_id = $_GET['edit'];

                               include "includes/update_categories.php";
                           }
                           ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php show_categories(); ?>
                                    <?php delete_categories(); ?>
                                </tbody>
                            </table>                        
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php"?>
    