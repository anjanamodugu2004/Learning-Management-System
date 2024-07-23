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
    $sql = "UPDATE branch SET  branch_name='$branch_name' WHERE branch_id='$branch_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to update_employee.php
        echo '<script>alert(" Branch Updated successfully")</script>';
        header("Location: update_branch.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['branch_id'])) {
    $branch_id = $_GET['branch_id'];

    $sql = "SELECT * FROM branch WHERE branch_id='$branch_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Branch not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Branch</title>
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
    <h1>Edit Branch</h1>
    <form method="post" action="edit_branch.php">
        <input type="hidden" name="branch_id" value="<?php echo $row['branch_id']; ?>">
        <label for="branch_name">Branch Name</label>
        <input type="text" id="branch_name" name="branch_name" value="<?php echo $row['branch_name']; ?>" required>
        <input type="submit" value="Update Branch">
    </form>
</body>
</html>

<?php
$conn->close();
?>
