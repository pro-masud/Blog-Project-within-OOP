<?php 
// header php include here
include"./inc/header.php";
// silider include 
include"./inc/slider.php";

/**
 * object declaration here
*/	
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
        <?php 
            $id; 
            if(!isset($_GET['id']) || $_GET['id'] == null){
                header("location: 404.php");
            }else{
                $id = $_GET['id'];
            }

            $query = "SELECT * FROM blog_post WHERE cat = '$id'";
				$results = $DB -> select($query);

				if($results){
					while($posts = $results -> fetch_assoc()){
        ?>        
            <div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $posts['id']; ?>"><?php echo $posts['title']; ?></a></h2>
				<h4><?php echo $format -> getDate($posts['date']); ?> By <a href="#"><?php echo $posts['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $posts['id']; ?>"><img src="admin/uploads/<?php echo $singlePost['image']; ?>" alt="MyImage"/></a>
				 <?php echo $format -> textCount($posts['body']); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $posts['id']; ?>">Read More</a>
				</div>
			</div>
            <?php } }else{
                ?>
                    <p>No Category Insert Your Post</p>
                <?php 
            } ?>
        </div>
		<?php include"./inc/sidebar.php"; ?>
	</div>
<?php include"./inc/footer.php"; ?>