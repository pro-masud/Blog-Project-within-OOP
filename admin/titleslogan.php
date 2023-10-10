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
        $query = "SELECT * FROM  title_sloge WHERE id = '1'";
        $titleSloge = $DB -> select($query);

        if($titleSloge){
            while($result = $titleSloge -> fetch_assoc()){
        ?>
        <div class="config">
            <div class="leftside">
                <div class="block sloginblock">               
                    <form>
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
                                    <input type="file" placeholder="Enter Website Slogan..." name="image" class="medium" />
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