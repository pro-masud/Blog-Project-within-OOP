<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<?php 
// get data url
if(!isset($_GET['postid']) || $_GET['postid'] == null){
    header("location: addpost.php");
}else{
    $editPost = $_GET['postid'];
}
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
                $cat = mysqli_real_escape_string($DB -> link, $_POST['cat']);
                $title = mysqli_real_escape_string($DB -> link, $_POST['title']);
                $body = mysqli_real_escape_string($DB -> link, $_POST['body']);
                $tags = mysqli_real_escape_string($DB -> link, $_POST['tags']);
                $author = mysqli_real_escape_string($DB -> link, $_POST['author']);

                // image validation
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "uploads/".$unique_image;

                if($title == "" || $cat == "" || $uploaded_image == "" || $body == "" || $tags == "" || $author == ""){
                        echo "<p class='error'>Field Mush Not be Empty !!</p>";
                }else{
                    if(!empty($file_name)){
                        if ($file_size >1048567) {
                            echo "<span class='error'>Image Size should be less then 1MB! </span>";
                        } else if (in_array($file_ext, $permited) === false) {
                                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        } else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = "UPDATE blog_post SET cat= '$cat', title = '$title', body = '$body', image = '$unique_image', tags = '$tags', author  = '$author' WHERE id = '$editPost'";
                            $inserted_rows = $DB->update($query);
                            if ($inserted_rows) {
                                    echo "<span class='success'>Post Update Successfully.</span>";
                            }else {
                                    echo "<span class='error'>Update Not Inserted !</span>";
                            }
                        }
                    }else{
                        $query = "UPDATE blog_post SET cat= '$cat', title = '$title', body = '$body', tags = '$tags', author  = '$author' WHERE id = '$editPost' ";
                        $inserted_rows = $DB->update($query);
                        if ($inserted_rows) {
                                echo "<span class='success'>Post Update Successfully.</span>";
                        }else {
                                echo "<span class='error'>Update Not Inserted !</span>";
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
                $query = "SELECT * FROM blog_post WHERE id = '$editPost' ORDER BY id DESC";
                
                $posts = $DB -> select($query);

                if($posts){
                    while($singlePost = $posts -> fetch_assoc()){

                  
            
            ?>      
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input name="title" type="text" value="<?php echo $singlePost['title']; ?>" class="medium" />
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
                            <option
                                <?php if($category['id'] == $singlePost['cat']){
                                   echo "selected"; 
                                } ?>
                            value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                            <?php } }?>
                        </select>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img style="width=150px; height: 100px; display:block;" src="./uploads/<?php echo $singlePost['image']?>" alt="">
                        <input name="image" type="file" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce">
                            <?php echo $singlePost['body']?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Tags</label>
                    </td>
                    <td>
                        <input value="<?php echo $singlePost['tags']?>" type="text" name="tags" class="medium">
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Author</label>
                    </td>
                    <td>
                        <input value="<?php echo $singlePost['author']?>" type="text" name="author" class="medium">
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


  