<?php
	session_start();
	require "../assets/php/db.php";

	$user = array();
	$users = array();

	$post = array();
	$posts = array();

	$user_sql = "SELECT `user_id`, `user_name`, `name` FROM `users`";
	$exe_user = $connection -> query($user_sql);

	while($user_row = $exe_user->fetch_assoc()){
		$user['user_id'] = $user_row['user_id'];
		$user['user_name'] = $user_row['user_name'];
		$user['name'] = $user_row['name'];

		$users[$user['user_id']] = $user;
	}

	// var_dump($users);

	$post_sql = "SELECT `post_id`, `user_id` FROM `posts`";
	$exe_post = $connection -> query($post_sql);

	while($post_row = $exe_post -> fetch_assoc()){
		$post['post_id'] = $post_row['post_id'];
		// $post['user_id'] = $post_row['user_id'];
		// $post['type'] = $post_row['type'];
		// $post['series'] = $post_row['series'];
		// $post['course_id'] = $post_row['course_id'];
		// $post['content'] = $post_row['content'];
		// $post['file_title'] = $post_row['file_title'];

		array_push($posts, $post);
	}

	// var_dump($posts);

	$total_posts = sizeof($posts);
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
	  <a class="active" href="index.php">Home</a>
	  <a href="attendence.php">Attendence</a>
	  <a href="resources.php">Share Resource</a>
	  <a href="ct.php">Class Test</a>
	</div>

	<div class="home">
		

			<?php

			for($i= 0; $i < $total_posts; $i++){ ?>

			<div class="container">

				<font style="font-weight: bold;"><?php echo $users[$posts[$i]['user_id']]['name'] ?></font> shared an <?php echo $posts[$i]['type'] ?> <br>

				<div class="file_container">
					
					<?php echo $posts[$i]['file_title'] ?>
								
				</div>
			</div>

			<?php }

			?>

		
	</div>
</body>
</html>
