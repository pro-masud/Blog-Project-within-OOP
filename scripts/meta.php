<meta name="language" content="English">
<meta name="description" content="It is a website about education">
<?php
if(isset($_GET['id'])){
        $keyid = $_GET['id'];
        /**
         * get all pages to database
         * */ 
        $query = "SELECT * FROM blog_post WHERE id = '$keyid '";
        $keywords = $DB -> select($query);

        if($keywords){
            while($singlepost = $keywords -> fetch_assoc()){
?>
<meta name="keywords" content="<?php echo $singlepost['tags']; ?>">
<?php } } } else { ?>
<meta name="keywords" content="php, leravel, wordpress, c, c++, C# programming">
<?php } ?>
<meta name="author" content="Delowar">