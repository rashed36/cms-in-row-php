<?php

    if(isset($_GET['edit_user']))
    {
      $the_user_id = $_GET['edit_user'];

      $query = "SELECT * FROM users WHERE user_id = $the_user_id";
      $select_users_query = mysqli_query($connection,$query);
      while($row = mysqli_fetch_assoc($select_users_query))
        {
            $user_id = $row['user_id'];
            $users_name = $row['users_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
    

        if(isset($_POST['edit_user']))
        {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $users_name = $_POST['users_name'];
            $user_email = $_POST['user_email'];
            //$post_date = date('d-m-y');
        
    
            $query = "UPDATE users SET user_firstname='{$user_firstname}',user_lastname ='{$user_lastname}',user_role ='{$user_role}',users_name = '{$users_name}',user_email='{$user_email}' WHERE user_id = {$the_user_id}";

            $update_users = mysqli_query($connection,$query);

            ConfirmQuery($update_users);

            echo "<p class='bg-success'>User Updated. <a href='users.php'>View Users?</a></p>";
        }          
    }
    
?>

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
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
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
        <input class="btn btn-primary" type="submit" name="edit_user" VALUE="Update user">
    </div>
    
</form>