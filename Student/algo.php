<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');

$roll=$_SESSION['roll'];
$qid=$_POST['qselect'];
$algorithm=$_POST['algorithm'];

$k="SELECT * from qtos_map where Q_ID='$qid' AND ROLL='$roll'";

// $smallq="SELECT Q_NAME FROM questions_table WHERE Q_ID='$qid'";
$res=mysqli_query($con,$k);
// $res1=mysqli_query($con,$smallq);
$n=mysqli_num_rows($res);

//$rownew=mysqli_fetch_array($res);

// $rownew=mysqli_fetch_array($res1);

//$qname=$rownew['Q_NAME'];
// echo $roll;
// echo $qid;
// echo $algorithm;
// echo $qname;
$row=mysqli_fetch_array($res);
if($n>0){
    $row=mysqli_fetch_array($res);
			$f= "UPDATE qtos_map set ALGO='$algorithm' where Q_ID='$qid' AND ROLL='$roll'";
			$result=mysqli_query($con,$f);
    // $reg="UPDATE algorithms SET ALGO='$algorithm' WHERE Q_ID='$qid' && ROLL='$roll'";
    // mysqli_query($con,$reg);    
     $message = "algorithm for the question updated";
    echo "<script type='text/javascript'>alert('$message');</script>";
 }
//  else{
//     $message = "no submission has been made for the question";
//     echo "<script type='text/javascript'>alert('$message');</script>";  
//  }
 else if($n==0){
$reg="INSERT INTO qtos_map VALUES (null,'$qid','$roll','','','','','$algorithm')";
mysqli_query($con,$reg);
$message = "algorithm for the question added";
echo "<script type='text/javascript'>alert('$message');</script>";
 }
 header('location:editor.php');

?>