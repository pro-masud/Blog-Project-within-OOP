<?php 
// header php include here
include"./inc/header.php";
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
				$query = "SELECT * FROM blog_post WHERE id = '$id'";	
				$posts = $DB -> select($query);
				if($posts){
				while($singlePost = $posts -> fetch_assoc()){
			?>
			<div class="about">
				<h2><?php echo $singlePost['title']; ?></h2>
				<h4><?php echo $format -> getDate($singlePost['date']); ?> By <a href="#"><?php echo $singlePost['author']; ?></a></h4>
				<img src="images/<?php echo $singlePost['image']; ?>" alt="MyImage"/>
				<?php echo $singlePost['body']; ?>
				<div class="relatedpost clear">

					<h2>Related articles</h2>
					<?php
					$catId = $singlePost['cat'];

					$queryCat = "SELECT * FROM blog_post WHERE cat = '$catId' order by rand() limit 6";	
					$relatedPost = $DB -> select($queryCat);
					if($relatedPost){
					while($singleRelatedPost = $relatedPost -> fetch_assoc()){
				
				?>
					<a href="post.php?id=<?php echo $singleRelatedPost['id']; ?>"><img src="images/<?php echo $singleRelatedPost['image']; ?>" alt="post image"/></a>
					<?php } }else{
						echo "<p style='color:red; font-size:24px;'>No Related Post!!</p>";
					} ?>
				</div>
			</div>
			<?php } }else{
				header('location: 404.php');
			} ?>
		</div>
	<?php include"./inc/sidebar.php"; ?>
	</div>

	<?php include"./inc/footer.php"; ?>