<?php
    if(isset($_POST['submit'])){

       $search = $_POST['search']; 

       $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

       $search_query = mysqli_query($connection, $query);

       if(!$search_query){
           die("QUERY FAILED". mysqli_error($connection));
       }

       $count = mysqli_num_rows($search_query);

       if($count == 0){
           echo "<h2>NO RESULT FOUND ?</h2>";
       }
       else{
           echo "<h2>SOME RESULT FOUND</h2>";
       }
    }

    ?>