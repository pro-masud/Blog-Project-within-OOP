<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
        <?php 
            /**form validation */
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $nodetext = mysqli_real_escape_string($DB -> link, $_POST['nodetext']);
                
                if($nodetext == ""){
                    echo "<p class='error'>Field Mush Not be Empty !!</p>";
                }else{
                    $query = "UPDATE  blog_footer_text  SET nodetext = '$nodetext' WHERE id = '1'";
                    $inserted_rows = $DB->update($query);
                    if ($inserted_rows) {
                        echo "<span class='success'>Update Footer Text Successfully.</span>";
                    }else {
                        echo "<span class='error'>Footer Text Not Update !</span>";
                    }
                }
            }
        ?>
            <form action="copyright.php" method="POST">
                <table class="form">	
                    <?php 
                        $query = "SELECT * FROM  blog_footer_text WHERE id = '1'";
                        $footertext = $DB -> select($query);

                        if($footertext){
                            while($result = $footertext -> fetch_assoc()){
                    ?>				
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['nodetext']; ?>" name="nodetext" class="large" />
                        </td>
                    </tr>
                    <?php } } ?>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include"inc/footer.php"; ?>
