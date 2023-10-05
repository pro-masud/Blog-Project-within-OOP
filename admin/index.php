<?php 
/**
 * sesstion file include 
 * */ 
include"../lib/Sesstion.php";
 
// sesstion start
Sesstion::init();
?>
<?php 
include"inc/header.php";
include"inc/sidebar.php";

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2> Dashbord</h2>
        <?php echo Sesstion::get("user_name"); ?>
        <div class="block">               
            Welcome admin panel        
        </div>
    </div>
</div>
<?php include"inc/footer.php"; ?>