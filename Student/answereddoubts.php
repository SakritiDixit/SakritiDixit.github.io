<?php
session_start();
if(!isset($_SESSION['lab']))
{
  $labselected=$_POST['labselect'];
$_SESSION['lab']=$labselected;
}

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');

if(!isset($_SESSION['roll']))
{
        header("location: index.php");
}
$rollnumber=$_SESSION['roll'];
$_SESSION['c']='';
$_SESSION['qchosen']='';
$_SESSION['language']='';
// $q="SELECT Q_NAME,DOUBT,ANSWER FROM doubts WHERE ROLL='$rollnumber'";
// $res=mysqli_query($con,$q);
// while($row=mysqli_fetch_array($res)){
//     if($row['ANSWER']=="")
//     $a="not answered yet";
//     else $a=$row['ANSWER'];
// echo $row['Q_NAME']. " " .$row['DOUBT']. " " .$a;
// echo "<br>";
// }
?>
<html>
<head><title>Doubts</title>
<meta charset="utf-8">
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="./css/dashstyle.css">
  <meta content="width=device-width, initial-scale=1" name="viewport">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./css/styling.css">

<style>
    .modal-body{
        white-space: pre-wrap;
        word-wrap: break-word;
    }
  .modal{
  display:none;
}
.mod_total {
    bottom: 50px;
    position: relative;
    left: 280px;
    border: skyblue;
}

.pdf{

    position: relative;
    left: 600px;
}

  </style>
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
<div class="tabular">
<div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="align-self-center">
                                    <th>S.No</th>
                                    <th>Question Name</th>
                                    <th>Doubt</th>
                                    <th>Answer</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php
                                $sno=1;
                                    $q="SELECT Q_NAME,DOUBT,ANSWER FROM doubts WHERE ROLL='$rollnumber'";
                                    $res=mysqli_query($con,$q);
                                    while($row=mysqli_fetch_array($res)){
                                        if($row['ANSWER']=="")
                                        $a="not answered yet";
                                        else $a=$row['ANSWER'];
                                    // echo $row['Q_NAME']. " " .$row['DOUBT']. " " .$a;
                                    echo "<br>";
                                    
                                            echo "<tr>";
                                            echo "<td>";
                                            echo  $sno;
                                            echo "</td>";
                                            echo "<td>";
                                            echo  $row['Q_NAME'];
                                            echo "</td>";
                                            echo "<td>";
                                            echo  $row['DOUBT'];
                                            echo "</td>";
                                            echo "<td>";
                                            echo  $a;
                                            echo "</td>";
                                            
                                             echo "</td>";
                                echo "</tr>";
                                            $sno=$sno+1;
                                            
                                        }
                                    
                                    
                                ?>
                             
                            </tbody>
                        </table>
</div>
</div>

</body>
</html>

