<?php
	require "assets/php/db.php";
	session_start();

	if(!(isset($_SESSION['loggedin'])) || $_SESSION['loggedin'] == false){
		// echo '<script language="javascript">';
		// echo 'alert("Please login!")';
		// echo '</script>';

		?>

		<script>

		var txt;
		var r = confirm("Please login First");
		if (r == true) {
			window.location.href = "login.html";
		} else {
			window.location.href = "index.php";
		}
		 
		</script>

		<?php
	}

	//arrays
	$tags = array();

	//get all the tags
	$tag_sql = "SELECT `tag_id`, `tag_name` FROM `tags`";
	$execute_tag_fetch = $connection->query($tag_sql);

	while($row = $execute_tag_fetch -> fetch_assoc()){
		$tags[$row['tag_id']] = $row['tag_name'];
	}

	if(isset($_POST['submit'])){
		function treatIncomingData($data){
	        $data = trim($data);
	        $data = stripslashes($data);
	        $data = htmlspecialchars($data);
	        return $data;
	    }

	    $file_name = "";
	    $is_same = "";
	    $type = "";
	    $other_type = "";
	    $whom = array();
	    $tag = array();

	    if(isset($_POST['file_name']))
	    	$file_name = treatIncomingData($_POST['file_name']);
	    if(isset($_POST['same']))
	    	$is_same = $_POST['same'];
	    if(isset($_POST['resource_type']))
	    	$type = $_POST['resource_type'];
	    if(isset($_POST['other_resource']))
	    	$other_type = $_POST['other_resource'];
	    if(isset($_POST['for_whom']))
	    	$whom = $_POST['for_whom'];
	    if(isset($_POST['tag']))
	    	$tag = $_POST['tag'];
	   	
	   	$target_dir = "uploads/";
	   	$uploaded_file_name = $_FILES["upload_file"]["name"];
	   	$file_name_to_store = date('YmdHis') . '_' . uniqid(rand(),false);
	   	$temp_name = $_FILES["upload_file"]["tmp_name"];
	   	$size = $_FILES["upload_file"]["size"];
	   	$fileType = '.'.strtolower(pathinfo($_FILES["upload_file"]["name"],PATHINFO_EXTENSION));

	   	$upload_ok = true;

	   	if($size == 0){ 
	   		$upload_ok = false;
	   		?>
	   		<script>

				var txt;
				var r = confirm("Please upload a document");
				if (r == true) {
					history.go(-1);
				} else {
					window.location.href = "index.html";
				}
				 
			</script>
	   <?php	}

	    if($upload_ok == true){
	   		// echo "uploading file";

	   		if($type == "others"){
	   			$type = $other_type;
	   		}

	   		if($is_same == "sameAsDoc"){
	   			$file_name = $uploaded_file_name;
	   		}

	   		$file_name_in_folder = $target_dir.$file_name_to_store.$fileType;

	   		move_uploaded_file($temp_name, $file_name_in_folder); //upload the document

	   		//insert into 'post' table
	   		$uid = $_SESSION['user_id'];
	   		$post_id = date('YmdHis') . '_' . uniqid(rand(),false);
	   		$insert_post = "INSERT INTO `posts`(`post_id`, `user_id`, `type`, `file_title`, `document_name`) VALUES ('$post_id','$uid','$type','$file_name','$file_name_in_folder')";
	   		$execute_insert_post = $connection->query($insert_post);

	   		foreach ($whom as $key => $value) {
	   			$insert_sql = "INSERT INTO `for_whom`(`post_id`, `for_whom`) VALUES ('$post_id','$value')";
	   			$execute_insert_sql = $connection->query($insert_sql);
	   		}

	   		foreach ($tag as $key => $value) {
	   			$insert_tag = "INSERT INTO `post_tags`(`post_id`, `tag_id`) VALUES ('$post_id','$value')";
	   			$execute_insert_tag = $connection->query($insert_tag);
	   		}




	   		// echo $file_name_in_folder.'<br>'.$type;
	   }



	    // var_dump($_FILES['upload_file']);
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


	<link rel="stylesheet" type="text/css" href="assets/css/share.css">
</head>
<body>
	<div class="topnav">
	  <a href="index.php">Home</a>
	  <a class="active" href="share.php">Share</a>
	  <?php 
			if(!(isset($_SESSION['isLoggedin'])) || $_SESSION['loggedin'] == false){ ?>
				<a href="login.html" title="">Login</a>
			<?php }else{ ?>
				<a href="logout.php" title="">Logout</a>
			<?php }
		?>
	</div>

	<form class="form_container" action="" method="post" enctype="multipart/form-data">

		<label for="file_name">File name</label> 
		<input type="checkbox" id="same" name="same" value="sameAsDoc" onclick='handleClick(this);'><font size="2px">Same as document title</font>
		<input type="text" id="file_name" name="file_name" value="" placeholder="Enter file name">

		<label for="resource_type">Resource type</label>
		<select id="resource_type" name="resource_type" onclick='handleSelectClick(this);'>
			<option value="book">Book</option>
			<option value="paper">Paper</option>
			<option value="project">Project</option>
			<option value="code">Code</option>
			<option value="note">Notes</option>
			<option value="notice">Notice</option>
			<option value="others">Others</option>
		</select>
		<input type="text" id="other_resource" name="other_resource" value="" placeholder="Enter the type" style="display: none;">	

		<br><label for="for_whom">For whom</label>
		<select class="ForWhom" id="for_whom" name="for_whom[]" multiple>
			<option value="1">All</option>
			<option value="2">Only for all students</option>
			<option value="3">Only for all teachers</option>
			<option value="11">First year odd semester</option>
			<option value="12">First year even semester</option>
			<option value="21">Second year odd semester</option>
			<option value="22">Second year even semester</option>
			<option value="31">Third year odd semester</option>
			<option value="32">Third year even semester</option>
			<option value="41">Fourth year odd semester</option>
			<option value="42">Fourth year even semester</option>
		</select>	<br><br>


		<label for="tag">Tags</label>
		<select class="ForWhom" id="tag" name="tag[]" multiple>
			<?php
				foreach ($tags as $key => $value) {
					echo "<option option value=".$key.">".$value."</option>";
				}
			?>
		</select> <br><br>


		<label for="upload_file">Upload the file</label>
		<input type="file" id="upload_file" name="upload_file" value="">

		<input type="submit" name="submit" value="Share">	


	</form>


	<script type="text/javascript">
		function handleClick(cb) {
			var file_name = document.getElementById("file_name");

		    if(cb.checked == true){
		    	file_name.disabled = true;
		    }else{
		    	file_name.disabled = false;
		    }
		}

		function handleSelectClick(select) {
			var input = document.getElementById("other_resource");

		    console.log(select.value);

		    if(select.value == "Others"){
		    	input.style.display = "block";
		    }else{
		    	input.style.display = "none";
		    }
		}
	</script>

	<script>
		$(document).ready(function() {
			$('.ForWhom').select2();
		});
	</script>
</body>
</html>


