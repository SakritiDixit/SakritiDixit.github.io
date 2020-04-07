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

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/dashstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
  
  <li style="float:right"><a href="logout.php">Logout</a></li>
  <li style="float:right"><a href="customize.php">Settings</a></li>
  <li style="float:right"><a href="#about">Welcome <?php echo $_SESSION['name'];?></a></li>
</ul>

<form action="updatebranch.php" method="post">
    <div class="abcd">
        <div class="chlab">
            <p>Old Branch:</p>
        </div>
        <div class="efgh">
            <select name="oldb" class="form-control">
                <option value="CSE">CSE</option>
                <option value="IT">IT</option>
                <option value="ECE">ECE</option>
                <option value="MECH">MECH</option>
            </select>
        </div>

        <div class="chlab">
            <p>New Branch:</p>
        </div>
        <div class="efgh">
            <select name="newb" class="form-control">
                <option value="CSE">CSE</option>
                <option value="IT">IT</option>
                <option value="ECE">ECE</option>
                <option value="MECH">MECH</option>
            </select>
        </div>
    </div>
    <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
</form>

<?php
$oldb='';
$newb='';
if(isset($_POST['submit'])) {
                                
    if($_POST['oldb']) {
      $oldb=$_POST['oldb'];
    }
    else
    {
    ?>
        <script>
        window.alert("Please fill Old Branch field!");
        </script>
    <?php
    }
    if($_POST['newb']) {
        $newb=$_POST['newb'];
    }
    else
    {
    ?>
        <script>
        window.alert("Please fill New Branch field!");
        </script>
    <?php
    }

    if($oldb&&$newb)
    {
        $roll=$_SESSION['roll'];
        $s="SELECT BRANCH FROM student_registration WHERE ROLL='$roll'";
        $result=mysqli_query($con,$s);
        
        $row=mysqli_fetch_array($result);

        if($oldb==$row['BRANCH'])
        {
            $f= "UPDATE student_registration set BRANCH='$newb' where ROLL='$roll'";
            $result=mysqli_query($con,$f);
            header('location:../customize.php');
        }

        else
        {
            ?>
                <script>
                window.alert("Incorrect Old Branch");
                </script>
            <?php
        }
    }
}

?>

</body>
</html>


