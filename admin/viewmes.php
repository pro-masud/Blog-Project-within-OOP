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
        <h2>Add New Page</h2>
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
                            <label>Name</label>
                        </td>
                        <td>
                            <input value="<?php echo $singleView['firstname'] . ' ' . $singleView['lastname']; ?>" type="text" readonly class="medium" />
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input value="<?php echo $singleView['email']; ?>" type="text" readonly class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input  value="<?php echo $singleView['date']; ?>" type="text" readonly class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Body</label>
                        </td>
                        <td>
                            <textarea readonly class="tinymce">
                                <?php echo $singleView['body']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
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


  