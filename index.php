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
			<!-- pagination limit start -->
			<?php 
				$post_per_page = 2;
				if(isset($_GET['page'])){
					$page = $_GET['page'];
				}else{
					$page = 1;
				}

				$start_page = ($page -1) * $post_per_page;
			?>
			<!-- pagination limit end -->
			<?php 
				$query = "SELECT * FROM blog_post limit $start_page, $post_per_page";
				$results = $DB -> select($query);

				if($results){
					while($posts = $results -> fetch_assoc()){
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $posts['id']; ?>"><?php echo $posts['title']; ?></a></h2>
				<h4><?php echo $format -> getDate($posts['date']); ?> By <a href="#"><?php echo $posts['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $posts['id']; ?>"><img src="images/<?php echo $posts['image']; ?>" alt="post image"/></a>
				 <?php echo $format -> textCount($posts['body']); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $posts['id']; ?>">Read More</a>
				</div>
			</div>
			<?php } ?> <!-- while loop ending here now-->

			<!-- pagination start -->
			<?php 
			$query = "SELECT * FROM blog_post";
			$results = $DB -> select($query);
			$totalRows = mysqli_num_rows($results);
			$totalPage = ceil($totalRows/$post_per_page);
			?>
			<?php echo "<span class='pagination'> <a href='index.php?page=1'>" . 'Frist Page' . "</a>"; ?>
				<?php 
					for($i = 1; $i<=$totalPage; $i++ ){
						?>
							<a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php 
					}
				?>
			<?php echo "<a href='index.php?page=".$totalPage."'>" . 'Last Page' . "</a> </span>"; ?>
			<!-- pagination end -->

			<?php  }
				else{
					header("location:404.php");
				} 
			?>
		</div>
		<?php include"./inc/sidebar.php"; ?>
	</div>

	<?php include"./inc/footer.php"; ?>