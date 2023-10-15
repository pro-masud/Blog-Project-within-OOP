<?php 
include"inc/header.php";
include"inc/sidebar.php";


// get data url
if(!isset($_GET['userid']) || $_GET['userid'] == null){
    header("location: userlist.php");
}else{
    $userid = $_GET['userid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Message Single Page View</h2>
        <div class="block">    
            <?php 
                $query = "SELECT * FROM users WHERE id = '$userid'";
                $users = $DB -> select($query);
                if($users){
                    while($userSingleView = $users -> fetch_assoc()){
            ?>           
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input value="<?php echo $userSingleView['name'] ?>" type="text" readonly class="medium" />
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label>User Name</label>
                        </td>
                        <td>
                            <input value="<?php echo $userSingleView['user_name'] ?>" type="text" readonly class="medium" />
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input value="<?php echo $userSingleView['email']; ?>" type="text" readonly class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea readonly class="tinymce">
                                <?php echo $userSingleView['details']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a style="background-color: #333; color:#fff; padding: 8px; margin-top: 10px;" href="userlist.php">Back</a>
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


  