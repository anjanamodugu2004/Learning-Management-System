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
if (isset($_GET['department_name'])) {
    $department_name = $_GET['department_name'];

    // Prepare SQL query to delete employee
    $sql = "DELETE FROM main_department WHERE department_name='$department_name'";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to update_employee.php after successful deletion
        echo '<script>alert("Department deleted successfully")</script>';
        header("Location: update_department.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Department Name not specified";
}

$conn->close();
?>
