<?php
include_once 'dbConnection.php';
date_default_timezone_set('Asia/Kolkata');
session_start();
$emp_id=$_SESSION['emp_id'];
$name=$_SESSION['name'];
//delete feedback
if(isset($_SESSION['key']))
{
	if(@$_GET['fdid'] && $_SESSION['key']=='sunny7785068889') 
	{
		$id=@$_GET['fdid'];
		$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
		header("location:dash.php?q=3");
	}
}

//delete user
if(isset($_SESSION['key']))
{
	if(@$_GET['demail'] && $_SESSION['key']=='sunny7785068889') 
	{
		$demail=@$_GET['demail'];
		$r1 = mysqli_query($con,"DELETE FROM ranks WHERE emp_id='$demail' ") or die('Error');
		$r2 = mysqli_query($con,"DELETE FROM old WHERE emp_id='$demail' ") or die('Error');
		$result = mysqli_query($con,"DELETE FROM user WHERE emp_id='$demail' ") or die('Error');
		header("location:dash.php?q=1");
	}
	if(@$_GET['path'])
	{
		$del_path=@$_GET['path'];
		$d1=mysqli_query($con,"DELETE FROM files where topic='$del_path'");
		header("location:dash.php?q=11");
	}
if (isset($_GET['q']) && $_GET['q'] == 2) {
        // Check if 'edit' parameter is present in GET request
        if (isset($_GET['edit'])) {
            $edit = $_GET['edit'];
            
            $empid = $_POST['empid'];
            $newname = $_POST['newname'];
            $design = $_POST['design'];
            $mail = $_POST['mail'];
            $contact = $_POST['contact'];

            // Use prepared statements to prevent SQL injection
            $stmt1 = $con->prepare("UPDATE user SET emp_id=?, Name=?, Designation=?, Mail_Id=?, Contact=? WHERE emp_id=?");
            $stmt1->bind_param("ssssss", $empid, $newname, $design, $mail, $contact, $edit);
            $stmt1->execute();

            $stmt2 = $con->prepare("UPDATE ranks SET emp_id=? WHERE emp_id=?");
            $stmt2->bind_param("ss", $empid, $edit);
            $stmt2->execute();

            $stmt3 = $con->prepare("UPDATE old SET emp_id=? WHERE emp_id=?");
            $stmt3->bind_param("ss", $empid, $edit);
            $stmt3->execute();

            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
			echo '<script>alert("Updated");
			location.href="dash.php?q=1";
			</script>;
            exit();';
        }
    }
}
if(isset($_SESSION['key']))
{
	if(@$_GET['q']== 'addemployee' && $_SESSION['key']=='sunny7785068889') 
	{
		$name=$_POST['name'];
		$empid=$_POST['empid'];
		$designation=$_SESSION['designation'];
		$mail=$_POST['mail'];
		$contact=$_POST['contact'];
		$in=mysqli_query($con,"insert into user values('','$empid','$name','$designation','$mail','$contact','welcome')");
		echo '<script>alert("added");
		location.href="dash.php?q=1";</script>';
	}
}
//remove quiz
if(isset($_SESSION['key']))
{
	if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='sunny7785068889') 
	{
		$eid=@$_GET['eid'];
		$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
		while($row = mysqli_fetch_array($result)) 
		{
			$qid = $row['qid'];
			$r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
			$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
		}
		$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
		$r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
		$r4 = mysqli_query($con,"DELETE FROM old WHERE eid='$eid' ") or die('Error');
		header("location:dash.php?q=5");
	}
}
//add quiz
if(isset($_SESSION['key']))
{
	if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='sunny7785068889') 
	{
		$name = $_POST['name'];
		$name= ucwords(strtolower($name));
		$total = $_POST['total'];
		$sahi = $_POST['right'];
		$wrong = $_POST['wrong'];
		$time = $_POST['time'];
		$id=uniqid();
		$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$time' , NOW())");
		header("location:dash.php?q=4&step=2&eid=$id&n=$total");
	}
}
if(isset($_SESSION['key']))
{
	if(@$_GET['q']=='addcont')
	{
		$topic=$_POST['topic'];
		$link=$_POST['link'];
		$c=mysqli_query($con,"insert into content values('$topic','$link')");
		header("location:dash.php?q=6");
	}
}

//add question
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addqns' && $_SESSION['key']=='sunny7785068889') {
$n=@$_GET['n'];
$eid=@$_GET['eid'];
$ch=@$_GET['ch'];

for($i=1;$i<=$n;$i++)
 {
 $qid=uniqid();
 $qns = mysqli_real_escape_string($con, $_POST['qns'.$i]); // Escape the question
$q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
  $oaid=uniqid();
  $obid=uniqid();
$ocid=uniqid();
$odid=uniqid();
$a = mysqli_real_escape_string($con, $_POST[$i.'1']); // Escape option a
$b = mysqli_real_escape_string($con, $_POST[$i.'2']); // Escape option b
$c = mysqli_real_escape_string($con, $_POST[$i.'3']); // Escape option c
$d = mysqli_real_escape_string($con, $_POST[$i.'4']); // Escape option d
$qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
$qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
$qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
$qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
$e=$_POST['ans'.$i];
switch($e)
{
case 'a':
$ansid=$oaid;
break;
case 'b':
$ansid=$obid;
break;
case 'c':
$ansid=$ocid;
break;
case 'd':
$ansid=$odid;
break;
default:
$ansid=$oaid;
}


$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

 }
header("location:dash.php?q=0");
}
}

/*quiz start

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    $eid = @$_GET['eid'];
    $sn = @$_GET['n'];
    $total = @$_GET['t'];
    $ans = $_POST['ans'];
    $qid = @$_GET['qid'];
    $emp_id = $_SESSION['emp_id'];  // Assuming emp_id is stored in the session

    // Fetch the correct answer for the question
    $q = mysqli_query($con, "SELECT * FROM answer WHERE qid='$qid'");
    $ansid = '';
    if ($row = mysqli_fetch_array($q)) {
        $ansid = $row['ansid'];
    }

    if ($ans == $ansid) {
        // Correct answer
        $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'");
        $sahi = 0;
        if ($row = mysqli_fetch_array($q)) {
            $sahi = $row['sahi'];
        }
        if ($sn == 1) {
            mysqli_query($con, "INSERT INTO old (emp_id, eid, score, sahi, wrong, level, date) VALUES ('$emp_id', '$eid', 0, 0, 0, 0, NOW())") or die(mysqli_error($con));
        }
        $q = mysqli_query($con, "SELECT * FROM old WHERE eid='$eid' AND emp_id='$emp_id'") or die(mysqli_error($con));
        $s = $r = 0;
        if ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
            $r = $row['sahi'];
        }
        $r++;
        $s += $sahi;
        mysqli_query($con, "UPDATE old SET score=$s, level=$sn, sahi=$r, date=NOW() WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
    } else {
        // Incorrect answer
        $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'") or die(mysqli_error($con));
        $wrong = 0;
        if ($row = mysqli_fetch_array($q)) {
            $wrong = $row['wrong'];
        }
        if ($sn == 1) {
            mysqli_query($con, "INSERT INTO old (emp_id, eid, score, sahi, wrong, level, date) VALUES ('$emp_id', '$eid', 0, 0, 0, 0, NOW())") or die(mysqli_error($con));
        }
        $q = mysqli_query($con, "SELECT * FROM old WHERE eid='$eid' AND emp_id='$emp_id'") or die(mysqli_error($con));
        $s = $w = 0;
        if ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
            $w = $row['wrong'];
        }
        $w++;
        $s -= $wrong;
        mysqli_query($con, "UPDATE old SET score=$s, level=$sn, wrong=$w, date=NOW() WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
    }

    if ($sn != $total) {
        $sn++;
        header("Location: account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total");
    } else {
        $q = mysqli_query($con, "SELECT score FROM old WHERE eid='$eid' AND emp_id='$emp_id'") or die(mysqli_error($con));
        $s = 0;
        if ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
        }
        $q1 = mysqli_query($con, "SELECT * FROM ranks WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
        if (mysqli_num_rows($q1) == 0) {
            mysqli_query($con, "INSERT INTO ranks (emp_id, score, time, eid) VALUES ('$emp_id', '$s', NOW(), '$eid')") or die(mysqli_error($con));
        } else {
            mysqli_query($con, "UPDATE ranks SET score=$s, time=NOW() WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
        }
        header("Location: account.php?q=result&eid=$eid");
    }
}*/
function process_question($eid, $sn, $total, $ans, $qid, $con, $emp_id) {
    // Fetch the correct answer
    $q = mysqli_query($con, "SELECT * FROM answer WHERE qid='$qid'");
    $ansid = '';
    if ($row = mysqli_fetch_array($q)) {
        $ansid = $row['ansid'];
    }
    
    // Check if the answer is correct
    if ($ans == $ansid) {
        // Correct answer logic
        $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'");
        $sahi = 0;
        if ($row = mysqli_fetch_array($q)) {
            $sahi = $row['sahi'];
        }
        
        if ($sn == 1) {
            mysqli_query($con, "INSERT INTO old (emp_id, eid, score, sahi, wrong, level, date) VALUES ('$emp_id', '$eid', 0, 0, 0, 0, NOW())") or die(mysqli_error($con));
        }
        
        $q = mysqli_query($con, "SELECT * FROM old WHERE eid='$eid' AND emp_id='$emp_id'") or die(mysqli_error($con));
        $s = $r = 0;
        if ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
            $r = $row['sahi'];
        }
        $r++;
        $s += $sahi;
        mysqli_query($con, "UPDATE old SET score=$s, level=$sn, sahi=$r, date=NOW() WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
    } else {
        // Incorrect or unanswered question logic
        $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'") or die(mysqli_error($con));
        $wrong = 0;
        if ($row = mysqli_fetch_array($q)) {
            $wrong = $row['wrong'];
        }
        
        if ($sn == 1) {
            mysqli_query($con, "INSERT INTO old (emp_id, eid, score, sahi, wrong, level, date) VALUES ('$emp_id', '$eid', 0, 0, 0, 0, NOW())") or die(mysqli_error($con));
        }
        
        $q = mysqli_query($con, "SELECT * FROM old WHERE eid='$eid' AND emp_id='$emp_id'") or die(mysqli_error($con));
        $s = $w = 0;
        if ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
            $w = $row['wrong'];
        }
        $w++;
        $s -= $wrong;
        mysqli_query($con, "UPDATE old SET score=$s, level=$sn, wrong=$w, date=NOW() WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
    }
}

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    $eid = @$_GET['eid'];
    $sn = @$_GET['n'];
    $total = @$_GET['t'];
    $ans = isset($_POST['ans']) ? $_POST['ans'] : '';
    $qid = @$_GET['qid'];
    $emp_id = $_SESSION['emp_id'];  // Assuming emp_id is stored in the session

    process_question($eid, $sn, $total, $ans, $qid, $con, $emp_id);

    if ($sn != $total) {
        $sn++;
        header("Location: account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total");
    } else {
        $q = mysqli_query($con, "SELECT score FROM old WHERE eid='$eid' AND emp_id='$emp_id'") or die(mysqli_error($con));
        $s = 0;
        if ($row = mysqli_fetch_array($q)) {
            $s = $row['score'];
        }
        $q1 = mysqli_query($con, "SELECT * FROM ranks WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
        if (mysqli_num_rows($q1) == 0) {
            mysqli_query($con, "INSERT INTO ranks (emp_id, score, time, eid) VALUES ('$emp_id', '$s', NOW(), '$eid')") or die(mysqli_error($con));
        } else {
            mysqli_query($con, "UPDATE ranks SET score=$s, time=NOW() WHERE emp_id='$emp_id' AND eid='$eid'") or die(mysqli_error($con));
        }
        header("Location: account.php?q=result&eid=$eid");
}
}



//restart quiz
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) 
{
	$eid=@$_GET['eid'];
	$n=@$_GET['n'];
	$t=@$_GET['t'];
	$q=mysqli_query($con,"SELECT score FROM old WHERE eid='$eid' AND emp_id='$emp_id'" )or die('Error156');
	while($row=mysqli_fetch_array($q) )
	{
		$s=$row['score'];
	}
	$q=mysqli_query($con,"DELETE FROM old WHERE eid='$eid' AND emp_id='$emp_id' " )or die('Error184');
	$q=mysqli_query($con,"SELECT * FROM ranks WHERE emp_id='$emp_id' and eid='$eid'" )or die('Error161');
	while($row=mysqli_fetch_array($q) )
	{
		$sun=$row['score'];
	}
	$sun=$sun-$s;
	$q=mysqli_query($con,"UPDATE ranks SET score=$sun ,time=NOW() WHERE emp_id= '$emp_id' and eid='$eid'")or die('Error174');
	header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}
?>