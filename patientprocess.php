<?php

session_start();
  $name = $_SESSION['name'];
  $regno = $_SESSION['regno'];
  $address = $_SESSION['address'];
  $mobno = $_SESSION['mobno'];
  $email = $_SESSION['email'];
  $patient = $_SESSION['patient'];
  $patmob = $_SESSION['patmob'];
  $patmail = $_SESSION['patmail'];
  $patage = $_SESSION['patage'];
  $sex = $_SESSION['sex'];
  $prescription = $_SESSION['prescription'];
  $dosage = $_SESSION['dosage'];
// Include the library
require('fpdf.php');
ob_start();
// Create a new PDF object
$pdf = new FPDF();

// Add a page
$pdf->AddPage();

// Set the font for the header
$pdf->SetFont('Arial','B',16);

// Add the doctor's details to the top right corner
$pdf -> Image('pmplogo.png',140,30,60);
$pdf->Cell(0,10,'Dr.'.$name,0,1);
$pdf->Cell(0,10,"Reg. No.: $regno",0,1);
$pdf->Cell(0,10,$address,0,1);
$pdf->Cell(0,10,"Email: $email",0,1);
$pdf->Cell(0,10,"Mob No.: $mobno",0,1);

$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(0.5);
$pdf->Line(20,60,200,60);


$current_date = date('Y/m/d');
$random_id = rand(1000,9999);

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(90, 20, 'Date: ' . date("Y/m/d"), 0, 0);
$pdf->Cell(90, 20, 'ID: ' . rand(10000,99999), 0, 1, 'R');

// Set the font for the patient details
$pdf->SetFont('Arial','B',15);
$pdf->Cell(80, 10, 'Patient Description', 0, 1, 'C');
$pdf->SetFont('Arial','B',12);
// Add the patient's details
$pdf->Cell(80,10,"Patient Name: ");
$pdf->Cell(80,10,$patient,0,1);
$pdf->Cell(80,10,"Age: ");
$pdf->Cell(80,10,$patage,0,1);
$pdf->Cell(80,10,"Sex: ");
$pdf->Cell(80,10,$sex,0,1);
$pdf->Cell(80,10,"Mob No.: ");
$pdf->Cell(80,10,$patmob,0,1);
$pdf->Cell(80,10,"Email: ");
$pdf->Cell(80,10,$patmail,0,1);
$pdf->Ln();
$pdf->Cell(50,10,"Prescription: ");
$pdf->Ln();
$pdf->SetFont('Arial','',12);
foreach ($prescription as $key=>$prescribe) {
  $pdf->Cell(0, 10, "Prescription ".($key+1).":");
  $pdf->Ln();
  $pdf->Cell(0, 10, $prescribe); // added dosage value
  $pdf->Ln();
  $pdf->MultiCell(0, 10, "Dosage: ".$dosage[$key]); 
  $pdf->Ln(5);
}

$pdfPath = sys_get_temp_dir().'/patientdetails.pdf';
$pdf -> Output($pdfPath,"F");
$pdf -> Output("patientprescriptiondetails.pdf","D");
if (!file_exists($pdfPath)) {
  echo "Failed to save PDF file";
}
// Read the PDF file contents to a variable
$pdfContent = file_get_contents($pdfPath);
echo $pdfContent;
$conn = mysqli_connect("127.0.0.1", "Junaid", "passaccess", "aforu");
$sql2 = "SELECT * FROM prescriptions";
$result = mysqli_query($conn, $sql2);
$count = mysqli_num_rows($result) + 1;
// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$name = mysqli_real_escape_string($conn, $name);
$patient = mysqli_real_escape_string($conn, $patient);
$binaryPdfContent = mysqli_real_escape_string($conn, $pdfContent);
$sql = "INSERT INTO prescriptions (docname, patname, date, patdetails,id) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssbs", $name, $patient, $current_date, $binaryPdfContent, $count);
mysqli_stmt_send_long_data($stmt, 3, $pdfContent);


// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
  echo '<script>alert("Successfully saved Patient Details")</script>';
  include("patientsave.php");
} else  {
  header("Location: dashboard.php");
  echo '<script>alert("You must first save patient details as pdf ")</script>'; 
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();
?>
 