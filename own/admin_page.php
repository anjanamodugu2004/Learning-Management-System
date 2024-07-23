<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Anjana@1304";
$dbname = "travel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Travel Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet"
  />
  <link href="admin_page.css" rel="stylesheet"/>
</head>
<body>
<header>
    <div class="side-header">
        <img src="APCOB_logo.jpeg" alt="APCOB logo">
        <div class="header-text">
            <h1>The Andhra Pradesh State Cooperative Bank Ltd.</h1>
            <h2>(A State Partnered Scheduled Bank)</h2>
        </div>
    </div>
</header>
<div class="sidebar">
    <h1>Dashboard</h1>
    <ul>
        <li><a href="#" onclick="showSection('employee-details-types')">Employee Details</a></li>
        <li><a href="#" onclick="showSection('question-details')">Question Details</a></li>
        <li><a href="#" onclick="showSection('branch-details')">Branch Details</a></li>
        <li><a href="#" onclick="showSection('department-details')">Department Details</a></li>
    </ul>
</div>

<div class="content">
    <!-- Employee Details Types Section -->
    <div class="dashboard-item hidden" id="employee-details-types">
        <h2>Employee Details Types</h2>
        <button onclick="showSection('branch-wise')">Branch Wise</button>
        <button onclick="showSection('department-wise')">Department Wise</button>
    </div>
    <!-- Branch Wise Details Section -->
    <div class="dashboard-item hidden" id="branch-wise">
        <h2>Branch Wise Details</h2>
        <button onclick="window.location.href='update_employee_branch.php'">Edit Existing Employee</button>
        <button onclick="window.location.href='insert_employee_branch.php'">Add New Employee</button>
    </div>
    <!-- Department Wise Details Section -->
    <div class="dashboard-item hidden" id="department-wise">
        <h2>Department Wise Details</h2>
        <button onclick="window.location.href='update_employee_department.php'">Edit Existing Employee</button>
        <button onclick="window.location.href='insert_employee_department.php'">Add New Employee</button>
    </div>
    <!-- Question Details Section -->
    <div class="dashboard-item hidden" id="question-details">
        <h2>Question Details</h2>
        <button onclick="window.location.href='update_question.php'">Edit Existing Question</button>
        <button onclick="window.location.href='insert_question.php'">Add New Question</button>
    </div>
    <!-- Branch Details Section -->
    <div class="dashboard-item hidden" id="branch-details">
        <h2>Branch Details</h2>
        <button onclick="window.location.href='update_branch.php'">Edit Existing Branch</button>
        <button onclick="window.location.href='insert_branch.php'">Add New Branch</button>
    </div>
     <!-- Department Details Section -->
     <div class="dashboard-item hidden" id="department-details">
        <h2>Department Details</h2>
        <button class="delete-button" onclick="window.location.href='update_department.php'">Delete Existing Department</button>
        <button onclick="window.location.href='insert_department.php'">Add New Department</button>
    </div>
</div>

<script>
    function showSection(sectionId) {
        var sections = document.querySelectorAll('.dashboard-item');
        sections.forEach(function (section) {
            section.classList.add('hidden');
        });
        document.getElementById(sectionId).classList.remove('hidden');
    }

    document.getElementById('search').addEventListener('keyup', function () {
        var filter = this.value.toUpperCase();
        var rows = document.querySelector("#request-details table").rows;
        for (var i = 1; i < rows.length; i++) {
            var requestId = rows[i].cells[0].textContent.toUpperCase();
            var empId = rows[i].cells[1].textContent.toUpperCase();
            if (requestId.indexOf(filter) > -1 || empId.indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
        
           
</script>
<footer>
    <p>Copyright &copy; 2024 APCOB. Powered by SR Solutions | Terms & Conditions | FAQ</p>
</footer>
</body>
</html>

<?php
$conn->close();
?>
