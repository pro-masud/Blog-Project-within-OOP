<?php 
include"inc/header.php";
include"inc/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM  blog_contact ORDER BY id DESC";
                    /**
                     * all user data get to database 
                     * */ 
                    $users = $DB -> select($query);
                    if($users){
                        $i = 1;
                        while($singleUser = $users -> fetch_assoc()){
                ?>
                <tr class="odd gradeX gradeC">
                    <td><?php echo  $i++; ?></td>
                    <td><?php echo $singleUser['firstname'] . " " . $singleUser['lastname']; ?></td>
                    <td><?php echo $singleUser['email']; ?></td>
                    <td><?php echo $format -> textCount($singleUser['body'], 25); ?></td>
                    <td><?php echo  $format -> getDate($singleUser['date']); ?></td>
                    <td><a style="color:green;" href="editmes.php?mesid=<?php echo $singleUser['id']; ?>">Edit</a> || <a style="color:red;" href="delmes.php?mesid=<?php echo $singleUser['id']; ?>">Delete</a></td>
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
<?php include"inc/footer.php"; ?>
