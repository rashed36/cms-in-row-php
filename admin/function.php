<?php

function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}

function user_online(){

    if(isset($_GET['onlineuser'])){

    global $connection;

        if(!$connection){
        session_start();
        include ("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_secends = 05;
        $time_out = $time - $time_out_in_secends;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time)VALUES('$session','$time')");
        }
            else
            {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);
        }
    }
}
user_online();

function ConfirmQuery($result)
{
    global $connection;
    
    if(!$result){
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}



function insert_categories()
{
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This Field Should not be Empty";
        }
        else{
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function show_categories()
{
    global $connection;
    $query = "SELECT * FROM categories";
        $cat_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($cat_query))
        {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
            echo "</tr>";
        }
}

function delete_categories()
{
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}

function is_admin($users_name ='')
{
    global $connection;

    $query="SELECT user_role FROM users WHERE users_name ='$users_name'";

    $result=mysqli_query($connection, $query);

    ConfirmQuery($result);

    if($row['user_role']=='admin'){
        return true;
    }else {
        return false;
    }
}

function username_exists($users_name)
{
    global $connection;

    $query="SELECT users_name FROM users WHERE users_name ='$users_name'";

    $result=mysqli_query($connection, $query);

    ConfirmQuery($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

?>