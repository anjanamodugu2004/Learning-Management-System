<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Anjana@1304";
$dbname = "apcob";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if emp_id is provided in the URL (GET request)
if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];

    // Prepare SQL query to delete employee
    $sql = "DELETE FROM employee_branch WHERE emp_id='$emp_id'";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to update_employee.php after successful deletion
        echo '<script>alert("Employee deleted successfully")</script>';
        header("Location: update_employee_branch.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Employee ID not specified";
}

$conn->close();
?>
