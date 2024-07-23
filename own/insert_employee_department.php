<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Anjana@1304";
$dbname = "apcob";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $designation = $_POST['designation'];
    $mailid = $_POST['mailid'];
    $conatct_no = $_POST['conatct_no'];
    $department_name = $_POST['department_name'];

    $sql = "INSERT INTO employee (sl_no,emp_id, emp_name, designation, mailid, contact_no,department_name) VALUES ('','$emp_id', '$emp_name', '$designation', '$mailid', '$contact_no','$department_name')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New employee added successfully")</script>';
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            width: 50%;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }

        label, input {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007f3f;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00532b;
        }
    </style>
</head>
<body>
    <h1>Add New Employee</h1>
    <form method="post" action="insert_employee_department.php">
        <label for="emp_id">Employee ID</label>
        <input type="text" id="emp_id" name="emp_id" required>
        <label for="emp_name">Employee Name</label>
        <input type="text" id="emp_name" name="emp_name" required>
        <label for="designation">Designation</label>
        <input type="text" id="designation" name="designation" required>
        <label for="mailid">Mail ID</label>
        <input type="text" id="mailid" name="mailid" required>
        <label for="contact_no">Contact Number</label>
        <input type="text" id="contact_no" name="contact_no" required>
        <label for="department_name">Branch Name</label>
        <input type="text" id="department_name" name="department_name" required>
        <input type="submit" value="Add Employee">
    </form>
</body>
</html>

<?php
$conn->close();
?>
