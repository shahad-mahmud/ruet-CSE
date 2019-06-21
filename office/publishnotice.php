<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/office.css">
</head>
<body>
	<div class="topnav">
	  <a href="index.php">Home</a>
	  <a href="newstudent.php">New student</a>
	  <a class="active" href="publishnotice.php">Publish Notice</a>
	  <a href="#about">About</a>
	</div>

	<div class="form_container">
		<form action="">
		    <label for="noticeTitle">Notice Title</label>
		    <input type="text" id="noticeTitle" name="noticeTitle" placeholder="Notice title..">

		    <label for="description">Notice description</label>
		    <input type="text" id="description" name="description" placeholder="Notice description..">

		    <label for="notice_for">Notice for</label><br>
		    <input type="checkbox" id="notice_for" name="notice_for[]" value="for_teachers">Teachers</input>
		    <input type="checkbox" id="notice_for" name="notice_for[]" value="for_students">Students</input>
		    <input type="checkbox" id="notice_for" name="notice_for[]" value="for_staffs">Office staffs</input>
		    <input type="checkbox" id="notice_for" name="notice_for[]" value="for_others">Others</input><br><br>

		    <label for="notice_file">Notice file</label>
		    <input type="file" id="notice_file" name="notice_file" value=""></input>
	  
	    	<input type="submit" value="Submit">
	  </form>
	</div>


</body>
</html>
