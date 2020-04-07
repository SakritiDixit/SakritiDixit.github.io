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
    putenv("PATH=C:\Program Files\Java\jdk-13.0.2\bin");
	$code=$_POST["code"];
	$_SESSION['code']=$code;
	$score=0;
	$test=$_POST['sb'];
	if($test=="Submit"){
		include("compilers2/java.php");
	}
	else
	{

	while($tc<=5)
	{
	$testcase="TEST".strval($tc);
	$op="OP".strval($tc);
	// echo $op;
	// echo $row[$op];
		// $tc=$tc+1;

	$CC="javac";
	$out="java Main";
	$input=$row[$testcase];
	echo '<br>';
	$filename_code="Main.java";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$runtime_file="runtime.txt";
	$executable="*.class";
	$command=$CC." ".$filename_code;
	$command_error=$command." 2>".$filename_error;
	$runtime_error_command=$out." 2>".$runtime_file;

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
			shell_exec($runtime_error_command);
			$runtime_error=file_get_contents($runtime_file);
			$output=shell_exec($out);
		}
		else
		{
			shell_exec($runtime_error_command);
			$runtime_error=file_get_contents($runtime_file);
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
			echo "Input: ".$input;
			echo '<br>';
			echo "Output: ".$output;
			echo '<br>';
			echo "Expected Output: ".$row[$op];
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
			echo "Input: ".$input;
			echo '<br>';
			echo "Output: ".$output;
			echo '<br>';
			echo "Expected Output: ".$row[$op];
	}
	else
	{
		echo "<pre>$error</pre>";
	}
	exec("del $filename_code");
	exec("del *.txt");
	exec("del $executable");
	$tc=$tc+1;
	echo '<br>';
	echo '<br>';

	}
	$_SESSION['score']=$score;
	}
?>
