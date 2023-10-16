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

/**
 * Database connection and helper Objects and functions
 * */ 
$DB = new Database();
$format = new Format();
?>
<!DOCTYPE html>
<html>
<head>
<?php
	if(isset($_GET['pageid'])){
		$pageid = $_GET['pageid'];
		/**
		 * get all pages to database
		 * */ 
		$query = "SELECT * FROM blog_page WHERE id = '$pageid'";
		$pages = $DB -> select($query);

		if($pages){
			while($singlePage = $pages -> fetch_assoc()){
			?>
			<title><?php echo $singlePage['name'] ." - ". TITLE; ?></title>
		<?php } } }elseif(isset($_GET['id'])){
			$postid = $_GET['id'];
			/**
			 * get all pages to database
			 * */ 
			$query = "SELECT * FROM blog_post WHERE id = '$postid'";
			$posts = $DB -> select($query);
	
			if($posts){
				while($singlepost = $posts -> fetch_assoc()){
				?>
				<title><?php echo $singlepost['title'] ." - ". TITLE; ?></title>
			<?php } }
		}else{ ?>
			<title><?php echo $format -> title()."-". TITLE; ?></title>
		<?php 
		}
?>

	<title><?php echo TITLE; ?></title>
	<!-- include all meta tags links -->
	<?php include"./scripts/meta.php"; ?>

	<!-- include css files -->
	<?php include"./scripts/css.php"; ?>
	
	<!-- include js files  -->
	<?php include"./scripts/js.php"; ?>

</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
				<?php 
				$query = "SELECT * FROM  title_sloge WHERE id = '1'";
				$titleSloge = $DB -> select($query);
		
				if($titleSloge){
					while($result = $titleSloge -> fetch_assoc()){
				?>
				<img src="admin/uploads/<?php echo $result['image']; ?>" alt="Logo"/>
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['sloge']; ?></p>
				<?php } } ?>
			</div>
		</a>
		<div class="social clear">
			<?php 
				/**
				 * get all social data to database
				 * */ 
				$query = "SELECT * FROM  blog_social WHERE id = '1'";
				$social = $DB -> select($query);
		
				if($social){
					while($singleSocial = $social -> fetch_assoc()){
			?> 
			<div class="icon clear">
				<a href="<?php echo $singleSocial['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $singleSocial['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $singleSocial['lin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $singleSocial['gg']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<?php } } ?>
			<div class="searchbtn clear">
			<form action="search.php" method="GET">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php 
		/**
		 * cureent page location
		*/
		$path = $_SERVER['SCRIPT_FILENAME'];
		$cureentPage = basename($path, ".php");
	?>
	<ul>
		<li><a <?php if($cureentPage == 'index'){ echo "id='active'"; }?> href="index.php">Home</a></li>
		<?php 
			/**
			 * get all pages to database
			 * */ 
			$query = "SELECT * FROM blog_page";
			$result = $DB -> select($query);

			if($result){
				while($pageResult = $result -> fetch_assoc()){
		?>
			<li><a
			<?php 
			if(isset($_GET['pageid'])){
				$pageid = $_GET['pageid'];
				if($pageid == $pageResult['id']){
					?>
					id="active"
					<?php 
				}
			}
			?>			
			href="page.php?pageid=<?php echo $pageResult['id']; ?>"><?php echo $pageResult['name']; ?></a></li>
		<?php } } ?>
		<li><a <?php if($cureentPage == 'contact'){ echo "id='active'"; }?>  href="contact.php">Contact</a></li>
	</ul>
</div>