<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMP Portal</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link  rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css" />
</head>
<body>
<style>
.dropdown-content {
  display: none;
  position: absolute;
  z-index: 1;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  margin-top: 5px;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content a {
  color: black;
  padding: 6px 0;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}
</style>
<div style="position: absolute; top: 0; right: 0; padding: 10px;">
  <img src="pmplogo.png" alt="Company Logo" style="width: 100px; height: 100px;">
</div>
<?php
session_start();
  $name = $_SESSION['name'];
  $reg_no = $_SESSION['regno'];
  $address = $_SESSION['address'];
  $mobno = $_SESSION['mobno'];
  $email = $_SESSION['email'];

  echo '<div style="display: flex; justify-content:center;: center; padding-top: 50px; padding-left: 50px; color:black;">';
  echo '<img src="profileicon.jpg" style="border-radius: 50%; width: 100px; height: 100px; margin-right: 20px;"/>';
  echo '<p> Name: ' . $name . '<br>';
  echo 'Registration Number: ' . $reg_no . '<br>';
  echo 'Address: ' . $address . '<br>';
  echo 'Mobile Number: ' . $mobno . '<br>';
  echo 'Email: ' . $email;
  echo '</p>';
  echo '</div>';
  echo '<div style="padding-top: 20px;display: flex; justify-content: center;">';
  echo '<button style="background-color: forestgreen; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-size: 16px; margin-right: 10px;"><a href="https://ayurvedam4you.com/therapeutic-index/" style="text-decoration: none; color: white"><b>THERAPEUTIC INDEX</b></a></button>';
  echo '<div class="dropdown">';
  echo '<button class="dropdown-btn" style="background-color: forestgreen; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-size: 16px; margin-left: 10px;"><b>PRESCRIPTIONS</b></button>';
  echo '<div class="dropdown-content">';
  echo '<a href="addnewpatient.php">Add New Patient</a>';
  echo '<a href="listofpatients.php">List of Existing Patients</a>';
  echo '</div>';
  echo '</div>';
  echo '</div';

?> 
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
  <script>

var prescriptionsDropdown = document.querySelector('.dropdown-btn');
var prescriptionsDropdownContent = document.querySelector('.dropdown-content');

prescriptionsDropdown.addEventListener('mouseenter', function() {
  prescriptionsDropdownContent.style.display = 'block';
});

prescriptionsDropdown.addEventListener('mouseleave', function() {
  setTimeout(function() {
    prescriptionsDropdownContent.style.display = 'none';
  }, 2000);
});


</script>
</body>
</html>