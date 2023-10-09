<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">  
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Post Title</th>
						<th>Description</th>
						<th>Category</th>
						<th>Tags</th>
						<th>Image</th>
						<th>Author</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
					$query = "SELECT  blog_post.*, blog_category.name FROM blog_post INNER JOIN blog_category ON blog_post.cat = blog_category.id ORDER BY blog_post.title DESC";
					
					$posts = $DB -> select($query);
					if($posts){
						$i= 1;
						while($resultPost = $posts -> fetch_assoc()){
					?>
					<tr class="odd gradeX">
						<td><?php echo $i++; ?></td>
						<td><?php echo$format -> textCount($resultPost['title'], 20); ?></td>
						<td><?php echo $format -> textCount($resultPost['body'], 50); ?></td>
						<td class="center"><?php echo $resultPost['name']; ?></td>
						<td><?php echo $resultPost['tags']; ?></td>
						<td><img style="width:35px; height:35px; border-radius:5px; margin-top:7px; display:block;" src="./uploads/<?php echo $resultPost['image']; ?>" alt=""></td>
						<td><?php echo $resultPost['author']; ?></td>
						<td><a href="postedit.php?postid=<?php echo $resultPost['id']; ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete')" href="deletepost.php?postid=<?php echo $resultPost['id']; ?>"">Delete</a></td>
					</tr>
					<?php 	} } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
        
<script type="text/javascript">
	$(document).ready(function () {
		setupLeftMenu();
		// $('.datatable').dataTable('#example');
		setSidebarHeight();
	});
</script>
<?php include"inc/footer.php"; ?>