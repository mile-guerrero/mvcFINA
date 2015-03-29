<?php
use mvc\routing\routingClass as routing;

          
  $nombb =  maquinaTableClass::NOMBRE;
  $des =  maquinaTableClass::DESCRIPCION;
  $cre =  maquinaTableClass::CREATED_AT;
  $upd =  maquinaTableClass::UPDATED_AT;
  $orig =  origenMaquinaTableClass::DESCRIPCION;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
foreach ($objMaquina as $valor){
  $pdf->Cell(80,10, utf8_decode($valor->$nombb));
  $pdf->Cell(40,10, utf8_decode($valor->$des));
  $pdf->Ln();    
}
$pdf->Ln(); 
$pdf->Ln(); 
foreach ($objMaquina as $valor){
  $pdf->Cell(80,10, utf8_decode($valor->$cre));
  $pdf->Cell(40,10, utf8_decode($valor->$upd));
  $pdf->Ln();    
}
$pdf->Ln(); 
$pdf->Ln();
foreach ($objMOM as $valor){
  $pdf->Cell(40,10, utf8_decode($valor->$des));
  $pdf->Ln();    
}
$pdf->Output();
?>