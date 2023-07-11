<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>userName</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Change Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            
                            $query = "SELECT * FROM users";
                            $select_users = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_users))
                            {
                                $user_id = $row['user_id'];
                                $user_name = $row['users_name'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_role = $row['user_role'];

                                echo "<tr>";
                                echo "<td>{$user_id}</td>";
                                echo "<td>{$user_name}</td>";
                                echo "<td>{$user_firstname}</td>";
                                echo "<td>{$user_lastname}</td>";
                                echo "<td>{$user_email}</td>";
                                echo "<td>{$user_role}</td>";
                                echo "<td>
                                        <a href='users.php?change_to_admin={$user_id}'>Admin</a> /
                                        <a href='users.php?change_to_sub={$user_id}'>Subscriber</a>
                                    </td>";
                                echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>EDIT</a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you went to delete');\" href='users.php?delete={$user_id}'>DELETE</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            
                            </tbody>
                        </table>
                        <?php
                            if(isset($_GET['change_to_admin'])){

                                $the_user_id = $_GET['change_to_admin'];
    
                                $query = "UPDATE  users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    
                                $change_user_admin_query = mysqli_query($connection, $query);
    
                                header("Location: users.php");
                            }
    
                            if(isset($_GET['change_to_sub'])){
    
                                $the_user_id = $_GET['change_to_sub'];
    
                                $query = "UPDATE  users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    
                                $change_user_sub_query = mysqli_query($connection, $query);
    
                                header("Location: users.php");
                            }

                            if(isset($_GET['delete'])){

                                if(isset($_SESSION['user_role'])){
                                
                                    if($_SESSION['user_role'] == 'admin'){                               
                                
                                    $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
                                
                                    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                                
                                    $delete_query = mysqli_query($connection, $query);
                                
                                    header("Location: users.php");
                                
                                    }
                                }
                            }
                        
                        ?>
                       