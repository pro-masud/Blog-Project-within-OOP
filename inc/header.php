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
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
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
