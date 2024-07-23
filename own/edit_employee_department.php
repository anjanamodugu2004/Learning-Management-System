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
    $sl_no=$_POST['sl_no'];
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $designation = $_POST['designation'];
    $mailid = $_POST['mailid'];
    $conatct_no = $_POST['conatct_no'];
    $department_name = $_POST['department_name'];

    $sql = "UPDATE employee SET  emp_id='$emp_id', emp_name='$emp_name', designation='$designation', mailid='$mailid', contact_no='$contact_no',department_name='$department_name' WHERE sl_no='$sl_no'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to update_employee.php
        echo '<script>alert(" employee Updated successfully")</script>';
        header("Location: update_employee_department.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['sl_no'])) {
    $sl_no = $_GET['sl_no'];

    $sql = "SELECT * FROM employee WHERE sl_no='$sl_no'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Employee not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
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
    <h1>Edit Employee</h1>
    <form method="post" action="edit_employee_department.php">
        <input type="hidden" name="sl_no" value="<?php echo $row['sl_no']; ?>">
        <label for="emp_id">Employee ID</label>
        <input type="text" id="emp_id" name="emp_id" value="<?php echo $row['emp_id']; ?>" required>
        <label for="emp_name">Employee Name</label>
        <input type="text" id="emp_name" name="emp_name" value="<?php echo $row['emp_name']; ?>" required>
        <label for="designation">Designation</label>
        <input type="text" id="designation" name="designation" value="<?php echo $row['designation']; ?>" required>
        <label for="mailid">Mail ID</label>
        <input type="text" id="mailid" name="mailid" value="<?php echo $row['mailid']; ?>" required>
        <label for="contact_no">Contact Number</label>
        <input type="text" id="contact_no" name="contact_no" value="<?php echo $row['contact_no']; ?>" required>
        <label for="department_name">Department Name</label>
        <input type="text" id="department_name" name="department_name" value="<?php echo $row['department_name']; ?>" required>
        <input type="submit" value="Update Employee">
    </form>
</body>
</html>

<?php
$conn->close();
?>
