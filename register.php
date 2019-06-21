<?php
	require "assets/php/db.php";

	if(isset($_POST['submit'])){
		function treatIncomingData($data){
	        $data = trim($data);
	        $data = stripslashes($data);
	        $data = htmlspecialchars($data);
	        return $data;
	    }


		$name = treatIncomingData($_POST['name']);
		$username = treatIncomingData($_POST['user_name']);
		$password = treatIncomingData($_POST['user_pass']);
		echo $name. " ". $username." ".$password."<br>";

		$select_sql = "SELECT `user_id`, `user_name`, `user_pass` FROM `users` WHERE `user_name` LIKE '$username'";
		$execute_select = $connection -> query($select_sql);

		if($execute_select){
			$num_of_rows = mysqli_num_rows($execute_select);

			if($num_of_rows > 0){
				?>

				<script>

				var txt;
				var r = confirm("This username already exits. Try again?");
				if (r == true) {
					window.location.href = "register.php";
				} else {
					window.location.href = "index.php";
				}
				 
				</script>

				<?php

			}else{

				$insert_sql = "INSERT INTO `users`(`user_name`, `user_pass`, `name`) VALUES ('$username','$password','$name')";
				$execute_insert = $connection -> query($insert_sql);

				if($execute_insert){
					?>

					<script>

					var txt;
					var r = confirm("Succesfully registered. Login?");
					if (r == true) {
						window.location.href = "login.html";
					} else {
						window.location.href = "index.php";
					}
					 
					</script>

					<?php
				}else{
					?>

					<script>

					var txt;
					var r = confirm("Error occured! Try again?");
					if (r == true) {
						window.location.href = "register.php";
					} else {
						window.location.href = "index.php";
					}
					 
					</script>

					<?php
				}

			}

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register | CSE, RUET</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="assets/css/share.css">
</head>
<body>
	<div class="topnav">
	  <a href="index.php">Home</a>
	  <a href="share.php">Share</a>
	  <a class="active" href="login.html" title="">Login</a>
	</div>

	<div class="form_container">
		<form method="post" action="">
			<input type="text" name="name" value="" placeholder="Enter your name">
			<input type="text" name="user_name" value="" placeholder="Enter a username">
			<input type="password" name="user_pass" value="" placeholder="Enter a password">
			<input type="submit" name="submit" value="Register">
		</form>

		<div style="margin-top: 10px; font-size: 14px; text-align: center;">
			<a href="login.html" title="">Already have an account?</a>
		</div>
	</div>


</body>
</html>
