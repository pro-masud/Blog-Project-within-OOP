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
<title>Pasword Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$email = $format -> validation($_POST['email']);

				// MySQLi validation
				$email = mysqli_real_escape_string($DB -> link, $email);

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "<p style='color:red; font-size: 20px; text-align:center;'>Email Is Invalied !</p>";
                }else{
                    $mailQuery = "SELECT * FROM users WHERE email = '$email'";
                    $mailChecker = $DB -> select($mailQuery);

                    if($mailChecker != false){
                        while($data = $mailChecker -> fetch_assoc() ){
                            $userId = $data['id'];
                            $user_name = $data['user_name'];
                        }
                        // create a random password here
                        $text = substr($email, 0, 3);
                        $rand = rand(1000, 9999);
                                       
                        // create new password
                        $newPass = "$text$rand";
                        $password = md5($newPass);

                        $updeQuery = "UPDATE users SET password = '$password' WHERE id = '$userId'";

                        $updatePass = $DB -> update($updateQuery);

                        // send mail 
                        $to = "$email";
                        $from = "promasudbd@gmail.com";
                        $subject = "Password Forget";
                        $message = "Your User Name  $user_name and Your New Password Is: $newPass";

                        $header .= "From: $from \n";
                        $header .= "MIME-Version: 1.0 \r\n";
                        $header .= "Content-Transfer-Encoding: 8bit \r\n";

                        $sendMail = mail($to, $subject, $message, $header);

                        if($sendMail){
                            echo "<p style='color:green; font-size: 20px; text-align:center;'>Please Check Your Email !!!</p>";
                        }else{
                            echo "<p style='color:green; font-size: 20px; text-align:center;'>Email Not Send !!!</p>";
                        }

                    }else{
                        echo "<p style='color:red; font-size: 20px; text-align:center;'>Email Not Exist !!!</p>";
                    }
                }				
			}
		?>
		<form method="post">
			<h1>Pasword Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Email" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>