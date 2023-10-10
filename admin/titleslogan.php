<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<style>
    .config{
        display: flex;
    }
    .leftside{
        width: 80%;
    }
    .rightside{
        width: 20%;
    }
</style>
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php 
            /**
             * set category data to database 
             * 
            */
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $title = mysqli_real_escape_string($DB -> link, $_POST['title']);
                $sloge = mysqli_real_escape_string($DB -> link, $_POST['sloge']);

                // image validation
                $permited  = array('png');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $sameName = "logo".'.'.$file_ext;
                $uploaded_image = "uploads/".$sameName;

                if($title == "" || $sloge == ""){
                        echo "<p class='error'>Field Mush Not be Empty !!</p>";
                }else{
                    if(!empty($file_name)){
                        if ($file_size >1048567) {
                            echo "<span class='error'>Image Size should be less then 1MB! </span>";
                        } else if (in_array($file_ext, $permited) === false) {
                                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        } else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = "UPDATE title_sloge  SET title= '$title', sloge = '$sloge', image = '$sameName' WHERE id = '1'";
                            $inserted_rows = $DB->update($query);
                            if ($inserted_rows) {
                                    echo "<span class='success'>Post Update Successfully.</span>";
                            }else {
                                    echo "<span class='error'>Update Not Inserted !</span>";
                            }
                        }
                    }else{
                        $query = "UPDATE title_sloge  SET title= '$title', sloge = '$sloge' WHERE id = '1'";
                        $inserted_rows = $DB->update($query);
                        if ($inserted_rows) {
                                echo "<span class='success'>Post Update Successfully.</span>";
                        }else {
                                echo "<span class='error'>Update Not Inserted !</span>";
                        }
                    }
                }
            }

        $query = "SELECT * FROM  title_sloge WHERE id = '1'";
        $titleSloge = $DB -> select($query);

        if($titleSloge){
            while($result = $titleSloge -> fetch_assoc()){
        ?>
        <div class="config">
            <div class="leftside">
                <div class="block sloginblock">               
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['sloge']; ?>" name="sloge" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Website Logo</label>
                                </td>
                                <td>
                                    <input type="file" name="image" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="right_side">
                <img src="uploads/<?php echo $result['image']; ?>" alt="">
            </div>
        </div>
        <?php     } }  ?>
    </div>
</div>
<?php include "inc/footer.php";