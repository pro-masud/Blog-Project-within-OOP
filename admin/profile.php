<?php 
include"inc/header.php";
include"inc/sidebar.php";

// get data sesstion
echo $userId = Sesstion::get('userId');
echo $userRole = Sesstion::get('userRole');
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edite Post</h2>
        <?php 
            /**
             * set category data to database 
             * 
            */
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $name = mysqli_real_escape_string($DB -> link, $_POST['name']);
                $user_name = mysqli_real_escape_string($DB -> link, $_POST['user_name']);
                $email = mysqli_real_escape_string($DB -> link, $_POST['email']);
                $details = mysqli_real_escape_string($DB -> link, $_POST['details']);

                $query = "UPDATE users SET name= '$name', user_name = '$user_name', email = '$email', details = '$details' WHERE id = '$userId'";
                $inserted_rows = $DB->update($query);
                if ($inserted_rows) {
                        echo "<span class='success'>User Profile Update Successfully.</span>";
                }else {
                        echo "<span class='error'>User Profile Not Update !</span>";
                }
            }
        ?>
        <div class="block">
            <?php 
                /**
                 * get all user to database
                 * 
                 * */
                $query = "SELECT * FROM users WHERE id = '$userId' AND role ='$userRole'";
                
                $userProfile = $DB -> select($query);

                if($userProfile){
                    while($user = $userProfile -> fetch_assoc()){            
            ?>      
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input name="name" type="text" value="<?php echo $user['name']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>User Name</label>
                    </td>
                    <td>
                        <input name="user_name" type="text" value="<?php echo $user['user_name']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input name="email" type="text" value="<?php echo $user['email']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="details" class="tinymce">
                            <?php echo $user['details']?>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>

            <?php   } } ?>
        </div>
    </div>
</div>
    <!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include"inc/footer.php";?>


  