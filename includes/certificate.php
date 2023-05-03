<?php
require_once '../vendor/fpdf/fpdf.php';

function generateCertificate($name, $course) {
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,10,"Certificate of Completion",0,1,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,10,"This is to certify that",0,1,'C');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,10,$name,0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,10,"has successfully completed the course",0,1,'C');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,10,$course,0,1,'C');
	$pdf->Output('certificate.pdf', 'F');
}
?>
