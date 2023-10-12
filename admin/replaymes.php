<?php 
include"inc/header.php";
include"inc/sidebar.php";


// get data url
if(!isset($_GET['mesid']) || $_GET['mesid'] == null){
    header("location: inbox.php");
}else{
    $id = $_GET['mesid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Message Single Page View</h2>
        <?php 
            if($_SERVER['REQUEST_METHOD']){
                $toMail = mysqli_real_escape_string($DB -> link, $_POST['toMail']);
                $fromEmail = mysqli_real_escape_string($DB -> link, $_POST['fromEmail']);
                $subject = mysqli_real_escape_string($DB -> link, $_POST['subject']);
                $message = mysqli_real_escape_string($DB -> link, $_POST['message']);

                $sentMess = mail($toMail, $subject, $message, $fromEmail);
                if($sentMess){
                    echo "<span style='font-size:30px;' class='success'>Message Send Successfully.</span>";
                }else{
                    echo "<span class='error'>Message Not Send !</span>";
                }
            }
        ?>
        <div class="block">    
            <?php 
                $query = "SELECT * FROM blog_contact WHERE id = '$id'";
                $viewMes = $DB -> select($query);
                if($viewMes){
                    while($singleView = $viewMes -> fetch_assoc()){
            ?>           
            <form action="" method="POST">
                <table class="form"> 
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input name="toMail" value="<?php echo $singleView['email']; ?>" type="text" readonly class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input name="fromEmail" type="text" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input name="subject" type="text" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea name="message" readonly class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a style="background-color: #333; color:#fff; padding: 8px; margin-top: 10px;" href="inbox.php">Back</a>
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


  