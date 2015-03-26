<?php

use mvc\routing\routingClass as routing;

$nom = clienteTableClass::NOMBRE;
$apell = clienteTableClass::APELLIDO;
$dire = clienteTableClass::DIRECCION;
$tel = clienteTableClass::TELEFONO;
$created_at = clienteTableClass::CREATED_AT;
$updated_at = clienteTableClass::UPDATED_AT;
$nomCiu = ciudadTableClass::NOMBRE_CIUDAD;
$habi = ciudadTableClass::HABITANTES;
$desTipo = tipoIdTableClass::DESCRIPCION;

class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('portada4.jpg'), 0, 0, 210);
    $this->SetFont('Arial', 'B', '15');
    $this->Ln(30);
   # $this->Cell(80);
   # $this->Cell(30, 10, 'Cliente', 1, 0, 'C');
    $this->Ln(30);
    
  }
  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Cliente}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
foreach ($objC as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$nom),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$apell),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$dire),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$dire),1);
  $pdf->Cell(30, 10, utf8_decode($valor->$tel),1);
  $pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();
foreach ($objCTI as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$desTipo), 1);
  $pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();
foreach ($objCC as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$nomCiu));
  $pdf->Cell(40, 10, utf8_decode($valor->$habi));
  $pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();
foreach ($objC as $valor) {
  $pdf->Cell(50, 10, utf8_decode($valor->$created_at));
  $pdf->Cell(40, 10, utf8_decode($valor->$updated_at));
  $pdf->Ln();
}
$pdf->Output();
?>