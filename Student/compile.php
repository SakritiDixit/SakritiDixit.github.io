<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="./css/dashstyle.css">
  <link rel="stylesheet" href="styling1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
<title>Output</title>
<style>
	a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #4CAF50;
  color: black;
}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  border-radius: 12px;
}

.button5 {
  background-color: white;
  color: black;
  border-radius: 12px;
  border: 2px solid #555555;
}

.button5:hover {
  background-color: #555555;
  color: white;
  border-radius: 12px;
}
</style>
</head>
<body>

<div class="header">
     <a href="#" class="logo"><img src="./images/igdtuwLogo.png"></a>
      <a href="#" class="clg-name">Indira Gandhi Delhi Technical University for Women</a>
  </div>

<ul>
  <li><a id="b1" href="labmanual.php">Lab Manual</a></li>
  <li><a id="b2" href="submissions.php">My Submissions</a></li>
  <li><a id="b3" href="editor.php">Go To Editor</a></li>
  <li><a id="b3" href="answereddoubts.php">Doubts Raised</a></li>
  <li><a id="b3" href="testcompiler.php">Test Compiler</a></li>
  <li style="float:right"><a href="logout.php">Logout</a></li>
  <li style="float:right"><a href="customize.php">Settings</a></li>
</ul>

<?php
	session_start();
	 // $_POST["language_id"]=52;
	$page = $_SERVER['PHP_SELF'];
$sec = "2";
	if(!isset($_POST['language_id']))
		$_POST["language_id"]=$_SESSION['language_id'];
	$languageID=$_POST["language_id"];
	$_SESSION['language_id']=$languageID;
        error_reporting(0);
	
		//echo $_POST["language_id"];

		$code=$_POST["source_code"];
		$_SESSION['code']=$code;
		$con=mysqli_connect('localhost','root','');
		mysqli_select_db($con,'minorproject1');
		$qchosen=$_POST["question"];
		$_SESSION['qchosen']=$qchosen;
//$_SESSION['score']=10;
		$s="SELECT CHECKER,TEST1,TEST2,TEST3,TEST4,TEST5 FROM questions_table WHERE Q_ID='$qchosen'";
		$res=mysqli_query($con,$s);
		$row=mysqli_fetch_array($res);
// if($_SESSION['tt']==0){
		if($row["CHECKER"]!=0)
		{
			include("compilers/cpp.php");
		}

		else
		{
			// $_SESSION['code']=$_POST["source_code"];
			$_SESSION['score']=1000;
		//$_SESSION['score']=0;
		}
		// $_SESSION['tt']=1;
	// }
		$k=0;
		echo "<b>Select output you want in file.</b><br><br>";
		echo "<form action='finaloutputs.php' method='post'>";
		for ($i = 0; $i <count($_SESSION['tokens']); $i++) {
$u="https://api.judge0.com/submissions/" . $_SESSION['tokens'][$i] . "?base64_encoded=false&fields=stdout,expected_output,status";
$xml = file_get_contents($u);

$pj = json_decode($xml);
//echo nl2br("Input : ".$_SESSION['input']);
$s=$string = str_replace(' ', ',', $pj->stdout);
$s1=$string = str_replace(' ', ',', $row['TEST'.($i+1)]);
echo "<input type='radio' name='output' value=".$s."/".$s1.">";
echo nl2br("Input: " .$row['TEST'.($i+1)]);
echo nl2br("\n");
  echo nl2br("Output : ".$pj->stdout);
 echo nl2br("\n");
 echo nl2br("Expected Output : ".$pj->expected_output);
 echo nl2br("\n");
  echo nl2br("Status : ".$pj->status->description);
  echo nl2br("\n");
  if($_SESSION['score']!=1000){
if($pj->status->description=='Wrong Answer')
 $_SESSION['score']=$_SESSION['score']-2;
  }
//  if(count($tokens)!=1)

 //echo "Score :".$_SESSION['score'];
//  echo '<br>';

 if($pj->status->description=='Compilation Error')
 {
 	$k=1;
 	break;
 }
 }
 
//sleep(2);
 if($k==1){
			echo 'not submitted due to compilation error';
		}
		else{
			echo "<br>";
			echo "<input class='button button5' type='submit' name='submit' value='Submit'>";
			echo "</form>";
		echo "Score :".$_SESSION['score'];
		//echo '--';
		$q_id=$_SESSION['qchosen'];
		$rollno=$_SESSION['roll'];
		$code=$_SESSION['code'];
		$score=$_SESSION['score'];

		echo'<br>';
		$k="SELECT * from qtos_map where Q_ID='$q_id' AND ROLL='$rollno'";
		$res1=mysqli_query($con,$k);
		$n=mysqli_num_rows($res1);
		// echo $n;
		//$row=mysqli_fetch_array($res);
		// echo $row['ALGO'];
		//echo $code. ' ' .$score. ' ';
		$ip=$_SESSION['input'];
		//$ip='test input';
		$op=$pj->stdout;
		//echo $ip. '---' .$op;
		// if($ip==null)
		// $ip=0;
		// if($pj->stdout==null)
		// $op=0;
		// //echo $rollno. ' ' .$q_id;
		
		// if($n>0)
		// {
		// 	$row=mysqli_fetch_array($res1);
		// 	$a=$row['ALGO'];
		// 	 if($row['SCORE']==1000){
		// 	 	$ip='';
		// 	 	$op='';
		// 	 	echo 'Testcases not present for this question. Will be evaluated by lab teacher.<br>';
		// 	 }
		// 	// 	$score=$_SESSION['score'];
		// 	$f= "UPDATE qtos_map SET SUBMISSION ='$code', SCORE ='$score', INPUT ='$ip', OP ='$op' WHERE Q_ID ='$q_id' AND ROLL ='$rollno' AND ALGO ='$a'";
		// 	$result=mysqli_query($con,$f);
		// 	 $row=mysqli_fetch_array($result);
		// 	 echo $row['INPUT'];
		// 	 echo $row['OP'];
		// 	 echo $row['SCORE'];
		// 	 echo $row['ALGO'];
		// 	echo 'updated';
		// }
		// else 
		// {
		// 	$a='empty algorithm!';
		// 	$reg="INSERT INTO qtos_map VALUES (null , '$q_id' , '$rollno' , '$code' , '$score' , '$ip' , '$op' ,'$a')";
		// 	//$reg="INSERT INTO 'qtos_map'('ID', 'Q_ID', 'ROLL', 'SUBMISSION', 'SCORE', 'INPUT', 'OP', 'ALGO') VALUES (null , $q_id , $rollno , $code , $score , $ip , $pj->stdout ,0)";
		// 	$result=mysqli_query($con,$reg);
		// 	// echo $result;
		// 	 echo 'added';
		// }
	}
//echo $_SESSION['tc'];

?>

<?php// $_SESSION['c']=$code; ?> 
  <?php
        //  if($pj->status->description=='Processing'||$pj->status->description=='In Queue'){?>
    <!-- <meta http-equiv="refresh" content="<?php //echo $sec?>;URL='<?php //echo $page?>'"> -->
        <?php
		// echo "Wait";
		//header('location:t2.php');
    // }else echo "done"; ?>
<!-- <a href="editor.php" class="previous">&laquo; Back to Editor</a> -->
</body>
</html>
