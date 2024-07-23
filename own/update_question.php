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

$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question Details</title>
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

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: #007f3f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px 0;
        }

        button:hover {
            background-color: #00532b;
        }

        .delete-button {
            background-color: #F46444;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px 0;
        }

        .delete-button:hover {
            background-color: red;
        }

        .search-container {
            margin-top: 20px;
            text-align: center;
        }

        .search-container input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-container button {
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <h1>Edit Question Details</h1>
    <div class="search-container">
        <form method="post" action="">
            <input type="text" name="search" placeholder="Search by Question or Department" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <table>
        <tr>
            <th>Question ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Links</th>
            <th>Department</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $sql = "SELECT * FROM questions WHERE question LIKE '%$search%' OR department_name LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['sl_no'] . "</td>";
                echo "<td>" . $row['question'] . "</td>";
                echo "<td>" . $row['answer'] . "</td>";
                echo "<td>" . $row['links'] . "</td>";
                echo "<td>" . $row['department_name'] . "</td>";
                echo "<td><button onclick=\"window.location.href='edit_question.php?sl_no=" . $row['sl_no'] . "'\">Edit</button></td>";
                echo "<td><button class='delete-button' onclick=\"window.location.href='delete_question.php?sl_no=" . $row['sl_no'] . "'\">Delete</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No questions found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
