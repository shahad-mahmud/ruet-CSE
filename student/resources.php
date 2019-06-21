<?php
	session_start();
	require "../assets/php/db.php";

	if(isset($_POST['submit'])){

		$type = $_POST['resource_type'];
		$series = $_POST['series'];
		$course = $_POST['course'];
		$user_id = $_SESSION['user_id'];

		//uploading the file
		$target_dir = "../uploads/";
		$file_name = date('YmdHis') . '_' . uniqid(rand(),false);
		$temp_name = $_FILES["file"]["tmp_name"];
		$target_file_name = $target_dir . $file_name;
		$imageFileType = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
		$target_file = $target_file_name. '.' .$imageFileType;
		$file_name_for_db = $file_name. '.' .$imageFileType;
		$name = $_FILES["file"]["name"];

		move_uploaded_file($temp_name, $target_file);

		$insert_sql = "INSERT INTO `posts`(`user_id`, `type`, `series`, `course_id`, `content`, `file_title`) VALUES ('$user_id','$type','$series','$course','$file_name_for_db', '$name')";
		$execute = $connection->query($insert_sql);

		if($execute){
			echo "Resource shared";
		}

		

		// echo $type." ".$series." ".$course." ".$_FILES["file"]["name"];

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/teacher/teacher.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/teacher/topnav.css">
</head>
<body>
	<div class="topnav">
	  <a href="index.php">Home</a>
	  <a href="profile.php">Profile</a>
	  <a class="active" href="resources.php">Share Resource</a>
	</div>

	<form class="res_form_container" action="" method="post" enctype="multipart/form-data">
		<label for="resource_type">Resource Type</label>
		<select id="resource_type" name="resource_type">
			<option>Book</option>
			<option>Paper</option>
			<option>Notes</option>
			<option>others</option>
		</select>

		<label for="series">Series</label>
		<select id="series" name="series">
			<option>14</option>
			<option>15</option>
			<option>16</option>
			<option>17</option>
			<option>18</option>
		</select>

		<label for="course">Course no</label>
		<select id="course" name="course">
			<option>CSE 3201</option>
			<option>CSE 3203</option>
			<option>CSE 3205</option>
			<option>CSE 3207</option>
			<option>CSE 3209</option>
		</select>

		<label for="file">Course no</label>
		<input type="file" name="file" value="" placeholder="">

		<input type="submit" name="submit" value="Share">
	</form>
</body>
</html>
