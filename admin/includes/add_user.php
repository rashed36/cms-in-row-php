<?php

    if(isset($_POST['create_user'])){

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $users_name = $_POST['users_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10) );

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, users_name, user_email, user_password)";
        
        $query .="VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$user_firstname}','{$user_email}','{$user_password}')";

        $create_user_query = mysqli_query($connection, $query);

        ConfirmQuery($create_user_query);

        echo "User Created: " . "" . "<a href='users.php'>View Users</a>";
        
    
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">First name</label>
        <input type="text" class="form-control" name="user_firstname" id="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" id="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">user Role</label>
        <select class="form-control" name="user_role" id="user_role">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
            
        </select>
    </div>

    <div class="form-group">
        <label for="users_name">User Name</label>
        <input type="text" class="form-control" name="users_name" id="users_name">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" id="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" VALUE="Add user">
    </div>
    
</form>