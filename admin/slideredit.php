<?php 
include"inc/header.php";
include"inc/sidebar.php";

// get data url
if(!isset($_GET['sliderid']) || $_GET['sliderid'] == null){
    header("location: sliderlist.php");
}else{
    $sliderid = $_GET['sliderid'];
}
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
                }else{
                    if(!empty($file_name)){
                        if ($file_size >1048567) {
                            echo "<span class='error'>Image Size should be less then 1MB! </span>";
                        } else if (in_array($file_ext, $permited) === false) {
                                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        } else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = "UPDATE blog_slider SET title = '$title', image = '$unique_image' WHERE id = '$sliderid' ";
                            $Siders = $DB->insert($query);
                            if ($Siders) {
                                    echo "<span class='success'>Slider Inserted Successfully.</span>";
                            }else {
                                    echo "<span class='error'>Slider Not Inserted !</span>";
                            }
                        }
                    }else{
                        $query = "UPDATE blog_slider SET title = '$title' WHERE id = '$sliderid'";
                            $Siders = $DB->insert($query);
                            if ($Siders) {
                                    echo "<span class='success'>Slider Update Successfully.</span>";
                            }else {
                                    echo "<span class='error'>Slider Not Update !</span>";
                            }
                    }
                }
            }
        ?>
        <div class="block">    
        <?php 
                /**
                 * get all post to database
                 * 
                 * */
                $query = "SELECT * FROM blog_slider WHERE id = '$sliderid' ORDER BY id DESC";
                
                $slider = $DB -> select($query);

                if($slider){
                    while($singleSlider = $slider -> fetch_assoc()){            
            ?>            
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input name="title" type="text" value="<?php echo $singleSlider['title']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img style="width:200px; height:120px; display:block; margin-bottom:10px;" src="./uploads/slider/<?php echo $singleSlider['image']; ?>" alt="">
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


  