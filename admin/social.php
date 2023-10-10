<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">  
            <?php 
                /**form validation */
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $fb = mysqli_real_escape_string($DB -> link, $_POST['fb']);
                    $tw = mysqli_real_escape_string($DB -> link, $_POST['tw']);
                    $lin = mysqli_real_escape_string($DB -> link, $_POST['lin']);
                    $gg = mysqli_real_escape_string($DB -> link, $_POST['gg']);
                    
                    if($fb == "" || $tw == "" || $lin == "" || $gg == ""){
                        echo "<p class='error'>Field Mush Not be Empty !!</p>";
                    }else{
                        $query = "UPDATE blog_social  SET fb = '$fb', tw = '$tw', lin = '$lin', gg = '$gg' WHERE id = '1'";
                        $inserted_rows = $DB->update($query);
                        if ($inserted_rows) {
                            echo "<span class='success'>Social Media Update Successfully.</span>";
                        }else {
                            echo "<span class='error'>Social Media Not Update !</span>";
                        }
                    }
                }

                $query = "SELECT * FROM  blog_social WHERE id = '1'";
                $social = $DB -> select($query);
        
                if($social){
                    while($singleSocial = $social -> fetch_assoc()){
            ?>             
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Facebook</label>
                        </td>
                        <td>
                            <input type="text" name="fb" value="<?php echo $singleSocial['fb']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Twitter</label>
                        </td>
                        <td>
                            <input type="text" name="tw" value="<?php echo $singleSocial['tw']; ?>" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>LinkedIn</label>
                        </td>
                        <td>
                            <input type="text" name="lin" value="<?php echo $singleSocial['lin']; ?>" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Google Plus</label>
                        </td>
                        <td>
                            <input type="text" name="gg" value="<?php echo $singleSocial['gg']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } } ?>
        </div>
    </div>
</div>
<?php include"inc/footer.php"; ?>