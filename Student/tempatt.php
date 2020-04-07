<?php
session_start();
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');

$con2=mysqli_connect('localhost','root','');
mysqli_select_db($con2,'attendance1');
$b="A1";
$d="2020-02-05";
$k="DATE";
// $q2="SELECT COUNT(DATE) FROM `bcs-206-old` WHERE BATCH='$b' && DATE<='$d' GROUP BY DATE";
// $res2=mysqli_query($con2,$q2);
// if(!$res2){
//     echo mysqli_error($con2);
// }
// echo mysqli_fetch_array($res2)[0];
echo "TOTAL: 5";
echo "<br>";
$q="SELECT DISTINCT ROLL FROM `bcs-206-old` WHERE BATCH='$b' && DATE<='$d' ORDER BY ROLL";
$res=mysqli_query($con2,$q);
if(!$res){
    echo mysqli_error($con2);
}
echo "A1<br>";
while($row=mysqli_fetch_array($res)){
    echo $row['ROLL']. " ";
    $t=$row['ROLL'];
    $q1="SELECT COUNT('$t') FROM `bcs-206-old` WHERE ROLL='$t'";
    $res1=mysqli_query($con2,$q1);
    echo mysqli_fetch_array($res1)[0];
    echo "<br>";
}
$b='B1';
$q="SELECT DISTINCT ROLL FROM `bcs-206-old` WHERE BATCH='$b' && DATE<='$d' ORDER BY ROLL";
$res=mysqli_query($con2,$q);
if(!$res){
    echo mysqli_error($con2);
}
echo "<br><br>";
echo "TOTAL: 7<br>";
echo "B1<br>";
while($row=mysqli_fetch_array($res)){
    echo $row['ROLL']. " ";
    $t=$row['ROLL'];
    $q1="SELECT COUNT('$t') FROM `bcs-206-old` WHERE ROLL='$t'";
    $res1=mysqli_query($con2,$q1);
    echo mysqli_fetch_array($res1)[0];
    echo "<br>";
}
?>