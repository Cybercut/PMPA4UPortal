<!DOCTYPE html>
<html>
<head>
	<title>Prescriptions</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link  rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css" >
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-success">
		<a class="navbar-brand" href="#">Prescriptions</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="dashboard.php">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="https://ayurvedam4you.com/therapeutic-index/">Therapeutic Index</a>
				</li>
			</ul>
		</div>
	</nav>

	<!-- Table to display patient details -->
	<div class="container mt-5">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Patient Name</th>
					<th>Date</th>
					<th>Prescription Report</th>
				</tr>
			</thead>
			<tbody>

			<?php

			// Connect to the database
            session_start();
			$conn = mysqli_connect("127.0.0.1", "Junaid", "passaccess", "aforu");
            $name = $_SESSION['name'];
			// Check if the connection was successful
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Query to select all rows from the 'prescriptions' table
			$sql = "SELECT patname,date, patdetails FROM prescriptions WHERE docname = '$name'";

			// Execute the query
			$result = mysqli_query($conn, $sql);
            $count = 0;
			// Check if any rows were returned
			if (mysqli_num_rows($result) > 0 and $count <= mysqli_num_rows($result)) {

				// Loop through each row
				while ($row = mysqli_fetch_assoc($result)) {

					// Display the patient details in a table row
					echo "<tr>";
					echo "<td>" . $row['patname'] . "</td>";
					echo "<td>" . $row['date'] . "</td>";

					// Display a link to the prescription report PDF file
                    $count = $count + 1;
					$pdfContent = $row['patdetails'];
					$pdfPath = sys_get_temp_dir().'\patientdetails.pdf';
					file_put_contents('patientdetails'.$count.'pdf', $pdfContent);
                    echo 'patientdetails'.$count.'pdf';
					$pdfUrl = 'patientdetails'.$count.'pdf'; // Change this to the URL of your website where the PDF file can be accessed
					echo "<td><a href='" . $pdfUrl . "' target='_blank'>" . $row['patname'] . "</a></td>";
					echo "</tr>";
				}
			} else {
				echo "No rows found";
			}

			// Close the database connection
			mysqli_close($conn);

			?>

		</tbody>
	</table>
	<script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"
  ></script>
</body>
</html>