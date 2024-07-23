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
    $branch_id = $_POST['branch_id'];
    $branch_name = $_POST['branch_name'];
    $sql = "INSERT INTO branch (branch_id, branch_name) VALUES ('$branch_id', '$branch_name')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New Branch added successfully")</script>';
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Branch</title>
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
    <h1>Add New Branch</h1>
    <form method="post" action="insert_branch.php">
        <label for="branch_id">Branch ID</label>
        <input type="text" id="branch_id" name="branch_id" required>
        <label for="branch_name">Branch Name</label>
        <input type="text" id="branch_name" name="branch_name" >
        <input type="submit" value="Add Branch">
    </form>
</body>
</html>

<?php
$conn->close();
?>
