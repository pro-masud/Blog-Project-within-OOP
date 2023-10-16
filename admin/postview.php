<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<?php 
// get data url
if(!isset($_GET['postid']) || $_GET['postid'] == null){
    header("location: postlist.php");
}else{
    $postid = $_GET['postid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edite Post</h2>
        <div class="block">
            <?php 
                /**
                 * get all post to database
                 * 
                 * */
                $query = "SELECT * FROM blog_post WHERE id = '$postid'";
                
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
                        <label>Images</label>
                    </td>
                    <td>
                        <img style="width=150px; height: 100px; display:block;" src="./uploads/<?php echo $singlePost['image']?>" alt="">
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


  