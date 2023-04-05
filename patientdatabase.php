<?php
session_start();
$name = $_SESSION['name'];
$patient = $_SESSION['patient'];
$current_date = date('Y/m/d');
$conn = mysqli_connect("127.0.0.1", "Junaid", "passaccess", "aforu");
$pdf_base64 = $_SESSION['pdf'];
$pdf = base64_decode($pdf_base64);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$name = mysqli_real_escape_string($conn, $name);
$patient = mysqli_real_escape_string($conn, $patient);


$sql = "INSERT INTO prescriptions (docname, patname, date, patdetails) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssb", $name, $patient, $current_date, $pdf);

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
  echo '<script>alert("Successfully saved Patient Details")</script>';
  header("Location: dashboard.php");
} else {
  header("Location: dashboard.php");
  echo '<script>alert("You must first save patient details as pdf ")</script>'; 
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();
?>