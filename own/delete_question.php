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
if (isset($_GET['sl_no'])) {
    $sl_no = $_GET['sl_no'];

    // Prepare SQL query to delete employee
    $sql = "DELETE FROM questions WHERE sl_no='$sl_no'";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to update_employee.php after successful deletion
        echo '<script>alert("Question deleted successfully")</script>';
        header("Location: update_question.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Question ID not specified";
}

$conn->close();
?>
