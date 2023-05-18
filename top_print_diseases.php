<?php

include("./pdflib/logics-builder-pdf.php");
include './config/connection.php';


$reportTitle = "Top 10 MORBIDITY";
$from = $_GET['from'];
$to = $_GET['to'];


$fromArr = explode("/", $from);
$toArr = explode("/", $to);

$fromMysql = $fromArr[2].'-'.$fromArr[0].'-'.$fromArr[1];
$toMysql = $toArr[2].'-'.$toArr[0].'-'.$toArr[1];

$pdf = new LB_PDF('L', false, $reportTitle, $from, $to);
$pdf->SetMargins(50, 10);
$pdf->AliasNbPages();
$pdf->AddPage();

$titlesArr = array('Rank No.',  'Disease', 'Number of Patients');

$pdf->SetWidths(array(50, 70, 70));
$pdf->SetAligns(array('L', 'L', 'L'));
// $pdf->Ln();
// $pdf->Ln();
 $pdf->Ln(15);

$pdf->AddTableHeader($titlesArr);
$query = "SELECT 
DENSE_RANK() OVER(ORDER BY t.count DESC) as 'Rank',
t.disease as 'Disease',
t.count as 'Count' 
FROM (
SELECT disease,COUNT(disease) as 'count'
FROM patient_visits
   WHERE `visit_date` between '$fromMysql' and '$toMysql'
GROUP BY disease
) t  LIMIT 10";
$stmt = $con->prepare($query);
$stmt->execute();

$i = 0;
while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$i++;

	$data = array($i, 
		
		$r['Disease'],
		$r['Count']
	
	);

	$pdf->AddRow($data);

}
$pdf->Output('top10 diseases.pdf', 'I');
?>