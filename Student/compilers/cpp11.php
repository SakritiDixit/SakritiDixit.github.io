<?php

	session_start();
	
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'minorproject1');
	$qchosen=$_POST["question"];
	$_SESSION['qchosen']=$qchosen;
	$s="SELECT * FROM questions_table WHERE Q_ID='$qchosen'";
	$res=mysqli_query($con,$s);
	$row=mysqli_fetch_array($res);
	$tc=1;
    putenv("PATH=C:\MinGW\bin");
	$code=$_POST["code"];
	$_SESSION['code']=$code;
	$score=0;
	$test=$_POST['sb'];
	if($test=="Submit"){
		include("compilers2/cpp11.php");
	}
	else
	{
	while($tc<=5)
	{
	$testcase="TEST".strval($tc);
	$op="OP".strval($tc);
	$CC="g++ -std=c++11";
	$out="a.exe";
	if($k==0){
		$input=$row[$testcase];
		}
		else{
			$input=$_POST['input'];
		}
	
	//$input=$row[$testcase];
	echo '<br>';
	$filename_code="main.cpp";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.exe";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;

	//if(trim($code)=="")
	//die("The code area is empty");
	
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	exec("cacls  $executable /g everyone:f"); 
	exec("cacls  $filename_error /g everyone:f");	

	shell_exec($command_error);
	$error=file_get_contents($filename_error);

	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		if($output==$row[$op])
			{
				echo "Correct Answer";
				$score=$score+2;
			}
		else
			echo "Incorrect Answer";
			echo '<br>';
			echo "Input: "+$input;
			echo '<br>';
			echo "Output: "+$output;
			echo '<br>';
			echo "Expected Output: "+$row[$op];
	}
	else if(!strpos($error,"error"))
	{
		echo "<pre>$error</pre>";
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}

		if($output==$row[$op])
			{
				echo "Correct Answer";
				$score=$score+2;
			}
		else
			echo "Incorrect Answer";
			echo '<br>';
			echo "Input: "+$input;
			echo '<br>';
			echo "Output: "+$output;
			echo '<br>';
			echo "Expected Output: "+$row[$op];
	}
	else
	{
		echo "<pre>$error</pre>";
	}
	exec("del $filename_code");
	exec("del *.o");
	exec("del *.txt");
	exec("del $executable");
	$tc=$tc+1;
	echo '<br>';
	echo '<br>';

	}
	$_SESSION['score']=$score;
	}

?>
