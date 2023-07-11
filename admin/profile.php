<?php include "includes/admin_header.php"?>
<?php
     if(isset($_SESSION['users_name'])){
        $users_name = $_SESSION['users_name'];
        $query = "SELECT * FROM users WHERE users_name = '{$users_name}'";
        $select_users_profile_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_users_profile_query)){
            $user_id = $row['user_id'];
            $user_name = $row['users_name'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
     }

     if(isset($_POST['edit_profile']))
    {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $users_name = $_POST['users_name'];
        $user_email = $_POST['user_email'];

        $query = "UPDATE users SET user_firstname='{$user_firstname}',user_lastname ='{$user_lastname}',user_role ='{$user_role}',users_name = '{$users_name}',user_email='{$user_email}' WHERE users_name = '{$users_name}'";
        $update_users_profile = mysqli_query($connection,$query);
        ConfirmQuery($update_users_profile);

    }
?>
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
                        


                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="user_firstname">First name</label>
                                <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" id="user_firstname">
                            </div>

                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" id="user_lastname">
                            </div>

                            <div class="form-group">
                                <label for="user_role">user Role</label>
                                <select class="form-control" name="user_role" id="user_role">
                                    <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php
                                    if($user_role == 'admin'){
                                        echo "<option value='subscriber'>Subscriber</option>";
                                    }
                                    else{
                                        echo "<option value='admin'>Admin</option>";
                                    }
                                ?>
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="users_name">User Name</label>
                                <input type="text" value="<?php echo $users_name; ?>" class="form-control" name="users_name" id="users_name">
                            </div>

                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" id="user_email">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_profile" VALUE="Update Profile">
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php"?>
    