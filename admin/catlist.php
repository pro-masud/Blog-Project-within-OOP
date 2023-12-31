﻿<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<?php 

			if(isset($_GET['catid'])){
				$id = $_GET['catid'];

				$query = "DELETE FROM blog_category WHERE id = '$id'";

				$catDel = $DB -> delete($query);
				if($catDel){
					echo "<p class='success'>Category Delete Successfuly";
				}else{
					echo "<p class='error'>Category Not Delete !!!";
				}
			}
		
		?>
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
					$query = "SELECT * FROM blog_category ORDER BY id DESC";
					/**
					 * all categorys get to database 
					 * */ 
					$categorys = $DB -> select($query);
					if($categorys){
						$i = 1;
						while($result = $categorys -> fetch_assoc()){
				?>
					<tr class="odd gradeX">
						<td><?php echo $i++; ?></td>
						<td><?php echo $result['name']; ?></td>
						<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete')" href="?catid=<?php echo $result['id']; ?>">Delete</a></td>
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


