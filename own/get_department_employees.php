<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "Anjana@1304";
$dbname = "apcob";

// Handle the department name from GET parameter
$department_name = isset($_GET['department_name']) ? $_GET['department_name'] : '';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Prepare SQL statement to fetch employees for the given department
$sql = "SELECT emp_id, emp_name, designation, mailid, contact_no, department_name FROM employee WHERE department_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $department_name);
$stmt->execute();
$result = $stmt->get_result();

$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

echo json_encode($employees);
$stmt->close();
$conn->close();
?>
