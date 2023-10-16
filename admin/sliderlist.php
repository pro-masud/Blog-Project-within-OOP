<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">  
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Slider Title</th>
						<th>Slider Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
					$query = "SELECT  * FROM blog_slider";
					
					$sliders = $DB -> select($query);
					if($sliders){
						$i= 1;
						while($slider = $sliders -> fetch_assoc()){
					?>
					<tr class="odd gradeX gradeC">
						<td><?php echo $i++; ?></td>
						<td><?php echo$format -> textCount($slider['title'], 20); ?></td>
						<td><img style="width:35px; height:35px; border-radius:5px; margin-top:7px; display:block;" src="./uploads/slider/<?php echo $slider['image']; ?>" alt=""></td>
						<td>
							<?php if(Sesstion::get('userRole') == '1'){	 ?>
							<a href="slideredit.php?sliderid=<?php echo $slider['id']; ?>">Edit</a> || 
							<a onclick="return confirm('Are You Sure To Delete')" href="?sliderid=<?php echo $slider['id']; ?>"">Delete</a></td>
							<?php } ?>
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
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include"inc/footer.php"; ?>