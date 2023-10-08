<?php 
include"inc/header.php";
include"inc/sidebar.php";

// get data url
if(!isset($_GET['catid']) || $_GET['catid'] == null){
    // echo "<script>window.location('addcat.php')</script>";
    header("location:addcat.php");
}else{
    $id = $_GET['catid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
            <?php 
                /**
                 * set category data to database 
                 * 
                */
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $name = $format -> validation($_POST['name']);
                    $name = mysqli_real_escape_string($DB -> link, $name);

                    if(empty($name)){
                        echo "<p class='error'>Field Not Must be Empty !!";
                    }else{
                        // echo "<p class='success'>Category Add Successfuly";
                        $query = "UPDATE blog_category SET name = '$name' WHERE id = '$id'";
                        $addNewCat = $DB -> update($query);
                        if($addNewCat){
                            echo "<p class='success'>Category Update Successfuly";
                        }else{
                            echo "<p class='error'>Category Not Update !!!";
                        }
                    }
                }
            ?>
            <?php 
                 $query = "SELECT * FROM blog_category WHERE id = '$id' ORDER BY id DESC";
                 $result = $DB -> select($query);

                 if($result){

                    while($catResult = $result -> fetch_assoc()){
               
            ?>
            <form action="" method="POST">            
                <table class="form">					
                    <tr>
                        <td>
                            <input name="name" type="text" value="<?php echo $catResult['name']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php  } } ?>
        </div>
    </div>
</div>
<?php 
include"inc/footer.php";
?>