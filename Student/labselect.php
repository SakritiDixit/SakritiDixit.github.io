<?php
session_start();
if(!isset($_SESSION['roll']))
{
        header("location: index.php");
}
$rollnumber=$_SESSION['roll'];

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
$con2=mysqli_connect('localhost','root','');
mysqli_select_db($con2,'attendance1');
$curYear=date('Y');
$curMonth=date('M');
$month=0;
$curDate=date("y-m-d");
switch ($curMonth) {
    case "Jan":
        $month=1;
        break;
    case "Feb":
        $month=2;
        break;
    case "Mar":
        $month=3;
        break;
    case "Apr":
      $month=4;
      break;
    case "May":
      $month=5;
      break;
    case "Jun":
      $month=6;
      break;
    case "Jul":
      $month=7;
      break;
    case "Aug":
      $month=8;
      break;
    case "Sep":
      $month=9;
      break;
    case "Oct":
      $month=10;
      break;
    case "Nov":
      $month=11;
      break;
    case "Dec":
      $month=12;
      break;
}

$year=0;

if($month<6)
{
  $year=$curYear-$_SESSION['yoa'];
}
else
{
  $year=$curYear-$_SESSION['yoa']+1;
}

$branch=$_SESSION['branch'];
?>

<html>
<head>
    <link rel="stylesheet" href="./css/dashboard.css"></link>
    <link rel="stylesheet" href="./css/dashstyle.css"></link>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Select Lab</title>
</head>
<body>

    <div class="header">
     <a href="#" class="logo"><img src="./images/igdtuwLogo.png"></a>
      <a href="#" class="clg-name">Indira Gandhi Delhi Technical University for Women</a>
  </div>
  <div class="project-name">
    <p>Programming Lab Evaluation Portal</p>
  </div>
<div class="rightbt">
  <form action="logout.php">
  <button class="btn" style="float: right" href="logout.php">Logout</button>
</form>
</div>


<form action="temp.php" method="post">
<div class="abcd">
  <div class="chlab">
    <p>Choose Lab</p>
  </div>
   <div class="efgh">
    <select name="labselect" class="form-control">
    <?php
    
    $sql="SELECT LAB_ID FROM stol_map WHERE YEAR='$year'&& BRANCH='$branch'";

    $result=mysqli_query($con,$sql);
    date_default_timezone_set('Asia/Kolkata');
    $curtime=date('H');
    $curday=date('l');
    $br=$_SESSION['branch'];
    $bt=$_SESSION['batch'];
    $roll=$_SESSION['roll'];
    while ($row = mysqli_fetch_array($result))
    {
        $temp=$row['LAB_ID'];
        $s2="SELECT * FROM schedule where LAB_ID='$temp' &&  BRANCH='$br' && BATCH='$bt' && DAY='$curday' && STIME<='$curtime' && ETIME>'$curtime'";
        $resnew=mysqli_query($con2,$s2);
        $row2=mysqli_fetch_array($resnew);
        // echo $row2['LAB_ID']. "<br>";
        // if($curtime>=$row2['STIME']&&$curtime<=$row2['ETIME']&&$roll>=$row2['SROLL']&&$roll<=$row2['EROLL']&&$curday==$row2['DAY'])
        // {
          $k=$row2['LAB_ID'];
          $smallq="SELECT LAB_NAME FROM lab WHERE LAB_ID='$k'";
          $res=mysqli_query($con,$smallq);
          $rownew=mysqli_fetch_array($res);
          $n=mysqli_num_rows($resnew);
          // echo "ff";
          if($n>0)
          echo "<option value='". $row2['LAB_ID'] ."'>" .$rownew['LAB_NAME'] ."</option>" ;
          // $s4="SELECT * FROM `$temp` WHERE ROLL='$roll'&& DATE=CURDATE()";
          // $res4=mysqli_query($con2,$s4);
          // $num=mysqli_num_rows($res4);
          // $row3=mysqli_fetch_array($res4);
          // if($num==0)
          // {
          //   $st=$row2['STIME'];
          //   $et=$row2['ETIME'];
          //   $s3="INSERT INTO `$temp` VALUES (null,CURDATE(),'$curday','$st','$et','$br','$bt','$roll')";
          //   $resfinal=mysqli_query($con2,$s3) or die("Error: ".mysqli_error($con2));
          // }
          // else if($curtime>$row3["ETIME"])
          // {

          //   $st=$row2['STIME'];
          //   $et=$row2['ETIME'];
          //   $s3="INSERT INTO `$temp` VALUES (null,CURDATE(),'$curday','$st','$et','$br','$bt','$roll')";
          //   $resfinal=mysqli_query($con2,$s3) or die("Error: ".mysqli_error($con2));
          // }
        // }
    }
    ?>
    </select>
    <button type="submit" class="btn2">Submit</button>
   </div>
 </div>
</form>

</body>
</html>
