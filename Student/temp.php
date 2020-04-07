<?php
session_start();

$con=mysqli_connect('localhost','root','');
$con2=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
mysqli_select_db($con2,'attendance1');
// $roll=$_SESSION['roll'];
$batch=$_SESSION['batch'];
$branch=$_SESSION['branch'];
// $branch='CSE';
$lab_id=$_POST['labselect'];
$_SESSION['lab']=$lab_id;
// echo $lab_id;
// $lab_id='bcs-206';
$roll=$_SESSION['roll'];
$s=$lab_id."-old";
date_default_timezone_set('Asia/Kolkata');
$curDate=date("y-m-d");
$h=date('H');
// echo $s;
// $q1="SELECT DISTINCT DATE,STIME,ETIME,ROLL FROM `$s`";// WHERE BRANCH='$branch' && BATCH='$batch'";
// $q1="SELECT ROLL,BATCH FROM `$s` WHERE  BRANCH='$branch' GROUP BY ROLL";
// $q1="SELECT ROLL,BATCH FROM `$lab_id` WHERE ROLL='$roll'&& BRANCH='$branch' &&BATCH='$batch' GROUP BY ROLL";
// $r1= mysqli_query($con2, $q1);  
// while($row1 = mysqli_fetch_array($r1)){
//   $roll=$row1['ROLL'];
//   $bt=$row1['BATCH'];
//  $q5="SELECT DATE,STIME,ETIME FROM `$s` WHERE ROLL='$roll'&&  BRANCH='$branch' GROUP BY DATE";
// echo $roll;
$d=date("w");
if($d==1)
$d='Monday';
else if($d==2)
$d='Tuesday';
else if($d==3)
$d='Wednesday';
else if($d==4)
$d='Thursday';
else if($d==5)
$d='Friday';
echo $_SESSION['branch'];
$_SESSION['h']=$h;
$q5="SELECT STIME,ETIME FROM schedule WHERE LAB_ID='$lab_id' &&  BRANCH='$branch' && BATCH='$batch' && DAY='$d' && STIME<='$h' && ETIME>='$h'";
 $r5= mysqli_query($con2, $q5);  
  //  echo "hey" .$roll. "<br>";
  while($row2 = mysqli_fetch_array($r5)){
    // $dt=$row2['DATE'];
  $st=$row2['STIME'];
  $et=$row2['ETIME'];
  // $d=$row2['DAY'];
  //  echo $curDate. " " .$st. " " .$et ."<br>";
  $nc=$curDate. " " .$st. "-" .$et ;
  echo $nc;
  // $_SESSION['n']=$nc;
  $result = mysqli_query($con2,"SHOW COLUMNS FROM `$lab_id` LIKE '$nc'");
  $exists = (mysqli_num_rows($result))?TRUE:FALSE;
  if(!$exists) {
  $q2="ALTER TABLE `$lab_id` ADD `$nc` BOOLEAN NOT NULL DEFAULT 0";
  $r2= mysqli_query($con2, $q2);  
  }
// else{
  $q3="SELECT * FROM `$lab_id` WHERE ROLL='$roll'";
$res1=mysqli_query($con2,$q3);
$num=mysqli_num_rows($res1);

if($num==0){
  $q4="INSERT INTO `$lab_id`(`ID`, `BRANCH`, `BATCH`, `ROLL`, `$nc`) VALUES (null,'$branch','$batch','$roll','1')";
  $res2=mysqli_query($con2,$q4);
   }
else{
  // echo "update: " .$nc."<br>";
  $q4="UPDATE `$lab_id` set `$nc`='1' where ROLL='$roll'";
  $res2=mysqli_query($con2,$q4);
  if (!$res2) {
    echo("Error description: " . mysqli_error($con2));
  }
  echo "<br>";
}
// }
// header('location:mydashboard.php');
  }
  header('location:mydashboard.php');
// }
?>