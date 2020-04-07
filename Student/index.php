<?php
if(!session_id()) session_start();
$filename = 0;
if(!isset($_SESSION['filename'])) {
    $_SESSION['filename'] = $filename;
}
// if(isset($_SESSION['ROLL']))
// 	session_destroy();
header('location:frontPage.php');

?>