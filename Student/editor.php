<?php
session_start();
$_SESSION['root']=0;
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
if(!isset($_SESSION['roll']))
{
        header("location: index.php");
}
$rollnumber=$_SESSION['roll'];
$c=$_SESSION['c'];
$row='';
$_SESSION['q']=0;
$_SESSION['score']=10;
$_SESSION['tt']=0;
$_SESSION['tokens']=array();
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

<!DOCTYPE html>
<html lang="en">
<head>
<title>Editor</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/styling.css">
<style>

* {
  box-sizing: border-box;
}

a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #4CAF50;
  color: black;
}

.modal-body{
  white-space: pre-wrap;
  word-wrap: break-word;
}

.doubtModal{
  display: none;
  top: 0;
}
.testModal{
  display: none;
  top: 0;
}
.algoModal{
  display: none;
  top: 0;
}
body {
  margin: 0;
}
#editor { 
  position: absolute;
  top: 10%;
  right: 0;
  bottom: 0;
  left: 25%;
  width: 75%;
}

/* Style the header */
.header {
  background-color: #f1f1f1;
  padding: 20px;
  text-align: center;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 15px;
  padding-left: 120px;
  padding-right: 120px;
  text-decoration: none;
  font-size:14px;
}

/* Change color on hover */
.topnav a:hover , .dropdown:hover .dropbtn{
  background-color:#A9A9A9;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
}

a.close{
background-color:inherit;
color: black;
padding: 10px 5px;
text-align : right;
cursor: pointer;
transition: 0.3s;
}

.Questions button{
display:block;
background-color:inherit;
color: black;
padding: 10px 14px;
width : 100% ;
border : 1px solid #555555;
word-wrap:break-word;
outline:none;
text-align : left;
cursor: poitner;
transition: 0.3s;
font-size: 14px;

}

.Questions button:hover{
background-color: #ddd;
}


/* Left and right column */
.column.side {
  width: 25%;
}


/* Middle column */
.column.middle {
  width: 50%;
}

/*top nav editor button */
.dropdown {
 float: left;
 overflow: hidden;
}

.dropdown .dropbtn{
font-size:14px;
border:none;
outline:none;
padding: 14px 16px;
padding-left: 120px;
padding-right: 120px;
font-family: inherit;
margin:50;
color:white;
background-color: #333;
}

.dropdown-content{
display: none;
position: absolute;
background-color: #f9f9f9;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

.dropdown-content a{
float: none;
color : black;
padding : 12px 16px;
display: block;
text-align : left;
text-decoration: none;
}

.dropdown-content a:hover {
background-color: #ddd; 
}

.dropdown:hover .dropdown-content{
display:block;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.fixedbutton {
  position: absolute;
right:    0;
bottom:   0;
z-index:2;
}
/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }

}
</style>
</head>
<body>
<div class="row">
    <div class="column side">
    <a href="mydashboard.php" class="previous">&laquo; Back to Dashboard</a>
    <h2>Questions</h2>
      <div class="Questions">
        <?php
        $lab_id = $_SESSION['lab'];
        $s = "SELECT * FROM questions_table where LAB_ID='$lab_id'";
        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);
        $sno=1;
        while ($row = mysqli_fetch_array($result)) {
          ?>
          <div class="container">
            <button type="button" class="openmodal myBtn" data-toggle="modal" data-target="#myModal">
            <?php
              $_SESSION['q_name']=$row['Q_NAME'];
              $_SESSION['q_id']=$row['Q_ID'];
              $_SESSION['des']=stringtoHTML($row['DESCRIPTION']);
              echo "<tr>";
              echo "<td>";
              // echo  $_SESSION['q_id'];
             echo $sno;
              echo " ";
              echo $_SESSION['q_name'];
              echo "<br>";
              echo "</td>";
              echo "</tr>";
            ?>
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
                    <a class="close" data-dismiss="modal">&times;</a>
                  </div>
                  <div class="modal-body">
                    <?php
                      echo $_SESSION['des'];
                    ?>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
               </div>
          </div>
        <?php
        $sno=$sno+1;
        }
        ?>
        <script>
          var modals = document.getElementsByClassName('modal');
          // Get the button that opens the modal
          var btns = document.getElementsByClassName("openmodal");
          var spans = document.getElementsByClassName("close");
          for (let i = 0; i < btns.length; i++) {
            btns[i].onclick = function() {
              modals[i].style.display = "block";
            }
          }
          for (let i = 0; i < spans.length; i++) {
            spans[i].onclick = function() {
              modals[i].style.display = "none";
            }
          }
        </script>
         
      </div>
    </div>
    <div class="column middle">
    
    <form onsubmit="return on_submit()" action="compile.php" method="post" id="form1">
     
      <div style="display: flex;
    justify-content: space-between;  ">
      <select name="question" class="form-control" style="display:inline-block;margin-right:10px;" form=form1 onchange="showUser(this.value)">
    <?php
    $sql="SELECT Q_NAME,Q_ID FROM questions_table WHERE LAB_ID='$lab_id'";

    $result=mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result))
    {
        if($_SESSION['qchosen']!=''&&$row['Q_ID']==$_SESSION['qchosen'])
        echo "<option value='". $row['Q_ID'] ."' selected>" .$row['Q_NAME'] ."</option>" ;
        else
        echo "<option value='". $row['Q_ID'] ."'>" .$row['Q_NAME'] ."</option>" ;

    }



    ?>
    </select>

        <select class="form-control" name="language_id" style="display:inline-block;">
        <?php
          // $array = array("C", "C++", "Java");
          // for($i=0;$i<sizeof($array);$i++)
          // {
          //   if($_SESSION['language']!=''&&$array[$i]==$_SESSION['language'])
          //     echo "<option value='". $array[$i] ."' selected>" .$array[$i] ."</option>" ;
          //     else
          //     echo "<option value='". $array[$i] ."'>" .$array[$i] ."</option>" ;
          // }
        ?>
        <option value=48>C</option>" ;
        <option value=52>C++</option>" ;
        <option value=62>Java</option>" ;
        </select>
         </div>
        </div>
  </div>
        </div>
        

         <div id="editor"><?php echo stringtoHTML($c); ?></div>
          <!-- <textarea  id="ace_js_control" name="ace_js_control" value="wrote your code here"></textarea> -->
          <textarea type="hidden" class="form-control" name="source_code" id="code" style="display:none;"></textarea><br><br>
          <!-- <textarea type="hidden" class="form-control" name="input" style="display:none;"></textarea><br><br> -->

<script src="js/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
function showUser($q_id) {
  if ($q_id=="") {
    // document.getElementById("editor").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Minor");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/javascript");
      // document.getElementById("editor").innerHTML=this.responseText;
      editor.setValue(this.responseText);
      // this.responseText;
    }
  }
  xmlhttp.open("GET","getsubmission.php?q="+$q_id,true);
  xmlhttp.send();
}
</script>         
<script>
  var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/javascript");
    var input = $('input[name="editor"]');
        editor.getSession().on("change", function () {
        input.val(editor.getSession().getValue());
    });
    function on_submit() {
        document.getElementById("code").value = editor.getValue();
        $input=document.getElementById("code").value;
    }
</script>

<div id="testModal" class="testModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      Test
                    </h4>
                    <span class="close3">&times;</span>
                  </div>
                  <div class="modal-body">
                    <form action="compile.php" method="post" id="formx"> 
                    <h5>Enter custom test input:</h5> 
                    <textarea  class="form-control" name="stdin" id="input"></textarea><br><br>
                    <input name="sb" type="submit" value="Submit" class="btn3" />
                    </form>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
               </div>
</div>
</form>

    </div>
  </div>
  <form action="doubts.php" id="form2" method="post">
  </form>
  <div class="fixedbutton">
<script src="/lib/aceeditor/src-min/ace.js" type="text/javascript" charset="utf-8"></script>
<button style="float: left;padding: 14px 40px;
  border: 1px solid green;background-color: #4CAF50;" id="st" form=form1>Submit</button>
<button style="float: left;padding: 14px 40px;
  border: 1px solid green; background-color: #4CAF50;" id="testBtn" form=formx>Test</button>
<button style="float: left;padding: 14px 40px;
  border: 1px solid green;background-color: #4CAF50;" id="doubtBtn">Doubts</button>
  <button style="float: left;padding: 14px 40px;
  border: 1px solid green;background-color: #4CAF50;" id="algoBtn">Algorithm</button>
</div>
</div>

<div id="algoModal" class="algoModal" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      Algorithm
                    </h4>
                    <span class="close4">&times;</span>
                  </div>
                  <div class="modal-body">
                    <form action="algo.php" method="post">
                    <h5>Select Question:</h5>
                    <select name="qselect" class="form-control">
                    <?php
                    $labid = $_SESSION['lab'];
                    $st = "SELECT * FROM questions_table where LAB_ID='$labid'";
                    $res = mysqli_query($con, $st);
                    while ($row = mysqli_fetch_array($res)) {
                      echo "<option value='". $row['Q_ID'] ."'>" .$row['Q_NAME'] ."</option>" ;
                    }
                      ?>
                    </select>
                    <textarea name="algorithm" data-name="algorithm" id="algorithm" placeholder="Write the algorithm"></textarea>
                    <button type="submit" class="btn4">Submit</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
               </div>
</div>

<div id="doubtModal" class="doubtModal" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      Doubt 
                    </h4>
                    <span class="close2">&times;</span>
                  </div>
                  <div class="modal-body">
                    <form action="doubts.php" method="post">
                    <h5>Select Question:</h5>
                    <select name="qselect" class="form-control">
                    <?php
                    $labid = $_SESSION['lab'];
                    $st = "SELECT * FROM questions_table where LAB_ID='$labid'";
                    $res = mysqli_query($con, $st);
                    while ($row = mysqli_fetch_array($res)) {
                      echo "<option value='". $row['Q_ID'] ."'>" .$row['Q_NAME'] ."</option>" ;
                    }
                      ?>
                    </select>
                    <textarea name="doubt" data-name="doubt" id="doubt" placeholder="Describe your doubt"></textarea>
                    <button type="submit" class="btn2">Submit</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
               </div>
</div>


<script>
// Get the modal
var modal2 = document.getElementById("doubtModal");
var modal3 = document.getElementById("testModal");
var modal4 = document.getElementById("algoModal");
// Get the button that opens the modal
var btn2 = document.getElementById("doubtBtn");
var btn3 = document.getElementById("testBtn");
var btn4 = document.getElementById("algoBtn");
// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];
var span3 = document.getElementsByClassName("close3")[0];
var span4 = document.getElementsByClassName("close4")[0];
// When the user clicks the button, open the modal 
btn2.onclick = function() {
  modal2.style.display = "block";
}
btn3.onclick = function() {
  modal3.style.display = "block";
}
btn4.onclick = function() {
  modal4.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modal2.style.display = "none";
}
span3.onclick = function() {
  modal3.style.display = "none";
}
span4.onclick = function() {
  modal4.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}
window.onclick = function(event) {
  if (event.target == modal3) {
    modal3.style.display = "none";
  }
}
window.onclick = function(event) {
  if (event.target == modal4) {
    modal4.style.display = "none";
  }
}
</script>

</body>
</html>
