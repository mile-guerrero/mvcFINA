<?php

use mvc\routing\routingClass as routing;

$documento = trabajadorTableClass::DOCUMENTO;
$nom = trabajadorTableClass::NOMBRET;
$apell = trabajadorTableClass::APELLIDO;
$dire = trabajadorTableClass::DIRECCION;
$tel = trabajadorTableClass::TELEFONO;
$email = trabajadorTableClass::EMAIL;
$created_at = trabajadorTableClass::CREATED_AT;
$updated_at = trabajadorTableClass::UPDATED_AT;
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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Trabajador}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
foreach ($objT as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$documento),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$nom),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$apell),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$dire),1);
  $pdf->Cell(30, 10, utf8_decode($valor->$tel),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$email),1);
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
  $pdf->Cell(40, 10, utf8_decode($valor->$nomCiu),1);
  $pdf->Cell(40, 10, utf8_decode($valor->$habi),1);
  $pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();
foreach ($objT as $valor) {
  $pdf->Cell(50, 10, utf8_decode($valor->$created_at),1);
  $pdf->Cell(50, 10, utf8_decode($valor->$updated_at),1);
  $pdf->Ln();
}
$pdf->Output();
?>