<?php 
include "dbConnection.php";
session_start();
if(!(isset($_SESSION['emp_id'])))
	{
		header("location:index.php");
	}
	else
	{
		$name=$_SESSION['name'];
		$emp_id=$_SESSION['emp_id'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>APCOB</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <header>

        <div class="logosec">
            <div class="logo"><img src="image/logo1.png" height="100px"></div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>

        
		<?php
  // Initialize the search variable
  $searchValue = '';
  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
    if (isset($_POST['Submit'])) 
    {
      $searchValue = htmlspecialchars($_POST['search']);
    }
  }
  // Get the current section
  $currentSection = isset($_GET['q']) ? (int)$_GET['q'] : 1;
  if(@$_GET['q']!=3)
  {
  ?>
  <form class="navbar-form navbar-left" role="search" method="POST">
    <div class="searchbar">
      <input type="text" name="search" id="search" placeholder="Search here" value="<?php echo $searchValue; ?>" autocomplete="off">
	        <div class="searchbtn">
              <button type="submit" name="Submit"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpSKVCTGwmkgMZgEIFxMXbERLFYm6CqTcXkw&s" class="icn srchicn" alt="search-icon"></button>
              </div>
    </div>
  </form>	
             <?php
  }
  ?>

        <div class="message">
		<?php echo 'Hello,<a href="account.php?q=1">'.$name .'</a>'?>
            <div class="dp">
              <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp">
              </div>
        </div>

    </header>
    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
    <div class="nav-option option1 <?php echo (@$_GET['q'] == 0) ? 'active' : ''; ?>">
        <img src="https://cdn-icons-png.flaticon.com/512/9246/9246903.png" class="nav-img" alt="dashboard">
        <h4><a href="dash.php?q=0" class="nav-link">Dashboard</a></h4>
    </div>

    <div class="option2 nav-option <?php echo (@$_GET['q'] == 1) ? 'active' : ''; ?>">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6Qe09LU0zQH2VclKJRCAPdNm2WlOx6YwDEA&s" class="nav-img" alt="articles">
        <h4><a href="dash.php?q=1" class="nav-link">User</a></h4>
    </div>

    <div class="nav-option option3 <?php echo (@$_GET['q'] == 3) ? 'active' : ''; ?>">
        <img src="https://icones.pro/wp-content/uploads/2022/01/icone-de-commentaires-verte.png" class="nav-img" alt="blog">
        <h4><a href="dash.php?q=3">Feedback</a></h4>
    </div>

    <div class="nav-option option4 <?php echo (@$_GET['q'] == 2) ? 'active' : ''; ?>">
        <img src="https://t4.ftcdn.net/jpg/02/80/52/45/360_F_280524501_n8tEztMk79KV6be1etcvNyx9UJYL1o6e.jpg" class="nav-img" alt="settings">
        <h4><a href="dash.php?q=2" class="nav-link">Rank</a></h4>
    </div>

    <div class="nav-option option5 <?php echo (@$_GET['q'] == 7) ? 'active' : ''; ?>">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGpxSXuJn5MfFiD7eSx8J3HBdo_6H5impxyg&s" class="nav-img" alt="settings">
        <h4><a href="dash.php?q=7" class="nav-link">Results</a></h4>
    </div>

    <div class="nav-option option6 <?php echo (@$_GET['q'] == 8) ? 'active' : ''; ?>">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Green_pencil.svg/600px-Green_pencil.svg.png" class="nav-img" alt="settings">
        <h4><a href="dash.php?q=8">Quiz</a></h4>
    </div>

    <div class="nav-option logout">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSISHJ9o6juNl7ILLWu8GUtCSWn4sDHurYvA&s" class="nav-img" alt="logout">
        <h3><a href="index_admin.php">Logout</a></h3>
 </div>
</div>

            </nav>
        </div>
<div class="main">
<?php 
if(@$_GET['q'] == 0) 
{
  if(isset($_POST['Submit']))
  {
    $search = htmlspecialchars($_POST['search']);
    $result = mysqli_query($con,"SELECT * FROM quiz where title LIKE '%$search%' ORDER BY date DESC") or die('Error');
  }
  else
  {
    $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
  }
  echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
  <tr style="color:green"><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td></tr>';
  $c=1;
  while($row = mysqli_fetch_array($result)) 
  {
    $title = $row['title'];
    $total = $row['total'];
    $sahi = $row['sahi'];
    $eid = $row['eid'];
    $q12=mysqli_query($con,"SELECT score FROM old WHERE eid='$eid' AND emp_id='$emp_id'" )or die('Error98');
    $rowcount=mysqli_num_rows($q12);  
    if($rowcount == 0)
    {
      echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td></tr>';
	}
    else
    {
      echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td></tr>';
    }
  }
  $c=0;
  echo '</table></div></div>';
}
//ranking start
if(@$_GET['q'] == 2) 
{
    if(isset($_POST['Submit']))
    {
        $search = htmlspecialchars($_POST['search']);
        // Ensuring it considers all quizzes by summing up the scores.
        $q = mysqli_query($con, "SELECT emp_id, SUM(score) as sc FROM ranks WHERE emp_id LIKE '%$search%' GROUP BY emp_id ORDER BY sc DESC");
    }
    else
    {
        // Ensuring it considers all quizzes by summing up the scores.
        $q = mysqli_query($con, "SELECT emp_id, SUM(score) as sc FROM ranks GROUP BY emp_id ORDER BY sc DESC"); 
    }
    
    echo '<div><div>
    <table>
    <tr style="color:green"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Employee Id</b></td><td><b>Score</b></td></tr>';
    
    $c = 0;
    while($row = mysqli_fetch_array($q)) 
    {
        $e = $row['emp_id'];
        $s = $row['sc'];
        $sql = mysqli_query($con, "SELECT Name FROM user WHERE emp_id = '$e'");
        while($r1 = mysqli_fetch_array($sql))
        {
            $na = $r1['Name'];
        }
        $c++;
        echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$na.'</td><td>'.$e.'</td><td>'.$s.'</td></tr>';
    }
    echo '</table></div></div>';
}

?>
<!--home closed-->
<!--users start-->
<?php 
if(@$_GET['q']==1)
{
  if(isset($_POST['Submit']))
  {
    $search = htmlspecialchars($_POST['search']);
    $result=mysqli_query($con,"select * from user where emp_id LIKE '%$search%' or Name LIKE '%$search%'");
  }
  else
  {
    $result = mysqli_query($con,"SELECT * FROM user") or die('Error');
  }
  echo '<form method="POST" action="dash.php?q=1">
    <button type="submit" name="addSubmit" style="background-color:yellow;">
      <span aria-hidden="true"></span>&nbsp;Add New Employee
    </button>
</form>
<br><br>';
  if(isset($_POST['addSubmit']))
  {
    echo '<form action="update.php?q=addemployee" method="POST">
    <div align="center"><h2>Enter employee details here</h2><br>
    <center><table cellpadding="10px" style="border-collapse: collapse; width: 90%; margin: auto; font-family: Arial, sans-serif;">
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #2f2f2;"><b>Name: </b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="name" id="name" style="width: 100%; padding: 5px;" required></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Employee Id:</b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="empid" id="empid" style="width: 100%; padding: 5px;" required></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Designation: </b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="designation" id="designation" style="width: 100%; padding: 5px;" required></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Mail: </b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="mail" id="mail" style="width: 100%; padding: 5px;" required></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Contact: </b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="contact" id="contact" style="width: 100%; padding: 5px;" required></td>
    </tr>
    </table>
    <input type="submit" value="Add" name="add">
    </form>
    </div>';
  }
  else
  {
    echo  '<div class="panel"><div><table>
    <tr style="color:green"><td><b>S.N.</b></td><td><b>Name</b></td><td><b>Employee_id</b></td><td><b>Designation</b></td><td><b>Mobile</b></td><td colspan="2"><b>Options</b></td></tr>';
    $c=1;
    while($row = mysqli_fetch_array($result)) 
    {
      $emp_id = $row['emp_id'];
      echo '<tr><td>'.$c++.'</td><td>'.$row['Name'].'</td><td>'.$emp_id.'</td><td>'.$row['Designation'].'</td><td>'.$row['Contact'].'</td><td><a title="Delete User" href="update.php?demail='.$emp_id.'"><b>
	  <img src="https://w7.pngwing.com/pngs/127/865/png-transparent-computer-icons-rubbish-bins-waste-paper-baskets-recycling-bin-garbage-miscellaneous-text-recycling.png" class="nav-img"></a></td>
	  <td><a title="Edit User" href="dash.php?edit='.$emp_id.'&q=12"><b>
	  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_XFLSbCXQ-wc07bW5suka0TWtKHTOo7Ghrw&s" class="nav-img"</b></a></td></tr>';
    }
    $c=0;
    echo '</table></center></div></div>';
  }
}
if (isset($_GET['edit'])&&@$_GET['q']==12) {
        $edit = $_GET['edit'];
        
        // Use prepared statement to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM user WHERE emp_id = ?");
        $stmt->bind_param("s", $edit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $name = '';
        $Designation = '';
        $Mail_Id = '';
        $Contact = '';

        while ($row = $result->fetch_assoc()) {
            $name = $row['Name'];
            $Designation = $row['Designation'];
            $Mail_Id = $row['Mail_Id'];
            $Contact = $row['Contact'];
        }
        $stmt->close();
        ?>

        <form action="update.php?q=2&edit=<?php echo $edit; ?>" method="POST">
            <div align="center">
                <h2>Enter employee details here</h2><br>
                <table cellpadding="10px" style="border-collapse: collapse; width: 50%; margin: auto; font-family: Arial, sans-serif;">
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Name: </b></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="newname" id="newname" value="<?php echo htmlspecialchars($name); ?>" style="width: 100%; padding: 5px;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Employee Id:</b></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="empid" id="empid" value="<?php echo htmlspecialchars($edit); ?>" style="width: 100%; padding: 5px;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Designation: </b></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="design" id="design" value="<?php echo htmlspecialchars($Designation); ?>" style="width: 100%; padding: 5px;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Mail: </b></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="mail" id="mail" value="<?php echo htmlspecialchars($Mail_Id); ?>" style="width: 100%; padding: 5px;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Contact: </b></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($Contact); ?>" style="width: 100%; padding: 5px;"></td>
                    </tr>
                </table>
                <input type="submit" value="Update">
            </div>
        </form>
        <?php
    }
?>
<!--user end-->

<!--feedback start-->
<?php if(@$_GET['q']==3) 
{
	$result = mysqli_query($con,"SELECT * FROM feedback ORDER BY feedback.date DESC") or die('Error');
	echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
	<tr style="color:green"><td><b>S.No.</b></td><td><b>Subject</b></td><td><b>Employee_id</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>By</b></td><td><b>see feedback</b></td><td><b>close feedback</b></td></tr>';
	$c=1;
	while($row = mysqli_fetch_array($result)) 
	{
		$date = $row['date'];
		$date= date("d-m-Y",strtotime($date));
		$time = $row['time'];
		$subject = $row['subject'];
		$name = $row['name'];
		$emp_id = $row['emp_id'];
		$id = $row['id'];
		echo '<tr><td>'.$c++.'</td>';
		echo '<td>'.$subject.'</td><td>'.$emp_id.'</td><td>'.$date.'</td><td>'.$time.'</td><td>'.$name.'</td>
		<td><a title="Open Feedback" href="dash.php?q=3&fid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true">
		<img src="https://cdn-icons-png.freepik.com/512/12340/12340343.png" class="nav-img"></span></b></a></td>';
		echo '<td><a title="Delete Feedback" href="update.php?fdid='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true">
		<img src="https://w7.pngwing.com/pngs/127/865/png-transparent-computer-icons-rubbish-bins-waste-paper-baskets-recycling-bin-garbage-miscellaneous-text-recycling.png" class="nav-img"></span></b></a></td>
		</tr>';
	}
	echo '</table></div></div>';
}
?>
<!--feedback closed-->

<!--feedback reading portion start-->
<?php if(@$_GET['fid']) 
{
	echo '<br />';
	$id=@$_GET['fid'];
	$result = mysqli_query($con,"SELECT * FROM feedback WHERE id='$id' ") or die('Error');
	while($row = mysqli_fetch_array($result)) 
	{
		$name = $row['name'];
		$subject = $row['subject'];
		$date = $row['date'];
		$date= date("d-m-Y",strtotime($date));
		$time = $row['time'];
		$feedback = $row['feedback'];
		echo '<div><a title="Back to Archive" href="update.php?q1=2"><b><span aria-hidden="true"></span></b></a><h2 style="color:white;text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$subject.'</b></h1>';
		echo '<div data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;color:white;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>&nbsp;'.$date.'</span>
		<span style="line-height:35px;padding:5px;color:white">&nbsp;<b>Time:</b>&nbsp;'.$time.'</span><span style="color:white;line-height:35px;padding:5px;">&nbsp;<b>By:</b>&nbsp;'.$name.'</span><br />'.$feedback.'</div></div>';
	}
}
?>
<!--Feedback reading portion closed-->

<!--add quiz start-->
<?php
if(@$_GET['q']==4 && !(@$_GET['step'])) 
{
	echo '<span style="margin-left:40%;font-size:30px;color:white;"><b>Enter Quiz Details</b></span><br /><br/>
	<form name="form" action="update.php?q=addquiz"  method="POST" autocomplete="off">
	<fieldset>
  <table><tr><td>Quiz title</td><td><input id="name" name="name" placeholder="Enter Quiz title" type="text"></td></tr>
    
  <tr><td>Total number of Questions</td><td><input id="total" name="total" placeholder="Enter total number of questions" type="number"></td></tr>
    
  <tr><td>Marks on right answer</td><td><input id="right" name="right" placeholder="Enter marks on right answer" min="0" type="number" required></td></tr>
  <tr><td>Marks on wrong answer</td><td><input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" min="0" type="number" required></td></tr>
  <tr><td>Enter time</td><td><input id="time" name="time" placeholder="enter time" required></td></tr>
    <tr><center><td colspan="2"><input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/></td></center></tr></table>

</fieldset>
</form>';



}
?>
<!--add quiz end-->

<!--add quiz step2 start-->
<?php
if(@$_GET['q']==4 && (@$_GET['step'])==2 ) 
{
	echo ' 
	<div class="row">
	<span class="title1" style="margin-left:40%;font-size:30px; color:white;"><b>Enter Question Details</b></span><br /><br />
	<div class="col-md-3"></div><div class="col-md-6" style="color:white;"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
	<fieldset>';
	for($i=1;$i<=@$_GET['n'];$i++)
	{
		echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="6" cols="50" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
  <div class="col-md-12">
  <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
  <div class="col-md-12">
  <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
  <div class="col-md-12">
  <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
  <div class="col-md-12">
  <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
    
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
   <option value="a">Select answer for question '.$i.'</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />'; 
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>
</fieldset>
</form></div></div>';
}
?><!--add quiz step 2 end-->

<!--remove quiz-->
<?php 
if(@$_GET['q']==5) 
{
	$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
	echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
	<tr style="color:green"><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
	$c=1; 
	while($row = mysqli_fetch_array($result)) 
	{
		$title = $row['title'];
		$total = $row['total'];
		$sahi = $row['sahi'];
		$time = $row['time'];
		$eid = $row['eid'];
		echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
		<td><b><a href="update.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
	}
	$c=0;
	echo '</table></div></div>';
}
?>

<?php if(@$_GET['q']==6) 
{
	echo '	
	<div>
    <h2 style="color:white">Upload a file</h2>
    <form action="upload.php?q=6" method="POST" enctype="multipart/form-data">
        <table style="color:black">
            <tr><td>Enter topic</td>
            <td><textarea type="text" name="topic" id="topic" placeholder="Enter topic name" rows="4" cols="50" required></textarea></td></tr>
		<tr><td>Description</td>
            <td><textarea type="textarea" name="description" id="description" placeholder="Description here" rows="4" cols="50"></textarea></td></tr>
			<tr>
            <td>Enter link </td>
            <td><textarea id="link" name="link" placeholder="paste link here" type="url" rows="4" cols="50"></textarea></td></tr>
			<tr><td>Select file</td>
            <td><input type="file" name="file" id="file" rows="4" cols="50"></textarea></td></tr>
        <tr><td colspan="2"><button type="submit" name="submit" class="btn btn-primary">Upload</button></td></tr></table>
    </form>
</div>
';
}
if(@$_GET['q'] == 7) {
  
  // Fetch topics
  if(isset($_POST['Submit']))
  {
    $search = htmlspecialchars($_POST['search']);
    $topicsQuery=mysqli_query($con,"select * from quiz where title LIKE '%$search%'");
  }
  else
  {
  $topicsQuery = mysqli_query($con, "SELECT DISTINCT title, eid FROM quiz") or die('Error fetching quiz titles');
  }
  echo '<div class="container">';
  echo '<h2 class="text-center mb-4" style="color:white">Available Quizzes</h2>';
  echo '<div class="row">';
  
  while($topicRow = mysqli_fetch_array($topicsQuery)) 
  {
    $title = $topicRow['title'];
    $eid = $topicRow['eid'];
    echo '<div class="col-md-4 mb-4">'; // Changed mb-3 to mb-4 for more vertical space
    echo '<a href="update.php?eid=' . $eid . '" class="quiz-box">';
    echo '<div class="card h-100">';
    echo '<div class="card-body d-flex align-items-center justify-content-center">';
    echo '<h5 class="card-title text-center"><a href="dash.php?q=10&&eid='.$eid.'" target=" ">'.$title . '</a></h5>';
    echo '</div>';
    echo '</div>';
    echo '</a>';
    echo '</div>';
  }
}
if(@$_GET['q']==11)
{
	if(isset($_POST['Submit']))
	{
		$search = htmlspecialchars($_POST['search']);
		$sql= mysqli_query($con,"SELECT * FROM files where topic LIKE '%$search%'") or die('Error');
	}
	else
	{
		$sql = mysqli_query($con, "SELECT filename,topic, Description,link FROM files"); // Assuming the column is filename
	}
    $res = mysqli_num_rows($sql); 
    if ($res > 0) 
	{
        echo '<table border="1" class="table table-bordered" style="background-color:white !important;"><tr style="color:green"><th>Topic</th><th>Description</th><th>Download</th><th>Link</th><th>Delete</th></tr>';
        while ($row = mysqli_fetch_assoc($sql)) 
		{
            $file_path = "uploads/" . $row['filename'];
            echo '<tr><td>' . $row['topic'] . '</td><td>'.$row['Description'] . '</td><td><a href="' . $file_path . '" class="btn btn-primary" download>Download</a></td><td><a href="$row[link]" target="_blank">'.$row['link'].'</a></td><td><a href="update.php?path='.$row['topic'].'">
			<img src="https://w7.pngwing.com/pngs/127/865/png-transparent-computer-icons-rubbish-bins-waste-paper-baskets-recycling-bin-garbage-miscellaneous-text-recycling.png" class="nav-img"></td></tr>';
        }
        echo '</table>';
    } 
	else 
	{
        echo '<p>No files uploaded yet.</p>';
    }
}
if (@$_GET['q'] == 8) {
    echo '<div class="content-section">
        <div class="boxes">
            <i class="bx bx-plus-circle box-icon"></i>
            <h2><a href="dash.php?q=4">Add Quiz</a></h2>
        </div>
        <div class="boxes">
            <i class="bx bx-minus-circle box-icon"></i>
            <h2><a href="dash.php?q=5">Remove Quiz</a></h2>
        </div>
        <div class="boxes">
            <i class="bx bx-upload box-icon"></i>
            <h2><a href="dash.php?q=6">Upload Content</a></h2>
        </div>
        <div class="boxes">
            <i class="bx bx-trash box-icon"></i>
            <h2><a href="dash.php?q=11">Remove Content</a></h2>
        </div>
    </div>';
}
  if(@$_GET['q']==10)
	{
		$eid=@$_GET['eid'];
		$r=mysqli_query($con,"select * from ranks natural join user where eid='$eid' order by score desc");
		echo '<table border="1"><tr><td><b>Name</b></td><td><b>Designation</b></td><td><b>Score</b></td></tr>';
		while($row=mysqli_fetch_array($r))
		{
			$name=$row['Name'];
			$Designation=$row['Designation'];
			$score=$row['score'];
			echo '<tr><td>'.$name.'</td><td>'.$Designation.'</td><td>'.$score.'</td></tr>';
		}
		echo '</table>';
	}
  
  echo '</div>'; // Close row
  echo '</div>'; // Close container
?>


<style>
.quiz-box {
  display: block;
  text-decoration: none;
  color: inherit;
  transition: transform 0.3s;
}

.quiz-box:hover {
  transform: scale(1.05);
  text-decoration: none;
  color: inherit;
}

.card {
  height: 100px; 
  width:400px;
  border: 2px solid #007bff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  background-color: transparent;
  position: relative;
  overflow: hidden;
  padding-bottom:20px;
}

.card:hover {
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

.card-body {
  background-color: rgba(255, 255, 255, 0.7); 
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 10px;
}

.card-title {
  margin: 0;
  font-weight: bold;
}

/* Add this if you want to add a background image */
.card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: url('https://media.istockphoto.com/id/1219872152/vector/abstract-creative-background.jpg?s=612x612&w=0&k=20&c=hqNERUEmT9KgPCis9ZvaxemOSfFWR-oKPe3PA-nFjkY=');
  background-size: cover;
  background-position: center;
  opacity:0.3;
}
</style>
</div>
    <script src="./index.js"></script>
</body>
</html>