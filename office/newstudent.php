<?php
  


  if(isset($_POST['submit'])){
    function treatIncomingData($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    //get the data
    $id = treatIncomingData($_POST['student_id']);
    $name = treatIncomingData($_POST['student_name']);
    $father_name = treatIncomingData($_POST['father_name']);
    $mother_name = treatIncomingData($_POST['mother_name']);
    $address = treatIncomingData($_POST['address']);
    $section = $_POST['student_section'];

  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add a new student</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/newstudent.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">
  </head>
  <body>
    <div class="topnav">
  	  <a href="index.php">Home</a>
  	  <a class="active" href="newstudent.php">New student</a>
  	  <a href="publishnotice.php">Publish Notice</a>
  	  <a href="#about">About</a>
  	</div>

    <div class="center-div">
    	<dir class="top">
    		Add a student
    	</dir>

    	<div class="form_container">
    		<form method="post" action="">
    			<input type="text" name="student_id" value="" placeholder="Student id / roll no.">
    			<input type="text" name="student_name" value="" placeholder="Student name">
          <input type="text" name="father_name" value="" placeholder="Father's name">
          <input type="text" name="mother_name" value="" placeholder="Mother's name">
          <input type="text" name="address" value="" placeholder="Address">
          <select name="student_section">
            <option value="" disabled selected>Select section</option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
          </select>
    			<button name="submit">Add</button>
    		</form>
    	</div>
    </div>
  </body>
</html>
