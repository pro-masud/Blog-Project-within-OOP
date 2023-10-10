<?php 
/**
 * sesstion file include 
 * */ 
include"../lib/Sesstion.php";
 
// sesstion start
Sesstion::checkLogin();
?>
<?php 
/** 
 * Database connection here
 * */ 
include"../config/config.php";

/**
 * Database connection here
 * */ 
include"../lib/Database.php";
include"../helpers/formats.php";

/**
 * Database connection and helper Objects and functions
 * */ 
$DB = new Database();
$format = new Format();

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php 
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$userName = $format -> validation($_POST['user_name']);
				$password =  $format -> validation(md5($_POST['password']));

				// MySQLi validation
				$userName = mysqli_real_escape_string($DB -> link, $userName);
				$password = mysqli_real_escape_string($DB -> link, $password);

				$query = "SELECT * FROM users WHERE user_name = '$userName' AND password = '$password'";

				$userResult = $DB -> select($query);

				if($userResult != false){
					$value = mysqli_fetch_array($userResult);
					$rows = mysqli_num_rows($userResult);
					echo $rows;
					print_r($value);
					if($rows > 0){
						Sesstion::set("login", true);
						Sesstion::set("user_name", $value['user_name']);
						Sesstion::set("id", $value['id']);
						header("location:index.php");
					}else{
						echo "<p style='color:red; font-size: 20px; text-align:center;'>No Result Fount !!!</p>";
					}
				}else{
					echo "<p style='color:red; font-size: 20px; text-align:center;'>Username and Password Invalide !!!</p>";
				}
			}
		?>
		<form method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="user_name"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>