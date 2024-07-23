<?php
session_start();
include_once "dbConnection.php";
if (isset($_POST['submit'])) 
{
    $emp_id = $_POST['employeeId'];
    $password = $_POST['password'];
	$admin=mysqli_query($con, "SELECT * FROM admin WHERE admin_id='$emp_id'&&password='$password'");
	$result=mysqli_num_rows($admin);
	if($result==0)
	{
		$sql = mysqli_query($con, "SELECT * FROM user WHERE emp_id='$emp_id'&&password='$password'");
		$res = mysqli_num_rows($sql);
		if ($res > 0) 
		{
			$name='';
			while($row=mysqli_fetch_assoc($sql))
			{
				$name=$row['Name'];
			}
			$_SESSION['name']=$name;
			$_SESSION['emp_id']=$emp_id;
			echo '<script>alert("login Successful");</script>';
			header("location:about.php?");
		} 
		else 
		{
			echo '<script>alert("wrong"); window.location="index.php";</script>';
		}
	}
	else	
	{
		$name='';
		while($row=mysqli_fetch_assoc($admin))
		{
			$name=$row['Name'];
		}
		$_SESSION["name"] = $name;
		$_SESSION["key"] ='sunny7785068889';
		$_SESSION["emp_id"] = $emp_id;
		echo '<script>alert("Admin Logged in");</script>';
		header("location:index_admin.php");
	}
}
?>