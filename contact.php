<?php 
// header php include here
include"./inc/header.php";
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			<?php 
            /**
             * data send to database 
             * 
            */
				if($_SERVER['REQUEST_METHOD'] == "POST"){
					$firstname = mysqli_real_escape_string($DB -> link, $_POST['firstname']);
					$lastname = mysqli_real_escape_string($DB -> link, $_POST['lastname']);
					$email = mysqli_real_escape_string($DB -> link, $_POST['email']);
					$body = mysqli_real_escape_string($DB -> link, $_POST['body']);

					$error = "";
					if(empty($firstname)){
						$error = "First Name Must Not be Empty !";
					}else if(empty($lastname)){
						$error = "Last Must Name Not be Empty !";
					}else if(empty($email)){
						$error = "Email Must Not be Empty !";
					}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
						$error = "Email Is Invalied !";
					}else if(empty($body)){
						$error = "Body Must Not be Empty !";
					}else{
						$query = "INSERT INTO blog_contact (firstname, lastname, email, body) VALUES ('$firstname', '$lastname', '$email', '$body')";
                        $inserted_rows = $DB->update($query);
                        if ($inserted_rows) {
                            echo "<span style='font-size:30px;' class='success'>Message Send Successfully.</span>";
                        }else {
                            echo "<span class='error'>Message Not Send !</span>";
                        }
					}
				}
			?>
			<form action="" method="POST">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name" required="1"/>
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name" required="1"/>
						</td>
					</tr>
					
					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address" required="1"/>
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="submit" value="Submit"/>
						</td>
					</tr>
				</table>
			<form>				
		</div>
	</div>
	<?php include"./inc/sidebar.php"; ?>
</div>

<?php include"./inc/footer.php"; ?>