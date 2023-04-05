<?php
session_start();
$name = $_POST["name"];
$regno = $_POST["regno"];
$address = $_POST["address"];
$mobno = $_POST["mobno"];
$email = $_POST["email"];
$_SESSION['name'] = $name;
$_SESSION['regno'] = $regno;
$_SESSION['address'] = $address;
$_SESSION['mobno'] = $mobno;
$_SESSION['email'] = $email;
$flag = 0;
if(empty($name) or empty($email) or empty($address) or empty($mobno) or empty($regno))
 { echo '<script>alert("Please fill all fields")</script>';
   include("profileupdation.php");
   $flag = 1;    }


  // Connect to the SQL database
  $conn = mysqli_connect("127.0.0.1", "Junaid", "passaccess", "aforu");

  // Check if the connection was successful
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Add user details to the SQL database
  $sql = "INSERT INTO docdetails VALUES ('$name', '$regno', '$address','$mobno', '$email')";
  if (mysqli_query($conn, $sql)) {
      echo "Registration was successful. You may now login";
      header("Location: dashboard.php");
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>