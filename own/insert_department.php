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
    $department_name = $_POST['department_name'];
    $sql = "INSERT INTO main_department (department_name) VALUES ('$department_name')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New Department added successfully")</script>';
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Department</title>
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
    <h1>Add New Department</h1>
    <form method="post" action="insert_department.php">
        <label for="department_name">Department Name</label>
        <input type="text" id="department_name" name="department_name" >
        <input type="submit" value="Add Department">
    </form>
</body>
</html>

<?php
$conn->close();
?>
