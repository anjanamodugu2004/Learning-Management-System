<?php
include "dbConnection.php";
session_start();
?>
<?php
/*if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$filename='';
	$filesize='';
	$filetype='';
	$topic='';
	$link='';
	$description='';
	$topic=$_POST['topic'];
	$link=$_POST['link'];
	$description=$_POST['description'];
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) 
	{
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($file_type, $allowed_types)) 
		{
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
			$con->close();
        } 
		else 
		{
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
			{
                // File upload success, now store information in the database
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];
			}
			else 
			{
                echo "Sorry, there was an error uploading your file and storing information in the database: " . $con->error;
				$con->close();
            }
            // Insert the file information into the database
			//$sql = "INSERT INTO files (filename, filesize, filetype,topic,description,link) VALUES ('$filename', $filesize, '$filetype','$topic','$description','$link')";
			   $sql = "INSERT INTO files (topic, description, link, filename, filesize, filetype) VALUES ('$topic', '$description', '$link', '$filename', $filesize, '$filetype')";
            if ($con->query($sql) === TRUE) 
			{
                echo "<script>alert('Done');
				location.href='dash.php?q=6';
				</script>";
            } 
			else 
			{
                echo "Sorry, there was an error uploading your file.";
            }
			$con->close();
        }
    }
}*/

if ($_SERVER["REQUEST_METHOD"] == "POST"&&@$_GET['q']==6) {
    $topic = $_POST['topic'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $filename = $filesize = $filetype = '';

    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
            exit;
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        }
    }

    // Insert the file information into the database
    //$sql = "INSERT INTO files (topic, description, link, filename, filesize, filetype) VALUES ('$topic', '$description', '$link', '$filename', $filesize, '$filetype')";
	$sql = "INSERT INTO files (filename, filesize, filetype,topic,description,link) VALUES ('$filename', '$filesize', '$filetype','$topic','$description','$link')";
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Done'); location.href='dash.php?q=6';</script>";
    } else {
        echo "Sorry, there was an error uploading your file and storing information in the database: " . $con->error;
    }
    $con->close();
}
if (@$_GET['q'] == "add_img") {
    $emp_id = $_SESSION['emp_id']; // Ensure emp_id is retrieved from a secure source like a session

    if (isset($_FILES['addimg']) && $_FILES['addimg']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['addimg']['tmp_name'];
        $fileName = $_FILES['addimg']['name'];
        $fileSize = $_FILES['addimg']['size'];
        $fileType = $_FILES['addimg']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitize file name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Check if the file has a valid extension
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Directory in which the uploaded file will be moved
            $uploadFileDir = './uploaded_images/';
            $dest_path = $uploadFileDir . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update the database
                $sql = "UPDATE user SET image='$newFileName' WHERE emp_id='$emp_id'";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    echo 'echo "<script>alert("Done"); location.href="account.php?q=0";</script>";';
                } else {
                    echo 'Error updating database.';
                }
            } else {
                echo 'There was some error moving the file to upload directory.';
            }
        } else {
            echo 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        echo 'There was some error with the file upload.';
}
}

?>