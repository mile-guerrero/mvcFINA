<?php
use mvc\routing\routingClass as routing;

$usu = usuarioTableClass::USUARIO;
$cre = credencialTableClass::NOMBRE;
$created = usuarioCredencialTableClass::CREATED_AT;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
foreach ($objU as $valor){
  $pdf->Cell(40,10, utf8_decode($valor->$usu));
  $pdf->Ln();   
}
$pdf->Ln();
$pdf->Ln();
foreach ($objC as $valor){
  $pdf->Cell(40,10, utf8_decode($valor->$cre));
  $pdf->Ln();   
}
$pdf->Output();
?>