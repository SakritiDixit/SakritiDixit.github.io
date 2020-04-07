<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
if(!isset($_SESSION['roll']))
{
        header("location: index.php");
}
$rollnumber=$_SESSION['roll'];

?>

<html>
<head><title>Lab Manual</title>
<link rel="stylesheet" href="styling1.css">
<link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="./css/dashstyle.css">
</head>
<body>

<div class="header">
     <a href="#" class="logo"><img src="./images/igdtuwLogo.png"></a>
      <a href="#" class="clg-name">Indira Gandhi Delhi Technical University for Women</a>
  </div>

<ul>
  <li><a class="tablink" href="labmanual.php" onclick="current('Lab Manual')">Lab Manual</a></li>
  <li><a class="tablink" href="submissions.php" onclick="current('My Submissions')">My Submissions</a></li>
  <li><a class="tablink" href="editor.php" onclick="current('Go To Editor')">Go To Editor</a></li>
  <li><a id="b3" href="answereddoubts.php">Doubts Raised</a></li>
  <li><a id="b3" href="testcompiler.php">Test Compiler</a></li>
  <li style="float:right"><a href="logout.php">Logout</a></li>
  <li style="float:right"><a href="customize.php">Settings</a></li>
  <li style="float:right"><a href="#about">Welcome <?php echo $_SESSION['name'];?></a></li>
</ul>

        <div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title pb-3 mt-0">LAB MANUAL</h2>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="align-self-center">
                                    <th>Question ID</th>
                                    <th>Question Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $lab_id=$_SESSION['lab'];

                             $s="SELECT * FROM questions_table where LAB_ID='$lab_id'" ;
                             $result=mysqli_query($con,$s);
                             $num=mysqli_num_rows($result);
                            // echo $num;
                             $sno=1;
                             if($num>=1)
                             {

                              while($row = mysqli_fetch_array($result)){
                                $_SESSION['q_name']=$row['Q_NAME'];
                                $_SESSION['q_id']=$row['Q_ID'];
                                $_SESSION['desc']=$row['DESCRIPTION'];
                               echo "<tr>";
                                    echo "<td>";
                                    // echo  $_SESSION['q_id'];
                                    echo $sno;
                                    echo "</td>";
                                    echo "<td>";
                                    echo  $_SESSION['q_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo  $_SESSION['desc'];
                                    echo "</td>";
                                echo "</tr>";
                                $sno=$sno+1;
                              }
                            }
                            else
                                {
                                    echo "No questions added to this lab";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function current(tabname){

tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(tabname).style.display = "block";
  evt.currentTarget.className += " w3-red";
}

    
</script>
</body>
</html>