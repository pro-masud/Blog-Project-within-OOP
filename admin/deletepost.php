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
if(!isset($_GET['postid']) || $_GET['postid'] == null){
    header("location: postlist.php");
}else{
    $postid = $_GET['postid'];

    $query = "SELECT * FROM  blog_post WHERE id = '$postid'";
    
    $getData = $DB -> select($query);

    if($getData){
        while($deleteImage = $getData -> fetch_assoc()){
            echo $delImage = "./uploads/" . $deleteImage['image'];

            /* remove image for database */
            unlink($delImage);
        }
    }

    $deleteQuery = "DELETE FROM blog_post WHERE id = '$postid'";

    $delData = $DB -> delete($deleteQuery);
    if($delData){
        header("location:postlist.php");
    }else{
        header("location:postlist.php");
    }
}
?>