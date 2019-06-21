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
	  <a class="active" href="attendence.php">Attendence</a>
	  <a href="resources.php">Share Resource</a>
	</div>

	<div class="sidepanel">
		<button class="button" onclick="showTakeAttendence()">Take attendence</button>
		<button class="button" onclick="showAttendenceSummary()">Attendence summary</button>
	</div>

	<div class="main_body">
		<form class="form_container" id="take_attendence">
			<label for="series">Select series</label>
			<select name="series" id="series">
				<option>15</option>
				<option>16</option>
				<option>17</option>
			</select>

			<label for="section">Select section</label>
			<select name="section" id="section">
				<option>A</option>
				<option>B</option>
				<option>C</option>
			</select>

			<label for="cycle">Select cycle</label>
			<select name="cycle" id="cycle">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
				<option>11</option>
				<option>12</option>
				<option>13</option>
				<option>14</option>
			</select>

			<label for="section">Select section</label>
			<select name="section" id="section">
				<option>A</option>
				<option>B</option>
				<option>C</option>
				<option>D</option>
				<option>E</option>
			</select>

			<br><input type="text" name="" value="" placeholder="sdafsdfsa">
		</form>

		<dir id="attendence_summary" style="display: none;">
			asfdsdfsfafsdf
		</dir>
	</div>

	<script type="text/javascript">
		function showTakeAttendence() {
			var take = document.getElementById("take_attendence");
			var sum = document.getElementById("attendence_summary");
		    
		    sum.style.display = 'none';
		    take.style.display = 'block';
		}

		function showAttendenceSummary() {
			var take = document.getElementById("take_attendence");
			var sum = document.getElementById("attendence_summary");
		    
		    take.style.display = 'none';
		    sum.style.display = 'block';
		}
	</script>
</body>
</html>
