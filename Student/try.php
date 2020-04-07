<?php
session_start();

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'minorproject1');
$lab_id=$_SESSION['lab'];
$roll=$_SESSION['roll'];     
$branch=$_SESSION['branch'];
$g="SELECT LAB_NAME FROM lab WHERE LAB_ID='$lab_id'";
$l=mysqli_query($con,$g);
$lname=mysqli_fetch_array($l)[0];
$exp=array();
$date=array();
$p="SELECT NAME FROM student_registration where ROLL='$roll'";
$rt = mysqli_query($con, $p);
$name=mysqli_fetch_array($rt)[0];
$j="SELECT YEAR FROM stol_map WHERE LAB_ID='$lab_id'";
$jj=mysqli_query($con,$j);
$y=mysqli_fetch_array($jj)[0];
	$w="SELECT questions_table.Q_NAME,qtos_map.DATE FROM qtos_map INNER JOIN questions_table ON qtos_map.Q_ID=questions_table.Q_ID  WHERE questions_table.LAB_ID='$lab_id'&& qtos_map.ROLL='$roll'";
$f=mysqli_query($con,$w);
while($row1=mysqli_fetch_array($f)){
	array_push($exp,$row1['Q_NAME']);
	array_push($date,$row1['DATE']);
}
$s="SELECT questions_table.Q_NAME,qtos_map.SUBMISSION,qtos_map.SCORE,qtos_map.ALGO,qtos_map.OP,qtos_map.INPUT,qtos_map.DATE FROM qtos_map INNER JOIN questions_table ON qtos_map.Q_ID=questions_table.Q_ID  WHERE questions_table.LAB_ID='$lab_id'&& qtos_map.ROLL='$roll'";
$result = mysqli_query($con, $s);
// while($row = mysqli_fetch_array($result)){
	
// }
$sem=Date('m');
if($sem<6)
$sem=$y*2;
else $sem=($y*2)-1;
// $num=mysqli_num_rows();
// while($r=mysqli_fetch_array($result)){
// 	array_push($arr,$r['Q_NAME']);
// }
$GLOBALS['roll']=$roll;
$GLOBALS["name"] = $name;
require('fpdf.php');
	class PDF extends FPDF
{
	function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','I',8);
    // Move to the right
    // $this->Cell(80);
    // Title
    $this->Cell(1,5,$GLOBALS['name']."-".$GLOBALS['roll'],0,0,'L');
    // Line break
    $this->Ln(5);
}
    function Footer()
    {
   $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    //Page number
   $this->Cell(1, 5, "Page " . $this->PageNo() . "/{nb}", 0, 0);
}
function ImprovedTable($header,$exp,$date,$a)
{
    // Column widths
    $w = array(($this->w)/12, ($this->w)/2,($this->w)/6,($this->w)/6 );
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'C');
    $this->Ln();
	// Data
    for($k=1;$k<=count($exp);$k++)
    {
        $this->Cell(($this->w)/12,6,number_format($k),'LR',0,'R');
		$this->Cell(($this->w)/2,6,$exp[$k-1],'LR');
		$this->Cell(($this->w)/6,6,$date[$k-1],'LR',0,'R');
        $this->Cell(($this->w)/6,6,$a,'LR',0,'R');
        // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
}
// require('rotation.php'); 

$i=1;
 
$pdf = new PDF();
$pdf->SetTitle('Download PDF');
$pdf->SetFont('Arial','B',16);
$pdf->AddPage('P');
$pdf->Cell(80);
$pdf->Image('/Applications/XAMPP/xamppfiles/htdocs/Minor/Student/images/igdtuwLogo.png',70,30,70,0,'JPG');
$pdf->Write(4, "\n\n\n");
$pdf->Cell(80);
$pdf->Cell(30,180,"INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN",0,0,'C');
$pdf->Write(3, "\n\n\n");
$pdf->Cell(80);
$pdf->Cell(30,180,"Department of ".$branch,0,0,'C');
$pdf->Write(3, "\n");
$pdf->Cell(80);
$pdf->Cell(30,200,"Lab file for ".$lname."(".$lab_id.")",0,0,'C');
// $pdf->Write(4, "\n\n\n");
// $pdf->Cell(190,200,$lab_id,0,0,'C');
// $pdf->Write(4, "\n\n\n");
$pdf->Cell(80);
$pdf->Write(4, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
$pdf->Cell(0,150,"NAME: ".$name,0,0,'R');
$pdf->Write(4, "\n\n");
$pdf->Cell(0,149,"BATCH: ".$_SESSION['batch'],0,0,'R');
$pdf->Write(4, "\n\n");
$pdf->Cell(0,147,'ENROLLMENT NUMBER: '.$roll,0,0,'R');
$pdf->Cell(0,161,'SEMESTER: '.$sem,'B',0,'R');
$pdf->AddPage('P');
$pdf->Image('/Applications/XAMPP/xamppfiles/htdocs/Minor/Student/images/images.jpg',70,100,70,0,'JPG');
$pdf->Write(4, "\n\n\n");
$pdf->Cell(80);

$pdf->Cell(20,10,'DECLARATION',0,0,'C');
$pdf->Write(4, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
// $pdf->Cell(80);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(20,10,$pdf->Write(5,"I ".$name.", roll number ".$roll."  hereby declare that the lab file is based on my own work carried out during the course of our study and is not copied from any external sources."),0,0,'C');
$pdf->Cell(80);
$pdf->Write(4, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
$pdf->Cell(20,10,"NAME: ".$name,0,0);
$pdf->Write(4, "\n\n");
$pdf->Cell(20,10,"BATCH: ".$_SESSION['batch'],0,0);
$pdf->Write(4, "\n\n");
$pdf->Cell(20,10,'ENROLLMENT NUMBER: '.$roll,0,0);

$pdf->AddPage();
$pdf->Image('/Applications/XAMPP/xamppfiles/htdocs/Minor/Student/images/images.jpg',70,100,70,0,'JPG');
$pdf->Write(4, "\n\n\n");
$pdf->Cell(80);
$pdf->Cell(20,10,'INDEX',0,0,'C');
$pdf->Write(4, "\n\n\n\n");
$header = array('S. No.', 'Experiment','Date', 'Teacher`s Sign');
$sno=1;
$pdf->ImprovedTable($header,$exp,$date,' ');
$c=1;
while($row = mysqli_fetch_array($result))
{
	$qname=$row['Q_NAME'];
	$s=$row['SUBMISSION'];
	$score=$row['SCORE'];
	$algo=$row['ALGO'];
	$input=$row['INPUT'];
	$output= $row['OP'];
	//$pdf->PageNo();
	
	$pdf->AddPage('P');
	$pdf->Image('/Applications/XAMPP/xamppfiles/htdocs/Minor/Student/images/images.jpg',70,100,70,0,'JPG');
	$pdf->PageNo();
	$pdf->AliasNbPages();
	//$pdf->SetAutoPageBreak(false);
 
	// $pdf->Cell(0, 5, "Page " . $pdf->PageNo() . "/{nb}", 0, 0);
	// $pdf->isFinished = true;
	// $pdf->Cell(0,10,'Page '.$i,0,0);
	  //$i++;



	// $pdf->SetXY(30,20);
    $pdf->SetDrawColor(50,60,100);

	//$pdf->Cell(1, 5, "Page " . $pdf->PageNo() . "/{nb}", 0, 0);

	// $pdf->Cell(80);
	$pdf->Write(4, "\n\n\n");
	$pdf->SetFontSize(14);
	$pdf->Cell(0,0,'EXPERIMENT- '.$c,0,0,'C');
	$pdf->Write(4, "\n\n\n");
	$pdf->SetFontSize(12);
	$pdf->Cell(0,5,"AIM: ".$qname,'B',0,'L');
    // $pdf->Ln(50);

	$pdf->SetXY (10,50);
	$pdf->SetFontSize(10);
	$pdf->Write(4, "Algorithm: ");
	$pdf->Write(4, "\n");
	$pdf->Write(4,$algo);
	$pdf->Write(4, "\n\n\n");
	$pdf->Write(4,"Program:\n".$s);

	// $pdf->Write(4, "\n");
	// $pdf->Write(4, "SCORE: ");
	// $pdf->Write(4,$score);
	// //$pdf->Cell(0, 5, "Page " . $pdf->PageNo() . "/{nb}", 0, 0);
	$pdf->Write(4, "\n\n\n");
	
	$pdf->Write(4, "Input: ");
	$pdf->Write(4, "\n");
	$pdf->Write(4,$input);
	//$pdf->Cell(0, 5, "Page " . $pdf->PageNo() . "/{nb}", 0, 0);
	$pdf->Write(4, "\n\n\n");
	$pdf->Write(4, "Output: ");
	$pdf->Write(4, "\n");
	$pdf->Write(4,$output);
	$pdf->Write(4, "\n");
	// $pdf->Cell(0, 100, "Page " . $pdf->PageNo() . "/{nb}", 0, 0);
	// $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,)
	$c=$c+1;
  
}
// $pdf->AddPage('P');
 


$pdf->Output();

?>