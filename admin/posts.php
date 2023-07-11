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
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }
                        else
                        {
                            $source = '';
                        }
                        switch($source){

                          case 'add_post';
                                include "includes/add_post.php";
                          break;
                          
                          case 'edit_post';
                          include "includes/edit_post.php";
                          break;  

                          case '200';
                          echo "Nice 200";
                          break; 
                          
                          default:
                                include "includes/view_all_post.php";
                          break;
                        }
                        
                        
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php"?>
    