<?php
date_default_timezone_set('Asia/Kolkata'); // Set your timezone, e.g., 'America/New_York'
include_once 'dbConnection.php';
$ref=@$_GET['q'];
$name = $_POST['name'];
$emp_id = $_POST['emp_id'];
$subject = $_POST['subject'];
$id=uniqid();
$date=date("Y-m-d");
$time=date("h:i:s A");  // Corrected time format with AM/PM
$feedback = $_POST['feedback'];

// Assuming your feedback table has columns: id, name, emp_id, subject, feedback, date, time
$q=mysqli_query($con,"INSERT INTO feedback (id, name, emp_id, subject, feedback, date, time) VALUES ('$id', '$name', '$emp_id', '$subject', '$feedback', '$date', '$time')")or die ("Error");

echo '<script>alert("Feedback submitted");
location.href="account.php?q=5"
</script>';
//header("location:account.php?q=5");
?>