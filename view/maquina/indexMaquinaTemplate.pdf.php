<?php
use mvc\routing\routingClass as routing;

          
  $nom =  maquinaTableClass::NOMBRE;
  $des =  maquinaTableClass::DESCRIPCION;
  $cre =  maquinaTableClass::CREATED_AT;
  $upd =  maquinaTableClass::UPDATED_AT;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
foreach ($objM as $valor){
  $pdf->Cell(80,10, utf8_decode($valor->$nom));
  $pdf->Cell(40,10, utf8_decode($valor->$des));
  $pdf->Ln();    
}
$pdf->Ln(); 
$pdf->Ln(); 
foreach ($objM as $valor){
  $pdf->Cell(80,10, utf8_decode($valor->$cre));
  $pdf->Cell(40,10, utf8_decode($valor->$upd));
  $pdf->Ln();    
}
$pdf->Output();
?>