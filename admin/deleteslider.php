<?php 
/**
 * sesstion file include 
 * */ 
include"../lib/Sesstion.php";
 
// sesstion start
Sesstion::checkSesstion();
?>
<?php 
/**
 * Database connection here
 * */ 
include"../config/config.php";

/**
 * Database connection here
 * */ 
include"../lib/Database.php";
include"../helpers/formats.php";

/**
 * Database connection and helper Objects and functions
 * */ 
$DB = new Database();

// get data url
if(!isset($_GET['sliderid']) || $_GET['sliderid'] == null){
    header("location: sliderlist.php");
}else{
    $sliderid = $_GET['sliderid'];

    $query = "SELECT * FROM  blog_slider WHERE id = '$sliderid'";
    
    $getSlider = $DB -> select($query);

    if($getSlider){
        while($delSliderImage = $getSlider -> fetch_assoc()){
            echo $delImage = "./uploads/slider" . $delSliderImage['image'];

            /* remove image for database */
            unlink($delImage);
        }
    }

    $deleteQuery = "DELETE FROM blog_slider WHERE id = '$sliderid'";

    $delData = $DB -> delete($deleteQuery);
    if($delData){
        header("location:sliderlist.php");
    }else{
        header("location:sliderlist.php");
    }
}
?>