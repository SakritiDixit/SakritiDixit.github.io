<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');

$rollnumber=$_POST['RollNumber'];
$password=$_POST['Password'];

$s="SELECT * FROM student_registration WHERE ROLL='$rollnumber'&& PASSWORD='$password'";
$result=mysqli_query($con,$s);

$num=mysqli_num_rows($result);
// echo '$num';
if($num==1)
{
    $_SESSION['roll']=$rollnumber;
    while($row=mysqli_fetch_array($result))
    {
        $_SESSION['name']=$row['NAME'];
        $_SESSION['yoa']=$row['YOA'];
        $_SESSION['branch']=$row['BRANCH'];
        $_SESSION['batch']=$row['BATCH'];
    }
    header('location:labselect.php');
}
else
{
    if(!session_id()) session_start();
	$_SESSION['filename'] = 3;
    header('location:frontPage.php');
}
?>