<?php 
// header php include here
include"./inc/header.php";
?>
<?php 
// get data url
if(!isset($_GET['pageid']) || $_GET['pageid'] == null){
    header("location: index.php");
}else{
    $id = $_GET['pageid'];
}
?>
<?php 
/**
 * get all pages to database
 * */ 
	$query = "SELECT * FROM blog_page WHERE id = '$id'";
	$pages = $DB -> select($query);

	if($pages){
		while($singlePage = $pages -> fetch_assoc()){
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2><?php echo $singlePage['name']; ?></h2>
			<?php echo $singlePage['body']; ?>
		</div>
	</div>
	<?php include"./inc/sidebar.php"; ?>
</div>
<?php } }else{
	header("location: 404.php");
}

?>


<?php include"./inc/footer.php"; ?>