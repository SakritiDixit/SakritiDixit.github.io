<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');

$rollnumber=$_POST['RollNumber'];
$name=$_POST['Name'];
$password=$_POST['Password'];
$yoa=$_POST['YOA'];
$branch=$_POST['Branch'];
$batch=$_POST['Batch'];


$s="SELECT * FROM student_registration WHERE ROLL='$rollnumber'";
$result=mysqli_query($con,$s);
$num=0;
$num=mysqli_num_rows($result);

if($num==0)
{
	if(!session_id()) session_start();
	$_SESSION['filename'] = 2;
	$reg="INSERT INTO student_registration VALUES (null,'$rollnumber','$name','$password','$yoa','$branch','$batch')";
	mysqli_query($con,$reg);
	header('location:frontPage.php');
}

else
{
	if(!session_id()) session_start();
	$_SESSION['filename'] = 1;
	header('location:frontPage.php');
}

?>