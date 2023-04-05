<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
// Include PHPMailer library


// Connect to the database

session_start();
$patient = $_SESSION['patient'];
$conn = mysqli_connect("127.0.0.1", "Junaid", "passaccess", "aforu");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to select the last row from the 'pdfs' table
$sql = "SELECT * FROM prescriptions  WHERE patname = '$patient'";


// Execute the query
$result = mysqli_query($conn, $sql);

// Check if a row was returned
if (mysqli_num_rows($result) > 0) {
    // Get the data from the row
    $row = mysqli_fetch_assoc($result);
    $pdfContent = $row['patdetails'];

    try {
    // Create a new PHPMailer object
    $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'tiltbrand056@gmail.com';                  // SMTP username
        $mail->Password   = 'fhnocttaltjxxazk';                   // SMTP password
        $mail->SMTPSecure = 'ssl';            // Enable SSL encryption
        $mail->Port       = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('tiltbrand056@gmail.com');
        $mail->addAddress('jonaidahmad103@gmail.com');     // Add a recipient

        // Attach the PDF file
        $mail->addStringAttachment($pdfContent, 'patientdetails.pdf');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Patient Details';
        $mail->Body    = 'Please find the PDF attachment below.';

        // Send the email
        $mail->send();
        echo  "<script>alert('Email sent successfully')</script>";
        header("Location: dashboard.php");

    } catch (Exception $e) {
        echo "Message could not be sent". $mail->ErrorInfo;
}
} 
else {
    echo "<script>alert('Please save it to database first and then refresh the page')</script>" ;
}

// Close the database connection
mysqli_close($conn);
?>