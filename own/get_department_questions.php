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

$sql = "SELECT question, answer, links FROM questions WHERE department_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $department_name);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

echo json_encode($questions);
$stmt->close();
$conn->close();
?>
