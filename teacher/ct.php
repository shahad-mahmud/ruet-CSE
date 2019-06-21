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
	  <a href="attendence.php">Attendence</a>
	  <a href="resources.php">Share Resource</a>
	  <a class="active" href="ct.php">Class Test</a>
	</div>

	<div class="sidepanel">
		<button class="button" onclick="showPublishCTmark()">Publish CT mark</button>
		<button class="button" onclick="showCTmarkSummary()">Attendence summary</button>
	</div>

	<div class="main_body">
	</div>

	<script type="text/javascript">
		function showPublishCTmark() {
			var take = document.getElementById("take_attendence");
			var sum = document.getElementById("attendence_summary");
		    
		    sum.style.display = 'none';
		    take.style.display = 'block';
		}

		function showCTmarkSummary() {
			var take = document.getElementById("take_attendence");
			var sum = document.getElementById("attendence_summary");
		    
		    take.style.display = 'none';
		    sum.style.display = 'block';
		}
	</script>
</body>
</html>
