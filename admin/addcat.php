<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
            <form action="" method="POST">
            <?php 

                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $name = $format -> validation($_POST['name']);
                        $name = mysqli_real_escape_string($DB -> link, $name);
    
                        if(empty($name)){
                            echo "<p class='error'>Field Not Must be Empty !!";
                        }else{
                            // echo "<p class='success'>Category Add Successfuly";
                            $query = "INSERT INTO blog_category (name) VALUES ('$name')";
                            $addNewCat = $DB -> insert($query);
                            if($addNewCat){
                                echo "<p class='success'>Category Insert Successfuly";
                            }else{
                                echo "<p class='error'>Category Not Insert !!!";
                            }
                        }
                    }
            
            ?>
                <table class="form">					
                    <tr>
                        <td>
                            <input name="name" type="text" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php 
include"inc/footer.php";
?>