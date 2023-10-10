<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
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
                    $query = "INSERT INTO blog_page (name, body) VALUES ('$name','$body')";
                    $inserted_rows = $DB->insert($query);
                    if ($inserted_rows) {
                            echo "<span class='success'>Page Create Successfully.</span>";
                    }else {
                            echo "<span class='error'>Page Not Create !</span>";
                    }
                }
            }
        ?>
        <div class="block">               
            <form action="addpage.php" method="POST" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Page Name</label>
                        </td>
                        <td>
                            <input name="name" type="text" placeholder="Create a Page..." class="medium" />
                        </td>
                    </tr>        
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Body</label>
                        </td>
                        <td>
                            <textarea name="body" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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


  