<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>User Lists</h2>
		<?php 
			if(isset($_GET['userid'])){
				$userid = $_GET['userid'];
				$query = "DELETE FROM users WHERE id ='$userid'";
				$deleteUser = $DB -> delete($query);
				if ($deleteUser) {
					echo "<span class='success'>User Delete Successfully.</span>";
				}else {
						echo "<span class='error'>User Not Delete !</span>";
				}
			}
		?>
		<div class="block">  
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Details</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
					 /**
                     * get all user to database
                     * 
                     * */
                    $query = "SELECT * FROM users";
                    
                    $userProfile = $DB -> select($query);

                    if($userProfile){
                        $i = 0;
                        while($user = $userProfile -> fetch_assoc()){ 
					?>
					<tr class="odd gradeX gradeC">
						<td ><?php echo $i++; ?></td>
						<td ><?php echo $user['name']; ?></td>
						<td ><?php echo $user['user_name']; ?></td>
						<td ><?php echo $user['email']; ?></td>
						<td ><?php echo $format -> textCount($user['details'], 20); ?></td>
                        <td><?php 
                            if($user['role'] == 1){
                                echo "Admin";
                            }else if( $user['role'] == 2){
                                echo "Author";
                            }else if($user['role'] == 3){
                                echo "Editor";
                            }
                        ?></td>
						<td ><a href="usersingleview.php?userid=<?php echo $user['id']; ?>">View</a> || <a onclick="return confirm('Are You Sure To Delete')" href="?userid=<?php echo $user['id']; ?>">Delete</a></td>
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