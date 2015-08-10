<?php

use mvc\routing\routingClass as routing;

$nombre = empresaTableClass::NOMBRE;
$direccion = empresaTableClass::DIRECCION;
$telefono = empresaTableClass::TELEFONO;
$email = empresaTableClass::EMAIL;
$created_at = empresaTableClass::CREATED_AT;


class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('portada4.png'), 0, 0, 210);
    $this->SetFont('Arial', 'B', '15');
    $this->Ln(10);
   # $this->Cell(80);
   # $this->Cell(30, 10, 'Cliente', 1, 0, 'C');
    $this->Ln(30);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Empresa}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(60, 10, "Nombre",1, 0, 'C');
$pdf->Cell(50, 10, "Direccion",1, 0, 'C');
$pdf->Cell(30, 10, "Telefono",1, 0, 'C');
$pdf->Cell(50, 10, "Email",1, 0, 'C');
$pdf->Ln();
foreach ($objEmpresa as $valor) {
  $pdf->Cell(60, 8, utf8_decode($valor->$nombre),1);
  $pdf->Cell(50, 8, utf8_decode($valor->$direccion),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$telefono),1);
  $pdf->Cell(50, 8, utf8_decode($valor->$email),1);
  $pdf->Ln();
}
$pdf->Output();
?>