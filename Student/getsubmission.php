<?php
session_start();
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

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
$q = intval($_GET['q']);

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$roll=$_SESSION['roll'];
$sql="SELECT SUBMISSION FROM qtos_map WHERE Q_ID = '$q' && ROLL='$roll'";
$result = mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
// $_SESSION['c']=$row['SUBMISSION'];
echo $row['SUBMISSION'];
?>