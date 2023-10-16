<?php 
include"inc/header.php";
include"inc/sidebar.php"; 
$role = Sesstion::get('userRole');
if(!$role == 1){
   header("location: index.php");
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 
            <form action="" method="POST">
            <?php 
                    /**
                     * set category data to database 
                     * 
                    */
                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $username = $format -> validation($_POST['username']);
                        $password = $format -> validation(md5($_POST['password']));
                        $email = $format -> validation($_POST['email']);
                        $role = $format -> validation($_POST['role']);

                        $username = mysqli_real_escape_string($DB -> link, $username);
                        $password = mysqli_real_escape_string($DB -> link, $password);
                        $email = mysqli_real_escape_string($DB -> link, $email);
                        $role = mysqli_real_escape_string($DB -> link, $role);
    
                        if(empty($username) || empty($password) || empty($email) || empty($role)){
                            echo "<p class='error'>Field Not Must be Empty !!";
                        }else{
                            $mailQuery = "SELECT * FROM users WHERE email = '$email'";
                            $mailUser = $DB -> select($mailQuery);

                            if($mailUser != false){
                                echo "<p class='error'>Email Alreay Exist !!!";
                            }else{
                                // echo "<p class='success'>Category Add Successfuly";
                                $query = "INSERT INTO users (user_name, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
                                $addNewCat = $DB -> insert($query);
                                if($addNewCat){
                                    echo "<p class='success'>User Create Successfuly";
                                }else{
                                    echo "<p class='error'>User Not Create !!!";
                                }
                            }
                        }
                    }
            ?>
                <table class="form">					
                    <tr>
                        <td>
                            User Name
                        </td>
                        <td>
                            <input name="username" type="text" placeholder="Enter Your User Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password
                        </td>
                        <td>
                            <input name="password" type="text" placeholder="Enter Your Password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <input name="email" type="text" placeholder="Enter Your Email" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Role
                        </td>
                        <td>
                            <select name="role" id="select">
                                <option value="">-- Select --</option>
                                <option value="1">Admin</option>
                                <option value="2">Author</option>
                                <option value="3">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Create User" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php 
include"inc/footer.php";
?>