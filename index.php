<?php 
/**
 * Database connection here
 * */ 
include"./config/config.php";

/**
 * Database connection here
 * */ 
include"./lib/Database.php";
include"./helpers/formats.php";

// header php include here
include"./inc/header.php";
// silider include 
include"./inc/slider.php";



/**
 * object declaration here
*/

$DB = new Database();
$format = new Format();

	

	
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php 
				$query = "SELECT * FROM blog_post";
				$results = $DB -> select($query);

				if($results){
					while($posts = $results -> fetch_assoc()){
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $posts['id']; ?>"><?php echo $posts['title']; ?></a></h2>
				<h4><?php echo $format -> getDate($posts['date']); ?> By <a href="#"><?php echo $posts['author']; ?></a></h4>
				 <a href="#"><img src="images/<?php echo $posts['image']; ?>" alt="post image"/></a>
				 <?php echo $format -> textCount($posts['body']); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $posts['id']; ?>">Read More</a>
				</div>
			</div>
			<?php } ?> <!-- while loop ending here now-->
			<?php  }
				else{
					header("location:404.php");
				} 
			?>
		</div>
		<?php include"./inc/sidebar.php"; ?>
	</div>

	<?php include"./inc/footer.php"; ?>