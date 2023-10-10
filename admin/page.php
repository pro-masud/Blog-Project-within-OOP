<?php 
include"inc/header.php";
include"inc/sidebar.php";
// get data url
if(!isset($_GET['pageid']) || $_GET['pageid'] == null){
    header("location: index.php");
}else{
    $id = $_GET['pageid'];
}
?>

<style>
    .deletebtn{
        background-color: #333;
        color:red;
        font-weight: normal;
        padding: 8px 15px;
        margin-left:10px;
    }
    .deletebtn:hover{
        background-color: #333;
        color:red;
        font-weight: normal;
        padding: 8px 15px;
        margin-left:10px;
    }
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Page</h2>
        <?php 
            /**
             * pages set to database 
             * 
            */
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $name = mysqli_real_escape_string($DB -> link, $_POST['name']);
                $body = mysqli_real_escape_string($DB -> link, $_POST['body']);

                if($name == "" || $body == "" ){
                        echo "<p class='error'>Field Mush Not be Empty !!</p>";
                }else{
                    $query = "UPDATE blog_page SET name = '$name', body = '$body' WHERE id = '$id'";
                    $addNewCat = $DB -> update($query);

                    if ($addNewCat) {
                            echo "<span class='success'>Page Update Successfully.</span>";
                    }else {
                            echo "<span class='error'>Page Not Update !</span>";
                    }
                }
            }
        ?>
        <div class="block">             
                <?php 
                /**
                 * get all pages to database
                 * */ 
                    $query = "SELECT * FROM blog_page WHERE id = '$id'";
                    $editPage = $DB -> select($query);

                    if($editPage){
                        while($pageResult = $editPage -> fetch_assoc()){
                ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Edit Page Name</label>
                        </td>
                        <td>
                            <input name="name" type="text" value="<?php echo $pageResult['name']; ?>" class="medium" />
                        </td>
                    </tr>        
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Edit Body</label>
                        </td>
                        <td>
                            <textarea name="body" class="tinymce">
                                <?php echo $pageResult['body']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                           <span> <a onclick="return confirm('Are You Sure To Delete')" class="deletebtn" href="pagedelete.php?pageid=<?php echo $pageResult['id']; ?>">Delete</a></span>
                        </td>
                    </tr>
                </table>
            </form>
            <?php } } ?>
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