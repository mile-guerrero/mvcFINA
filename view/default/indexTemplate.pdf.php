<?php
use mvc\routing\routingClass as routing;

$usu = usuarioTableClass::USUARIO;
$actived = usuarioTableClass::ACTIVED;
$cre = usuarioTableClass::CREATED_AT;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
foreach ($objUsu as $valor){
  $pdf->Cell(40,10, utf8_decode($valor->$usu));
  $pdf->Cell(40,10, utf8_decode($valor->$actived));
  $pdf->Cell(40,10, utf8_decode($valor->$cre));
  $pdf->Ln();   
}
$pdf->Output();
?>