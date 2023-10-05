<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">        
			<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "SELECT * FROM blog_category ORDER BY id desc";
				/**
				 * all categorys get to database 
				 * */ 
				$categorys = $DB -> select($query);
				if($categorys){
					while($result = $categorys -> fetch_assoc()){
			?>
				<tr class="odd gradeX">
					<td><?php echo $result['id']; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are Your Sure To Delete')" href="deletecat.php?catid=<?php echo $result['id']; ?>">Delete</a></td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include"inc/footer.php";?>


