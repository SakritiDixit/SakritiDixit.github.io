<?php
session_start();
$con=mysqli_connect('localhost','root','');
		mysqli_select_db($con,'minorproject1');
		$ip='';
		$op='';
		if($_SESSION['score']<=10){
$option = explode("/", $_POST['output']);

$op=str_replace(',', ' ',$option[0]);
echo "<br>";
$ip=str_replace(',', ' ',$option[1]);
		}
$code=$_SESSION['code'];
$score=$_SESSION['score'];
$q_id=$_SESSION['qchosen'];
$rollno=$_SESSION['roll'];
date_default_timezone_set('Asia/Kolkata');
			$curDate=date("y-m-d");
$k="SELECT * from qtos_map where Q_ID='$q_id' AND ROLL='$rollno'";
		$res1=mysqli_query($con,$k);
        $n=mysqli_num_rows($res1);
if($n>0)
		{
			$row=mysqli_fetch_array($res1);
			$a=$row['ALGO'];
			 if($row['SCORE']==1000){
			 	$ip='';
			 	$op='';
			 	echo 'Testcases not present for this question. Will be evaluated by lab teacher.<br>';
			 }
			// 	$score=$_SESSION['score'];
			$f= "UPDATE qtos_map SET SUBMISSION ='$code', SCORE ='$score', INPUT ='$ip', OP ='$op', DATE='$curDate' WHERE Q_ID ='$q_id' AND ROLL ='$rollno' AND ALGO ='$a'";
			$result=mysqli_query($con,$f);
            //  $row=mysqli_fetch_array($result);
             if (!$result) {
                echo("Error description: " . mysqli_error($con));
              }
			echo 'updated';
		}
		else 
		{
			$a='empty algorithm!';
			$reg="INSERT INTO qtos_map VALUES (null , '$q_id' , '$rollno' , '$code' , '$score' , '$ip' , '$op' ,'$a','$curDate')";
			//$reg="INSERT INTO 'qtos_map'('ID', 'Q_ID', 'ROLL', 'SUBMISSION', 'SCORE', 'INPUT', 'OP', 'ALGO') VALUES (null , $q_id , $rollno , $code , $score , $ip , $pj->stdout ,0)";
			$result=mysqli_query($con,$reg);
			if (!$result) {
                echo("Error description: " . mysqli_error($con));
              }
			// echo $result;
			 echo 'added';
		}
header('location:editor.php');
?>