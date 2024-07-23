<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "Anjana@1304";
$dbname = "apcob";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$branch_name = $_GET['branch_name'];
$sql = "SELECT * FROM employee_branch WHERE branch_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $branch_name);
$stmt->execute();
$result = $stmt->get_result();

$employees = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

echo json_encode($employees);
$stmt->close();
$conn->close();
?>
