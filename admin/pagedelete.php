<?php 
include"inc/header.php";

// get data url
if(!isset($_GET['pageid']) || $_GET['pageid'] == null){
    header("location: addpost.php");
}else{
    $pageid = $_GET['pageid'];

    $query = "DELETE FROM blog_page WHERE id ='$pageid'";
    $addNewCat = $DB -> delete($query);

    if ($addNewCat) {
        header("location: index.php");
    }
}
?>