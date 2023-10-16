<?php 
include"inc/header.php";
include"inc/sidebar.php";
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
                   
                    $theme = mysqli_real_escape_string($DB -> link, $_POST['theme']);

                    $query = "UPDATE blog_theme SET theme_name  = '$theme' WHERE id = '1'";
                    $theme = $DB -> update($query);
                    if($theme){
                        echo "<p class='success'>Theme Update Successfuly</p>";
                    }else{
                        echo "<p class='error'>Theme Not Update !!!</p>";
                    }
                }
            ?>
            <?php 
                 $query = "SELECT * FROM blog_theme WHERE id = '1'";
                 $result = $DB -> select($query);

                 if($result){

                    while($checkResult = $result -> fetch_assoc()){
               
            ?>
            <form action="" method="POST">            
                <table class="form">					
                    <tr>
                        <td>
                            <input 
                            <?php if($checkResult['theme_name']== 'default'){
                                echo "checked";
                            } ?>
                            type="radio" name="theme" value="default">Default
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input
                            <?php if($checkResult['theme_name']== 'green'){
                                echo "checked";
                            } ?>
                             type="radio" name="theme" value="green">Green
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input
                            <?php if($checkResult['theme_name']== 'red'){
                                echo "checked";
                            } ?>
                            type="radio" name="theme" value="red">Red
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Change" />
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