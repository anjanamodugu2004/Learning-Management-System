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
<style>
.active
{
	color:white;
	background-color:green;
}
</style>
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
    if (isset($_POST['submit'])) 
    {
      $searchValue = htmlspecialchars($_POST['search']);
    }
  }
  // Get the current section
  $currentSection = isset($_GET['q']) ? (int)$_GET['q'] : 1;
  if(@$_GET['q']!=5&&@$_GET['q']!=0)
  {
  ?>
  <form class="navbar-form navbar-left" role="search" method="POST">
    <div class="searchbar">
      <input type="text" name="search" id="search" placeholder="Search here" value="<?php echo $searchValue; ?>" autocomplete="off">
	        <div>
              <button type="submit" name="submit"><img src="image/search.jpg" class="icn srchicn" alt="search-icon"></button>
              </div>
    </div>
  </form>	
             <?php
  }
  ?>
		<div class="message">
    <i><?php echo 'Hello <a href="account.php?q=1">' . $name . '</a>'?></i>
    <div class="dp">
        <?php
        $s = mysqli_query($con, "SELECT image FROM user WHERE emp_id='$emp_id'");
        $img = '';
        while ($re = mysqli_fetch_assoc($s)) {
            $img = "uploaded_images/" . $re['image'];
        }
        ?>
        <img src="<?php echo $img; ?>" class="dpicn" alt="dp">
    </div>
</div>

    </header>
    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
			<div class="nav-upper-options">
    <div class="nav-option option1 <?php if (@$_GET['q'] == 0) echo 'active'; ?>">
        <img src="https://cdn-icons-png.flaticon.com/512/9246/9246903.png" class="nav-img" alt="dashboard">
        <h4><a href="account.php?q=0">Dashboard</a></h4>
    </div>

    <div class="nav-option option2 <?php if (@$_GET['q'] == 1) echo 'active'; ?>">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Green_pencil.svg/600px-Green_pencil.svg.png" class="nav-img" alt="articles">
        <h4><a href="account.php?q=1">Quiz</a></h4>
    </div>

    <div class="nav-option option3 <?php if (@$_GET['q'] == 2) echo 'active'; ?>">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzJQq2MbpUiqHje9HJrfmihf4vsOAUxGVEVQ&s" class="nav-img" alt="report">
        <h4><a href="account.php?q=2">History</a></h4>
    </div>

    <div class="nav-option option4 <?php if (@$_GET['q'] == 3) echo 'active'; ?>">
        <img src="https://t4.ftcdn.net/jpg/02/80/52/45/360_F_280524501_n8tEztMk79KV6be1etcvNyx9UJYL1o6e.jpg" class="nav-img" alt="institution">
        <h4><a href="account.php?q=3">Rank</a></h4>
    </div>

    <div class="nav-option option5 <?php if (@$_GET['q'] == 5) echo 'active'; ?>">
        <img src="https://icones.pro/wp-content/uploads/2022/01/icone-de-commentaires-verte.png" class="nav-img" alt="blog">
        <h4><a href="account.php?q=5">Feedback</a></h4>
    </div>

    <div class="nav-option option6 <?php if (@$_GET['q'] == 4) echo 'active'; ?>">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqkuxESw1DWn_T8XG9w3dtbrLUm2KmiJK13g&s" class="nav-img" alt="settings">
        <h4><a href="account.php?q=4">Content</a></h4>
    </div>

    <div class="nav-option logout">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSISHJ9o6juNl7ILLWu8GUtCSWn4sDHurYvA&s" class="nav-img" alt="logout">
        <h3><a href="index.php">Logout</a></h3>
 </div>
</div>

            </nav>
        </div>
<!--<div id="footer">
    <p>
       Andhra Pradesh State Co-operative Bank Learning Management System
    </p>
  </div>-->
        <div class="main">
            <div class="box-container">
<?php
	if(@$_GET['q']==0)
	{
		?>
		<div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">
						<?php  
							$rank = mysqli_query($con, "SELECT emp_id, SUM(score) as sc FROM ranks GROUP BY emp_id ORDER BY sc DESC");
							$sq=mysqli_query($con,"select count(distinct emp_id) as sc from ranks;");
							if (!$rank) {
								die('Query failed: ' . mysqli_error($con));
							}
							
							$c = 1;
							$found = false;
							while ($row = mysqli_fetch_assoc($rank)) {
								if ($row['emp_id'] == $emp_id) {
									$found = true;
									break;
								}
								$c++;
							}
							while($ro=mysqli_fetch_array($sq))
							{
								$co=$ro['sc'];
							}
							if ($found) {
								echo $c.'/'.$co;
							} else {
								echo "0";
							}
							?>
						</h2>
                        <h2 class="topic">Rank</h2>
                    </div>

                    <img src="image/medal.png" alt="likes">
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">
						<?php
						$n=mysqli_query($con,"select count(*) as count1 from quiz");
						$r=mysqli_num_rows($n);
						if($r>0)
						{
							$t=mysqli_query($con,"select count(*) as count2 from old where emp_id='$emp_id'");
							while($row1=mysqli_fetch_array($n))
							{
								$s1=$row1['count1'];
							}
							while($row2=mysqli_fetch_array($t))
							{
								$s2=$row2['count2'];
							}
							echo $s2.'/'.$s1;
						}
						?>
						</h2>
                        <h2 class="topic">Quizzes Done</h2>
                    </div>

                    <img src="image/pen.png" alt="Views">
                </div>
            </div>
			<?php
	}
	?>

<div class="report-container">
<?php
if(@$_GET['q']==0)
{
$sql=mysqli_query($con,"select * from user where emp_id='$emp_id'");
		$result=mysqli_num_rows($sql);
		$mail='';
		$contact='';
		$Designation='';
		while($row=mysqli_fetch_assoc($sql))
		{
			$mail=$row['Mail_Id'];
			$contact=$row['Contact'];
			$Designation=$row['Designation'];
			echo '<div class="center-container"><table>
		<tr><td>Name: </td><td>'.$name.'</td></tr><tr><td>Mail Id:</td><td>'.$row['Mail_Id'].'</td></tr><tr><td>Contact</td><td>'.$row['Contact'].'</td></tr><tr><td>Designation</td><td>'.$row['Designation'].'</td></tr></table></div>';
		}
		echo '<h3> Upload your photo here</h3><br>';
		echo '<form action="upload.php?q=add_img" method="POST" enctype="multipart/form-data">
		<input type="file" name="addimg" id="addimg">
		<button type="submit" name="submit" style="background-color:green;color:white;">Upload</button>
		</form>';
}
if(@$_GET['q']==1) {
    if(isset($_POST['submit'])) {
        $search = htmlspecialchars($_POST['search']);
        $result = mysqli_query($con, "SELECT * FROM quiz WHERE title LIKE '%$search%' ORDER BY date DESC") or die('Error');
    } else {
        $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
    }
    echo '<div class="center-container"><table class="table1">
    <tr style="color:green"><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time</b></td><td></td></tr>';
    $c = 1;
    while($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $total = $row['total'];
        $sahi = $row['sahi'];
        $time = $row['time'];
        $eid = $row['eid'];
        $q12 = mysqli_query($con, "SELECT score FROM old WHERE eid='$eid' AND emp_id='$emp_id'") or die('Error98');
        $rowcount = mysqli_num_rows($q12);
        if($rowcount == 0) {
            echo '<tr style="color:black"><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'
            <td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'"><b style="color:black">Start</b></a></b></td></tr>';
        } else {
            echo '<tr style="color:red"><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'
            <td><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'"><b style="color:red">Restart</b></a></b></td></tr>';
        }
    }
    $c = 0;
    echo '</table></div>';
}
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    $eid = @$_GET['eid'];
    $sn = @$_GET['n'];
    $total = @$_GET['t'];

    // Fetch quiz time from the database
    $result = mysqli_query($con, "SELECT time FROM quiz WHERE eid='$eid'");
    $row = mysqli_fetch_assoc($result);
    $quiz_time = $row['time'] * 60; // Convert minutes to seconds

    // Reset or initialize the quiz end time in the session
    if (!isset($_SESSION['quiz_start_time'][$eid]) || @$_GET['n'] == 1) {
        $_SESSION['quiz_start_time'][$eid] = time();
    }

    $quiz_start_time = $_SESSION['quiz_start_time'][$eid];
    $time_left = $quiz_start_time + $quiz_time - time();

    // If time has run out, auto-submit the quiz
    if ($time_left <= 0) {
        echo "<script>
            alert('Time is up! Your quiz will be auto-submitted.');
            window.location.href = 'update.php?q=quiz&step=2&eid=$eid&n=$total&t=$total&time_up=1';
        </script>";
        exit();
    }

    echo '<div class="panel" style="margin:5%">';
    echo '<h4>Time Left: <span id="timer"></span></h4>';
    
    // Initialize session variable to store displayed questions if not already set
    if (!isset($_SESSION['displayed_questions'][$eid])) {
        $_SESSION['displayed_questions'][$eid] = array();
    }

    // Fetch all questions for the given quiz
    $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid'");

    // Store all questions in an array
    $questions = array();
    while ($row = mysqli_fetch_array($q)) {
        $questions[] = $row;
    }

    // Shuffle the questions array
    shuffle($questions);

    // Find a question that hasn't been displayed yet
    $selected_question = null;
    foreach ($questions as $question) {
        if (!in_array($question['qid'], $_SESSION['displayed_questions'][$eid])) {
            $selected_question = $question;
            $_SESSION['displayed_questions'][$eid][] = $question['qid'];
            break;
        }
    }

    // If all questions have been displayed, reset the session variable
    if ($selected_question == null) {
        $_SESSION['displayed_questions'][$eid] = array();
        $selected_question = $questions[0];
        $_SESSION['displayed_questions'][$eid][] = $selected_question['qid'];
    }

    // Get the selected question's details
    $qns = $selected_question['qns'];
    $qid = $selected_question['qid'];

    echo '<div class="panel full-page" style="margin:5%">';
    echo '<b>Question &nbsp;' . $sn . '&nbsp;::<br />' . $qns . '</b><br /><br />';
    $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid'");
    echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST" class="form-horizontal"><br/>';
    while ($row = mysqli_fetch_array($q)) {
        $option = $row['option'];
        $optionid = $row['optionid'];
        echo '<label class="option-label">';
        echo '<input type="radio" name="ans" value="' . $optionid . '">' . $option . '<br />';
        echo '</label>';
    }

    echo '<input type="hidden" name="time_left" id="time_left" value="">';
    echo '<br/><button type="submit" onclick="setTimeLeft()">Submit</button></form></div>';

    // Add JavaScript for the timer
    echo "<script>
        var timeLeft = $time_left;
        var timerId = setInterval(countdown, 1000);

        function countdown() {
            if (timeLeft == 0) {
                clearTimeout(timerId);
                document.getElementById('time_left').value = 0;
                alert('Time is up! Your quiz will be auto-submitted.');
                window.location.href = 'update.php?q=quiz&step=2&eid=$eid&n=$total&t=$total&time_up=1';
            } else {
                var minutes = Math.floor(timeLeft / 60);
                var seconds = timeLeft % 60;
                document.getElementById('timer').innerHTML = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                timeLeft--;
            }
        }

        function setTimeLeft() {
            document.getElementById('time_left').value = timeLeft;
        }
    </script>";
}

    


//result display
	if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
    $eid=@$_GET['eid'];
    $q=mysqli_query($con,"SELECT * FROM old WHERE eid='$eid' AND emp_id='$emp_id' " )or die('Error157');
    echo  '<h1 class="title" style="color:#660033">Result</h1><div class="center-container">
    <table class="table1" style="font-size:20px;font-weight:1000;">';
    while($row=mysqli_fetch_array($q) )
    {
        $s=$row['score'];
        $w=$row['wrong'];
        $r=$row['sahi'];
        $qa=$row['level'];
        echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
        <tr style="color:#99cc32"><td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
        <tr style="color:red"><td>Wrong Answer<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
        <tr style="color:#66CCFF"><td>Score<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
    }
    echo '</table></div>';

    $q = mysqli_query($con, "SELECT * FROM old WHERE emp_id='$emp_id' and eid='$eid' ORDER BY date DESC") or die('Error197');
    $quizTitles = [];
    $scores = [];
    $questionSolved = [];
    $rightAnswers = [];
    $wrongAnswers = [];
    $c = 0;
    while($row = mysqli_fetch_array($q)) 
    {
        $eid = $row['eid'];
        $s = $row['score'];
        $w = $row['wrong'];
        $r = $row['sahi'];
        $qa = $row['level'];
        if(isset($_POST['submit'])) {
            $search = htmlspecialchars($_POST['search']);
            $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE title LIKE '%$search%' AND eid='$eid' ORDER BY date DESC") or die('Error208');
        } else {
            $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE eid='$eid'") or die('Error208');
        }
        $title = '';
        while($row = mysqli_fetch_array($q23)) {
            $title = $row['title'];
        }
        if($title != '') {
            $quizTitles[] = $title;
            $scores[] = $s;
            $questionSolved[] = $qa;
            $rightAnswers[] = $r;
            $wrongAnswers[] = $w;
            $c++;
        }
    }
    // Convert PHP arrays to JSON for use in JavaScript
    $quizTitlesJson = json_encode($quizTitles);
    $scoresJson = json_encode($scores);
    $questionSolvedJson = json_encode($questionSolved);
    $rightAnswersJson = json_encode($rightAnswers);
    $wrongAnswersJson = json_encode($wrongAnswers);
    echo '<div class="panel title">
        <canvas id="historyChart" width="700" height="200"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById("historyChart").getContext("2d");
            var historyChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ' . $quizTitlesJson . ',
                    datasets: [{
                        label: "Scores",
                        data: ' . $scoresJson . ',
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1,
                        barThickness: 50
                    }, {
                        label: "Questions Solved",
                        data: ' . $questionSolvedJson . ',
                        backgroundColor: "rgba(153, 102, 255, 0.2)",
                        borderColor: "rgba(153, 102, 255, 1)",
                        borderWidth: 1,
                        barThickness:50
                        }, {
                        label: "Right Answers",
                        data: ' . $rightAnswersJson . ',
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor: "rgba(54, 162, 235, 1)",
                        borderWidth: 1,
                        barThickness: 50
                    }, {
                        label: "Wrong Answers",
                        data: ' . $wrongAnswersJson . ',
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 1,
                        barThickness: 50
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>';

    // New section to display questions and correct answers
    echo '<h2>Question Review</h2>';
    echo '<div class="question-review">';

    $q = mysqli_query($con, "SELECT q.qns, q.qid, o.option, o.optionid, a.ansid AS correct_ansid
    FROM questions q 
    JOIN options o ON q.qid = o.qid
    JOIN answer a ON q.qid = a.qid
    WHERE q.eid = '$eid'
    ORDER BY q.sn, o.optionid");

    $current_qid = '';
    while($row = mysqli_fetch_array($q)) {
        if ($current_qid != $row['qid']) {
            if ($current_qid != '') {
                echo '</div>';
            }
            echo '<div class="question">';
            echo '<p><strong>Question:</strong> ' . htmlspecialchars($row['qns']) . '</p>';
            $current_qid = $row['qid'];
        }
        
        if ($row['optionid'] == $row['correct_ansid']) {
          echo '<p><strong>Correct Answer:</strong> ' . htmlspecialchars($row['option']) . '</p>';
        }
    }
    echo '</div>';
    echo '</div>';
}
?>

<!--quiz end-->
<?php
//history start
if(@$_GET['q']== 2) 
{
	$q=mysqli_query($con,"SELECT * FROM old WHERE emp_id='$emp_id' ORDER BY date DESC " )or die('Error197');
	echo  '<div class="center-container">
	<table>
	<tr style="color:green"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
	$c=0;
	while($row=mysqli_fetch_array($q) )
	{
		$eid=$row['eid'];
		$s=$row['score'];
		$w=$row['wrong'];
		$r=$row['sahi'];
		$qa=$row['level'];
		if(isset($_POST['submit']))
		{
			$search = htmlspecialchars($_POST['search']);
			$q23=mysqli_query($con,"select title from quiz where title LIKE '%$search%' and eid='$eid' order by date desc") or die('Error208');
		}
		else
		{
			$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
		}
		$title='';
		while($row=mysqli_fetch_array($q23) )
		{
			$title=$row['title'];
		}
		$c++;
		if($title!='')
		{
			echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
		}
	}
	echo'</table></div>';
}

//ranking start
if(@$_GET['q']== 3) 
{
	if(isset($_POST['submit']))
	{
		$search = htmlspecialchars($_POST['search']);
		$q=mysqli_query($con,"select * from quiz INNER JOIN ranks using(eid) where emp_id LIKE '%$search%' order by score desc") or die('Error223');
	}
	else
	{
		$q=mysqli_query($con,"SELECT * FROM quiz INNER JOIN  ranks USING (eid) ORDER BY title DESC;" )or die('Error223');
	}
	echo '<div class="center-container">
        <table border="1">
            <tr style="color:green">
                <td><b>Rank</b></td>
				<td><b>Name</b></td>
				<td><b>Employee Id</b></td>
                <td><b>Score</b></td>
                <td><b>Title</b></td>
            </tr>';
$c = 0;
while ($row = mysqli_fetch_array($q)) {
    $e = $row['emp_id'];
    $s = $row['score'];
    $title = $row['title'];
	$que=mysqli_query($con,"select Name from user where emp_id='$e'");
	while($row1=mysqli_fetch_array($que))
	{
		$nam=$row1['Name'];
	}
    $c++;
    echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$nam.'</td><td>'.$e.'</td><td>'.$s.'</td><td>'.$title.'</td></tr>';
}
echo '  </table>
      </div>';

}

if (@$_GET['q'] == 4) 
{
	if(isset($_POST['submit']))
	{
		$search = htmlspecialchars($_POST['search']);
		$sql= mysqli_query($con,"SELECT * FROM files where topic LIKE '%$search%'") or die('Error');
	}
	else
	{
		$sql = mysqli_query($con, "SELECT filename,topic, Description,link FROM files"); // Assuming the column is filename
	}
    $res = mysqli_num_rows($sql); // Missing semicolon added here
    if ($res > 0) 
	{
        echo '<table border="1" class="table table-bordered" style="background-color:white !important;"><tr style="color:green"><th>Topic</th><th>Description</th><th>Download</th><th>Link</th></tr>';
        while ($row = mysqli_fetch_assoc($sql)) 
		{
            $file_path = "uploads/" . $row['filename'];
            echo '<tr><td>' . $row['topic'] . '</td><td>'.$row['Description'] . '</td><td><a href="' . $file_path . '" class="btn btn-primary" download>Download</a></td><td><a href="$row[link]" target="_blank">'.$row['link'].'</a></td></tr>';
        }
        echo '</table>';
    } 
	else 
	{
        echo '<p>No files uploaded yet.</p>';
    }
}

if(@$_GET['q']==5)
{
	echo '<form role="form"  method="post" action="feed.php">
<table cellpadding="10px" style="border-collapse: collapse; width: 50%; margin: auto; font-family: Arial, sans-serif;">
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #2f2f2;"><b>Name: </b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="name" id="name" style="width: 100%; padding: 5px;"></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Employee Id:</b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="emp_id" id="emp_id" style="width: 100%; padding: 5px;"></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Subject: </b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="subject" id="subject" style="width: 100%; padding: 5px;"></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;"><b>Feedback: </b></td>
        <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="feedback" id="feedback" style="width: 100%; padding: 5px;"></td>
    </tr>
    </table>
	<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
</form>';
}
$con->close();
?>
            </div>
        </div>
    </div>
    <script src="./index.js"></script>
</body>
</html>