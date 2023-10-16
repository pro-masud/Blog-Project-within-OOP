<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
        <?php 
            /**
             * set category data to database 
             * 
            */
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $title = mysqli_real_escape_string($DB -> link, $_POST['title']);

                // image validation
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "uploads/slider/".$unique_image;

                if($title == "" || $uploaded_image == "" ){
                        echo "<p class='error'>Field Mush Not be Empty !!</p>";
                }else if ($file_size >1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB! </span>";
                } else if (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO blog_slider (title, image) VALUES ('$title', '$unique_image')";
                    $Siders = $DB->insert($query);
                    if ($Siders) {
                            echo "<span class='success'>Slider Inserted Successfully.</span>";
                    }else {
                            echo "<span class='error'>Slider Not Inserted !</span>";
                    }
                }
            }
        ?>
        <div class="block">               
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input name="title" type="text" placeholder="Enter Post Title..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input name="image" type="file" />
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


  