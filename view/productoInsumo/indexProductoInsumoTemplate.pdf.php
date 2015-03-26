<?php
use mvc\routing\routingClass as routing;
  
  $des = productoInsumoTableClass::DESCRIPCION;
  $iva = productoInsumoTableClass::IVA;
  $cre = productoInsumoTableClass::CREATED_AT;
  $upd = productoInsumoTableClass::UPDATED_AT;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
foreach ($objPI as $valor){
  $pdf->Cell(60,10, utf8_decode($valor->$des));
  $pdf->Cell(40,10, utf8_decode($valor->$iva));
  $pdf->Ln();  
}
$pdf->Ln(); 
$pdf->Ln(); 
foreach ($objPI as $valor){
  $pdf->Cell(60,10, utf8_decode($valor->$cre));
  $pdf->Cell(40,10, utf8_decode($valor->$upd));
  $pdf->Ln();  
}
$pdf->Output();
?>