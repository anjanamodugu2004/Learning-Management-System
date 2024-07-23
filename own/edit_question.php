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
    $sl_no = $_POST['sl_no'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $links = $_POST['links'];
    $department_name = $_POST['department_name'];
    $sql = "UPDATE questions SET question='$question', answer='$answer', links='$links', department_name='$department_name' WHERE sl_no='$sl_no'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to update_employee.php
        echo '<script>alert(" Question Updated successfully")</script>';
        header("Location: update_question.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['sl_no'])) {
    $sl_no = $_GET['sl_no'];

    $sql = "SELECT * FROM questions WHERE sl_no='$sl_no'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Question not found";
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
    <form method="post" action="edit_question.php">
        <input type="hidden" name="sl_no" value="<?php echo $row['sl_no']; ?>">
        <label for="question">Question</label>
        <input type="text" id="question" name="question" value="<?php echo $row['question']; ?>" required>
        <label for="answer">Answer</label>
        <input type="text" id="answer" name="answer" value="<?php echo $row['answer']; ?>" >
        <label for="links">Links</label>
        <input type="text" id="links" name="links" value="<?php echo $row['links']; ?>" >
        <label for="department_name">Department_name</label>
        <input type="text" id="department_name" name="department_name" value="<?php echo $row['department_name']; ?>" required>
        <input type="submit" value="Update Employee">
    </form>
</body>
</html>

<?php
$conn->close();
?>
