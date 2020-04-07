


<?php
$options = array(
    'http' => array(
      'method'  => 'POST',
     
      'header'=>  "Content-Type: application/json\r\n" .
                  "Accept: application/json\r\n" .
                  "X-Auth-User: c9a7abd3-b073-4647-8764-2276da070690\r\n"
      )
  );
  $url="https://api.judge0.com/authenticate";
  $context  = stream_context_create( $options );
  $result = file_get_contents( $url, false, $context );
  $response = json_decode( $result );
  $options = array(
    'http' => array(
      'method'  => 'POST',
     
      'header'=>  "Content-Type: application/json\r\n" .
                  "Accept: application/json\r\n" .
                  "X-Auth-User: c9a7abd3-b073-4647-8764-2276da070690\r\n"
      )
  );
  // $url="https://api.judge0.com/authorize";
  $url="https://api.judge0.com/submissions/?base64_encoded=false&wait=false";
  $context  = stream_context_create( $options );
  $result = file_get_contents( $url, false, $context );
  $response = json_decode( $result );

echo $response;
?> 
<!-- <!DOCTYPE html>
<html lang="en">
<head>
<title>Output</title>
</head>
<body>
<?php
//session_start();


// $page = $_SERVER['PHP_SELF'];
// $sec = "2";
// //$temp=$_SESSION['temp'];
// for ($i = 0; $i <count($tokens); $i++) {
//   // echo "The number is: $x <br>";
// $u="https://api.judge0.com/submissions/" . $tokens[$i] . "?base64_encoded=false&fields=stdout,expected_output,status";
// $xml = file_get_contents($u);
// $pj = json_decode($xml);
//  echo $u ;
//  echo '==';
//  echo $xml;
//  echo '++';
//  //echo $_SESSION['tc'];
//  //echo $pj->status->description;
// // if($pj->stdout!=$pj->expected_output)
// if($pj->status->description=='Wrong Answer')
//  $_SESSION['score']=$_SESSION['score']-2;
//  if(count($tokens)!=1)
//  echo $_SESSION['score'];
//  echo '<br>';
// }
//  echo '+';
//  echo $_SESSION['score'];
//  echo '*';
?>
        <?php
    //      if($pj->status->description=='Processing'||$pj->status->description=='In Queue'){?>
    // <meta http-equiv="refresh" content="<?php// echo $sec?>;URL='<?php //echo $page?>'">
        <?php
    //     echo "Wait";
    // }else echo "done"; ?>
   <a href="editor.php" class="previous">&laquo; Back to Editor</a> -->
<!-- </body> -->
<!-- </html> --> 
