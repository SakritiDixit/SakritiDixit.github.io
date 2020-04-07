<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');

$roll=$_SESSION['roll'];
$qid=$_POST['qselect'];
$doubt=$_POST['doubt'];

$smallq="SELECT Q_NAME FROM questions_table WHERE Q_ID='$qid'";
$res=mysqli_query($con,$smallq);
$rownew=mysqli_fetch_array($res);
$qname=$rownew['Q_NAME'];
echo $roll;
echo $qid;
echo $doubt;
echo $qname;


$reg="INSERT INTO doubts VALUES (null,'$qid','$qname','$roll','$doubt','')";
mysqli_query($con,$reg);
// header('location:editor.php');

?>