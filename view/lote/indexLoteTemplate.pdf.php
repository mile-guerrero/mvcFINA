<?php
use mvc\routing\routingClass as routing;

$ubi = loteTableClass::UBICACION;
$tamano = loteTableClass::TAMANO;
$des = loteTableClass::DESCRIPCION;
$created_at = loteTableClass::CREATED_AT;
$updated_at = loteTableClass::UPDATED_AT;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
foreach ($objLote as $valor){
  $pdf->Cell(80,10, utf8_decode($valor->$ubi));
  $pdf->Cell(40,10, utf8_decode($valor->$tamano));
  $pdf->Ln();  
}
$pdf->Ln(); 
$pdf->Ln(); 
foreach ($objLote as $valor){
  $pdf->Cell(80,10, utf8_decode($valor->$des));
  $pdf->Ln();  
}
$pdf->Ln(); 
$pdf->Ln(); 
foreach ($objLote as $valor){
  $pdf->Cell(80,10, utf8_decode($valor->$created_at));
  $pdf->Cell(40,10, utf8_decode($valor->$updated_at));
  $pdf->Ln();  
}
$pdf->Output();
?>