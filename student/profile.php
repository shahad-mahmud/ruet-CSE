<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/student/profile.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/student/topnav.css">


	<!-- *********************** -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['semister', 'GPA', 'CGPA'],
          ['1',  3.25,      3.25],
          ['2',  2.98,      3.10],
          ['3',  3.69,       3.48],
          ['4',  3.5,      3.49]
        ]);

        var options = {
          title: '',
          legend: { position: 'bottom' },
          backgroundColor: '#EEE',
          is3D: true
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>


	<!-- *********************** -->
</head>
<body>
	<div class="topnav">
	  <a href="index.php">Home</a>
	  <a class="active" href="profile.php">Profile</a>
    <a href="resources.php">Share Resource</a>
	</div>

	<div class="sidepanel">
  		<img src="../assets/images/boss.png" alt="profile picture" width="150px" height="150px"><br>
  		<font size="5" style="font-weight: bold; margin-top: 8px;">Md. Abul Kalam</font><br>
  		<div class="student_details">
  			<font size="3">Third year even semister</font><br>
  		</div>
  		<div class="student_details">
  			<font size="3">CGPA: 3.43</font><br>
  		<font size="3">Earned cradit: 119.75</font><br>
  		</div>
  		
	</div>


	<!-- the main body -->
	<div class="main_body">
  		<div id="curve_chart" style="width: 600px; height: 400px; margin: auto; background-color: inherit;"></div>
  </div>
	</div>
</body>
</html>
