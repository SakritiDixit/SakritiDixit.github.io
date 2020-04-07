<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
if(!isset($_SESSION['roll']))
{
        header("location: index.php");
}
$rollnumber=$_SESSION['roll'];
$_SESSION['oldbr']='';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="./css/dashstyle.css">
  <link rel="stylesheet" href="styling1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
<title>Settings</title>
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
  <li style="float:right"><a href="#about">Welcome <?php echo $_SESSION['name'];?></a></li>
</ul>

<div class="list-group">
  <a href="./customize/updatebranch.php" class="list-group-item">Update Branch</a>
  <a href="./customize/updatebatch.php" class="list-group-item">Update Batch</a>
  <a href="./customize/genchanges.php" class="list-group-item">Change in general information</a>
</div>


</body>
</html>


