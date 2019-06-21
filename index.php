<?php
	session_start();
	require "assets/php/db.php";

	$user = array();
	$users = array();

	$post = array();
	$posts = array();

	$tag = array();
	$tags = array();

	$whom_array = array();

	$isFiltered = false;

	//************for whom array**************
	$whom_array["1"] = "All";
	$whom_array["2"] = "Only for all students";
	$whom_array["3"] = "Only for all teachers";
	$whom_array["11"] = "First year odd semester";
	$whom_array["12"] = "First year even semester";
	$whom_array["21"] = "Second year odd semester";
	$whom_array["22"] = "Second year even semester";
	$whom_array["31"] = "Third year odd semester";
	$whom_array["32"] = "Third year even semester";
	$whom_array["41"] = "Fourth year odd semester";
	$whom_array["42"] = "Fourth year even semester";

	//************get all users***************
	$user_sql = "SELECT `user_id`, `user_name`, `name` FROM `users`";
	$exe_user = $connection -> query($user_sql);

	while($user_row = $exe_user->fetch_assoc()){
		$user['user_id'] = $user_row['user_id'];
		$user['user_name'] = $user_row['user_name'];
		$user['name'] = $user_row['name'];

		$users[$user['user_id']] = $user;
	}

	//***********get all tags****************
	$tag_sql = "SELECT `tag_id`, `tag_name` FROM `tags`";
	$exe_tag_sql = $connection -> query($tag_sql);

	while($tag_row = $exe_tag_sql -> fetch_assoc()){
		$tags[$tag_row['tag_id']] = $tag_row['tag_name'];
	
	}

	// var_dump($users);

	//************get all posts***************
	$post_sql = "SELECT `post_id`, `user_id`, `type`, `file_title`, `document_name` FROM `posts` ORDER BY `post_id` DESC LIMIT 100";
	$exe_post = $connection -> query($post_sql);

	while($post_row = $exe_post -> fetch_assoc()){
		$postId = $post_row['post_id'];
		$post['post_id'] = $postId;
		$post['user_id'] = $post_row['user_id'];
		$post['type'] = $post_row['type'];
		$post['file_title'] = $post_row['file_title'];
		$post['document_name'] = $post_row['document_name'];

		$tag = array();
		$post_tag_sql = "SELECT `post_id`, `tag_id` FROM `post_tags` WHERE `post_id` = '$postId'";
		$exe_post_tag_sql = $connection -> query($post_tag_sql);
		while($post_tag_row = $exe_post_tag_sql -> fetch_assoc()){
			array_push($tag, $tags[$post_tag_row['tag_id']]);
		}

		$post['tags'] = $tag;

		array_push($posts, $post);
	}

	// var_dump($posts);

	$total_posts = sizeof($posts);

	if(isset($_POST['submit'])){
		$posts = array();
		$type = "";
		$whom = "";
		$filter_tags = "";
		$isFiltered = true;
		$isTypeSet = false;
		$isTagSet = false;
		$isWhomSet = false;
		$post_sql = "SELECT `post_id`, `user_id`, `type`, `file_title`, `document_name` FROM `posts`";

		if(isset($_POST['type'])){
			$type = $_POST['type'];
			$post_sql = $post_sql." WHERE `type` = '$type' ORDER BY `post_id` DESC";
			$isTypeSet = true;
		}
		if(isset($_POST['for_whom'])){
			$whom = $_POST['for_whom'];
			$isWhomSet = true;
			// echo $whom;
		}
		if(isset($_POST['tag'])){
			$filter_tags = $_POST['tag'];
			$isTagSet = true;
			// echo $tags[$filter_tags];
		}

		// echo $isTagSet;



		$exe_post = $connection -> query($post_sql);

		while($post_row = $exe_post -> fetch_assoc()){
			$postId = $post_row['post_id'];
			$post['post_id'] = $postId;
			$post['user_id'] = $post_row['user_id'];
			$post['type'] = $post_row['type'];
			$post['file_title'] = $post_row['file_title'];
			$post['document_name'] = $post_row['document_name'];
			$pushPostTag = false;
			$pushPostWhom = false;

			if($isTagSet == false)
				$pushPostTag = true;
			if($isWhomSet == false)
				$pushPostWhom = true;

			$tag = array();
			$whomArray = array();


			$post_tag_sql = "SELECT `post_id`, `tag_id` FROM `post_tags` WHERE `post_id` = '$postId'";
			$exe_post_tag_sql = $connection -> query($post_tag_sql);
			while($post_tag_row = $exe_post_tag_sql -> fetch_assoc()){
				if($isTagSet == true){
					// echo $post_tag_row['tag_id']." ".$filter_tags."<br>";
					if($post_tag_row['tag_id'] == $filter_tags){
						$pushPostTag = true;

					}
				}
				array_push($tag, $tags[$post_tag_row['tag_id']]);
			}

			$post['tags'] = $tag;

			$post_whom_sql = "SELECT `post_id`, `for_whom` FROM `for_whom` WHERE `post_id` = '$postId'";
			$exe_post_whom_sql = $connection -> query($post_whom_sql);

			while($post_whom_row = $exe_post_whom_sql -> fetch_assoc()){
				if($isWhomSet == true){
					// echo $post_whom_row['for_whom']." ".$whom."<br>";
					if($post_whom_row['for_whom'] == $whom){
						$pushPostWhom = true;
					}
				}
				// array_push($tag, $tags[$post_whom_row['tag_id']]);
			}

			if($pushPostTag == true && $pushPostWhom == true)
				array_push($posts, $post);
		}

		// var_dump($posts);

		$total_posts = sizeof($posts); 
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home | CSE, RUET</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

	<link rel="stylesheet" type="text/css" href="assets/css/share.css">
</head>
<body>
	<div class="topnav">
		<a class="active" href="index.php">Home</a>
		<a href="share.php">Share</a>
		
		<?php 
			if(!(isset($_SESSION['isLoggedin'])) || $_SESSION['loggedin'] == false){ ?>
				<a href="login.html" title="">Login</a>
			<?php }else{ ?>
				<a href="logout.php" title="">Logout</a>
			<?php }
		?>
	</div>

	<div class="sidePanel">
		<div class="segments">
			
			<font size="5">Filter posts</font>

		</div>

		<form method="post">
			
			<div class="segments">
			
				<font size="4">Type</font>
				<br> 
				<input type="radio" name="type" value="book">Books <br>
				<input type="radio" name="type" value="paper">Papers <br>
				<input type="radio" name="type" value="project">Project <br>
				<input type="radio" name="type" value="code">Code <br>
				<input type="radio" name="type" value="notes">Notes <br>
				<input type="radio" name="type" value="notice">Notice <br>

	</div>

			<div class="segments">
			
				<font size="4">For whom</font>
				<br> 
				<select class="ForWhom" id="for_whom" name="for_whom">
					<option value="" disabled selected>Select filter</option>
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
				</select>

			</div>

			<div class="segments">
			
				<font size="4">Tags</font>
				<br> 
				<select class="ForWhom" id="tag" name="tag">
					<option value="" disabled selected>Select filter</option>
					<?php
						foreach ($tags as $key => $value) {
							echo "<option option value=".$key.">".$value."</option>";
						}
					?>
				</select> 

			</div>

			<input type="submit" name="submit" value="Apply">


		</form>
	</div>

	<div class="home">
		<div class="filtered" style="display: <?php 
			if($isFiltered)
				echo "block";
			else
				echo "none";
		 ?>">
			
			Showing filtered posts <br>

			<?php
				if($isTypeSet){ ?>

					<div class="words">Type</div>
					<div class="values"><?php echo $type ?></div> 

				<?php }
				if($isWhomSet){ ?>

					<div class="words">For</div>
					<div class="values"><?php echo $whom_array[$whom] ?></div> 

				<?php }
				if($isTagSet){ ?>

					<div class="words">Tag</div>
					<div class="values"><?php echo $tags[$filter_tags] ?></div> 

				<?php }
			?>
			
			<div class="clear" onclick="location.href='index.php';">x Clear filters</div>

		</div>
		<!-- <div class="container">
			fdfffffffffffff

			<div class="file_container">

				<div style="float: left;">
					
					<img src="assets/images/document.png" height="23px;" width="23px;" title="view" style="padding-right: 10px;">

				</div>
				
				sssssssssssss

				<div style="float: right;">
					
					<img src="assets/images/eye.png" height="20px;" width="20px;" alt="view" style="padding-right: 15px;">
					<img src="assets/images/download.png" height="20px;" width="20px;" alt="view" style="padding-right: 10px;">

				</div>
							
			</div>

			<div style="margin-top: 8px;">
				
				<div class="tag_container">
					sdfdfd
				</div>
				<div class="tag_container">
					sdfdfd
				</div>
				<div class="tag_container">
					sdfdfd
				</div>

			</div>
		</div> -->


		<?php 
		for($i= 0; $i < $total_posts; $i++){ ?>

			<div class="container">
				<font style="font-weight: bold;"><?php echo $users[$posts[$i]['user_id']]['name'] ?></font> shared one <?php echo $posts[$i]['type'] ?>

				<div class="file_container">

					<div style="float: left;">
						
						<img src="assets/images/document.png" height="23px;" width="23px;" title="view" style="padding-right: 10px;">

					</div>
					
					<?php echo $posts[$i]['file_title'] ?>

					<div style="float: right;">
						
						<a href="<?php echo $posts[$i]['document_name'] ?>" target="_blank" title=""><img src="assets/images/eye.png" height="20px;" width="20px;" alt="view" style="padding-right: 15px;"></a>
						<a href="<?php echo $posts[$i]['document_name'] ?>" download><img src="assets/images/download.png" height="20px;" width="20px;" alt="view" style="padding-right: 10px;"></a>

					</div>
								
				</div>

				<?php 
					$post_tags = $posts[$i]['tags'];
					$total_tags = sizeof($post_tags);
				?>

				<div style="margin-top: 8px; font-size: 14px;">

					<?php
					for ($j=0; $j < $total_tags; $j++) { ?>
						<div class="tag_container">
							<?php echo $post_tags[$j]; ?>
						</div>
					<?php }
					?>
				</div>

			</div>

		<?php } ?>
	</div>

	<script>
		$(document).ready(function() {
			$('.ForWhom').select2();
		});
	</script>
	
</body>
</html>