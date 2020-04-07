<?php
    session_start();
    $page = $_SERVER['PHP_SELF'];
$sec = "2";
	if(!isset($_SESSION['roll']))
    {
            header("location: index.php");
    }
    $rollnumber=$_SESSION['roll'];
    if($_SESSION['f']==0){
		$stdin=$_POST['stdin'];
		$_SESSION['source_code']=$_POST['source_code'];
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
  $_SESSION['k']=$response->token;
}
$_SESSION['f']=1;
  $u="https://api.judge0.com/submissions/" . $_SESSION['k'] . "?base64_encoded=false&fields=stdout,expected_output,status";
$xml = file_get_contents($u);
$pj = json_decode($xml); 
echo $pj->stdout."<br>";
echo $pj->status->description;
if($pj->status->description=='Processing'||$pj->status->description=='In Queue'){?>
     <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
        <?php
         echo "Wait";
     }else {
         echo "done"; 
         echo "<br>";
         echo "<a href='testcompiler.php' class='previous'>&laquo; Back to Test Editor</a>";
     }
     echo "<br>";
//   header('location:testcompile1.php');
//   $u="https://api.judge0.com/submissions/" . $response->token . "?base64_encoded=false&fields=stdout,expected_output,status";
//   $xml = file_get_contents($u);
  
//   $pj = json_decode($xml); 	
//   echo $pj->stdout;
?>
