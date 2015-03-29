<?php
use mvc\routing\routingClass as routing;

$cre = credencialTableClass::NOMBRE;
$crea = credencialTableClass::CREATED_AT;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
foreach ($objCredencial as $valor){
  $pdf->Cell(40,10, utf8_decode($valor->$cre));
  $pdf->Cell(40,10, utf8_decode($valor->$crea));
  $pdf->Ln();  
  
   
}
$pdf->Output();
?>