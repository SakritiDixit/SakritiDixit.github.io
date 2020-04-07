<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject');
if(!isset($_SESSION['roll']))
{
        header("location: ../index.php");
}
$rollnumber=$_SESSION['roll'];
?>