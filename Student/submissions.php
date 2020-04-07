<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');

function stringtoHTML($str)
{
    $r="<br>";
    for($i=0; $i<strlen($str); $i++) 
     {
        if($str[$i]=="<")
            $r=$r."&lt";
        else if($str[$i]==">")
            $r=$r."&gt";
        else
            $r= $r.$str[$i];
     }  
     $r=$r."<br>";  
    return $r;
}

?>

<html>
<head><title>Submissions</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="styling1.css">
<link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="./css/dashstyle.css">
</head>
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

        <div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title pb-3 mt-0">Submissions</h2>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="align-self-center">
                                    <th>S.No</th>
                                    <th>Question Name</th>
                                    <th>Score</th>
                                    <th>Submission</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $sno=1;
                             $lab_id=$_SESSION['lab'];
                             $roll=$_SESSION['roll'];                          
                             $s="SELECT questions_table.Q_NAME,qtos_map.SUBMISSION,qtos_map.SCORE FROM qtos_map INNER JOIN questions_table ON qtos_map.Q_ID=questions_table.Q_ID WHERE questions_table.LAB_ID='$lab_id'&& qtos_map.ROLL='$roll'" ;
                             $result=mysqli_query($con,$s);
                             $num=mysqli_num_rows($result);
                             $total= 0;                      
                             if($num>=1)
                             {
                              while($row = mysqli_fetch_array($result)){
                                $_SESSION['q_name']=$row['Q_NAME'];
                                $_SESSION['score']=$row['SCORE'];
                                $_SESSION['submit']=$row['SUBMISSION'];

                                $temp='#'.strval($sno);
                                $submission=stringtoHTML($_SESSION['submit']);
                                    echo "<tr>";
                                    echo "<td>";
                                    echo  $sno;
                                    echo "</td>";
                                    echo "<td>";
                                    echo  $_SESSION['q_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo  $_SESSION['score'];
                                    echo "</td>";
                                    echo "<td>";
                                    $total+=$_SESSION['score'];
                                    ?>


                                            <!-- <button class="openmodal myBtn">View Submission</button>

                                            
                                            <div class="modal myModal">

                                            
                                            <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <p></p>
                                            </div>
                                            </div> -->

                                    <div class="container">
                                    <button type="button" class="openmodal myBtn" data-toggle="modal" data-target="#myModal">
                                        View Submission
                                    </button>

                                    
                                    <div class="modal myModal">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                        
                                            
                                            <div class="modal-header">
                                            <h4 class="modal-title">
                                            <?php
                                                    echo $_SESSION['q_name'];
                                            ?>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            
                                            <div class="modal-body">
                                            <?php
                                                    echo $submission;
                                            ?>
                                            </div>
                                            
                                            
                                            <div class="modal-footer">
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </div>
                                    
                                    </div>


                                    <?php
                                    echo "</td>";
                                echo "</tr>";
                                $sno=$sno+1;
                              }
                            }
                            else
                                {
                                    echo "You have made no submissions till now. :("; 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <div class= "mod_total">
<?php
echo " &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TOTAL &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp";
echo $total."/".($sno-1)*10;
?>
</div>
   
</div>
<div class= "pdf">
<p><b>Click below to download PDF</b> 
        </p> 
        <a href="try.php?file=try">Download PDF Now</a>
</div>
<script>
  var modals = document.getElementsByClassName('modal');
// Get the button that opens the modal
var btns = document.getElementsByClassName("openmodal");
var spans=document.getElementsByClassName("close");
for(let i=0;i<btns.length;i++){
    btns[i].onclick = function() {
        modals[i].style.display = "block";
    }
}
for(let i=0;i<spans.length;i++){
    spans[i].onclick = function() {
        modals[i].style.display = "none";
    }
}

</script>
</body>

</html>