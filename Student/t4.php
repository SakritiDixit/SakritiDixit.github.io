<?php
// session_start();
 $con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
$_SESSION['source_code']=$_POST['source_code'];
//$_SESSION['stdin']=$_POST['stdin'];
$_SESSION['temp']='';
$tokens=array();
// echo 'exp o/p:';
// 	echo $expected_output;

// 	echo 'i/p:';
// 	echo $stdin;
	
	
//echo $_POST['source_code'];
$data = array(
    'source_code'      => $_SESSION['source_code'],
    'language_id'    => $_SESSION['language_id'],
    //'stdin'  =>  $_SESSION['stdin'],
    'stdin'  =>  $stdin,
    //'expected_output' => $_SESSION['expected_output']
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
$tokens[]=$response->token;
//header('location:t2.php');
include('t2.php');

/*
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

 $ss=stringtoHTML($_POST['source_code']);
 $li=$_POST['language_id'];
 //$ss=stringtoHTML($ss);
 echo $_POST['source_code'];
 echo "--";
 echo $li;
 echo "--";
 $url = 'https://api.judge0.com/submissions/?base64_encoded=false&wait=false';
$myvars = 'source_code=' . $ss . '&language_id=' . $li;
echo $myvars;
$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
$pjs = json_decode($response);
$temp= $pjs->token;
echo $temp;
echo "...";
*/

//echo $response->token;
// $u="https://api.judge0.com/submissions/" . $temp . "?base64_encoded=false&fields=stdout,stderr,status_id,language_id";
// $xml = file_get_contents($u);
// //$xml = file_get_contents("https://api.judge0.com/submissions/?base64_encoded=false&wait=false");
// //json_decode($xml);
// //$pj = json_decode($xml);
// echo $u ;
// echo '==';
// echo $xml;
// ?>