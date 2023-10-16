<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <?php 
            /**
             * set category data to database 
             * 
            */
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $cat = mysqli_real_escape_string($DB -> link, $_POST['cat']);
                $title = mysqli_real_escape_string($DB -> link, $_POST['title']);
                $body = mysqli_real_escape_string($DB -> link, $_POST['body']);
                $tags = mysqli_real_escape_string($DB -> link, $_POST['tags']);
                $author = mysqli_real_escape_string($DB -> link, $_POST['author']);
                $userId = mysqli_real_escape_string($DB -> link, $_POST['userId']);

                // image validation
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "uploads/".$unique_image;

                if($title == "" || $cat == "" || $uploaded_image == "" || $body == "" || $tags == "" || $author == "" || $userId == ""){
                        echo "<p class='error'>Field Mush Not be Empty !!</p>";
                }else if ($file_size >1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB! </span>";
                } else if (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO blog_post (cat, title, body, image, tags, author, userid) VALUES ('$cat','$title', '$body', '$unique_image', '$tags', '$author', '$userId')";
                    $inserted_rows = $DB->insert($query);
                    if ($inserted_rows) {
                            echo "<span class='success'>Post Inserted Successfully.</span>";
                    }else {
                            echo "<span class='error'>Image Not Inserted !</span>";
                    }
                }
            }
        ?>
        <div class="block">               
            <form action="addpost.php" method="POST" enctype="multipart/form-data">
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
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="cat">
                            <option>--Select Category--</option>
                            <?php 
                                $query = "SELECT * FROM blog_category";

                                $allCat = $DB -> select($query);
                                if($allCat){
                                    while($category = $allCat -> fetch_assoc()){                            
                            ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                            <?php } }?>
                        </select>
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
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" name="tags" class="medium">
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" name="author" value="<?php echo Sesstion::get('user_name'); ?>" class="medium">
                        <input type="hidden" name="userId" value="<?php echo Sesstion::get('userId'); ?>" class="medium">
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


  