 <?php  include "includes/header.php"; ?>
 <?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql_u = "SELECT * FROM users WHERE users_name='$username'";
    $sql_e = "SELECT * FROM users WHERE user_email='$email'";
    $res_u = mysqli_query($connection, $sql_u);
    $res_e = mysqli_query($connection, $sql_e);

    if (mysqli_num_rows($res_u) > 0) {
      $name_error = "Sorry... username already taken"; 	
    }else if(mysqli_num_rows($res_e) > 0){
      $email_error = "Sorry... email already taken"; 	
    }else{


         if(!empty($username) && !empty($email) && !empty($password)){

        $username = mysqli_real_escape_string($connection, $username);
        $email    = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12) );

        $query = "INSERT INTO users (users_name, user_email, user_password, user_role )";
        $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber')";
        $register_user_query = mysqli_query($connection, $query);
      
       
        }

    }
    

}

 ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group" <?php if (isset($name_error)): ?> class="form_error" <?php endif ?>>
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" value="<?php echo isset($username) ? $username : '' ?>">
                            <?php if (isset($name_error)): ?>
                                <span><?php echo $name_error; ?></span>
                            <?php endif ?>
                        </div>
                         <div class="form-group" <?php if (isset($email_error)): ?> class="form_error" <?php endif ?>>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" value="<?php echo isset($email) ? $email : '' ?>">
                            <?php if (isset($email_error)): ?>
                                <span><?php echo $email_error; ?></span>
                            <?php endif ?>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
