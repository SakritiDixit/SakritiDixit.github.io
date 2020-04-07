<?php
	session_start();
	if(!isset($_SESSION['roll']))
    {
            header("location: index.php");
    }
    $rollnumber=$_SESSION['roll'];
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'minorproject1');
	$qchosen=$_SESSION['qchosen'];
	$s="SELECT * FROM questions_table WHERE Q_ID='$qchosen'";
	$res=mysqli_query($con,$s);
	$row=mysqli_fetch_array($res);
	$tc=1;
//    putenv("PATH=C:\MinGW\bin");
//putenv("PATH=C:\Program Files (x86)\CodeBlocks\MinGW\bin");
	//$code=$_POST["source_code"];
	//$_SESSION['code']=$code;
	//$score=0;
	// $f=0;
	$test=$_POST['sb'];
	if($test=="Submit"){
		//include("compilers2/cpp.php");
		$stdin=$_POST['stdin'];
		$_SESSION['score']=0;
	//	include("t4.php");
		$_SESSION['source_code']=$_POST['source_code'];
//$_SESSION['temp']='';
$data = array(
    'source_code'      => $_SESSION['source_code'],
    'language_id'    => $_SESSION['language_id'],
    'stdin'  =>  $stdin,
    //'expected_output' => $expected_output
  );
//echo '--';
//echo json_encode( $data );
  $options = array(
    'http' => array(
      'method'  => 'POST',
      'content' => json_encode( $data ),
      'header'=>  "Content-Type: application/json\r\n" .
                  "Accept: application/json\r\n"
      )
  );
  $url="https://api.judge0.com/submissions/?base64_encoded=false&wait=false";
  $context  = stream_context_create( $options );
  $result = file_get_contents( $url, false, $context );
  $response = json_decode( $result );
//echo $response->token;
// $_SESSION['temp']=$response->token;
//$tokens[] = $_SESSION['temp'];
//$_SESSION['tokens'] = array($_SESSION['temp']);
  array_push($_SESSION['tokens'],$response->token);
	//include('C:\xampp\htdocs\Minor\Student\t2.php');
	}
	else
	{

    // $CC="g++";
    // $o="a".strval($rollnumber);
    // $out="a".strval($rollnumber).".exe";
    // $filename_code="main.cpp";
	// $filename_in="input".strval($rollnumber).".txt";
	// $filename_error="error".strval($rollnumber).".txt";
    // $executable="a".strval($rollnumber).".exe";

    // $file_code=fopen($filename_code,"w+");
	// fwrite($file_code,$code);
	// fclose($file_code);
	$expected_output='';
	$stdin='';
	$tokens=array();
	while($tc<=5)
	{
	$testcase="TEST".strval($tc);
	$op="OP".strval($tc);
	$expected_output=$row[$op];
	$stdin=$row[$testcase];

	$_SESSION['source_code']=$_POST['source_code'];
$_SESSION['temp']='';
$data = array(
    'source_code'      => $_SESSION['source_code'],
    'language_id'    => $_SESSION['language_id'],
    'stdin'  =>  $stdin,
    'expected_output' => $expected_output
  );
//echo '--';
//echo json_encode( $data );
  $options = array(
    'http' => array(
      'method'  => 'POST',
      'content' => json_encode( $data ),
      'header'=>  "Content-Type: application/json\r\n" .
                  "Accept: application/json\r\n"
      )
  );
  $url="https://api.judge0.com/submissions/?base64_encoded=false&wait=false";
  $context  = stream_context_create( $options );
  $result = file_get_contents( $url, false, $context );
  $response = json_decode( $result );
//echo $response->token;
$_SESSION['temp']=$response->token;
array_push($_SESSION['tokens'],$response->token);
	$tc=$tc+1;
	}
//	include('C:\xampp\htdocs\Minor\Student\t2.php');
  $_SESSION['input']=$stdin;
}
?>
