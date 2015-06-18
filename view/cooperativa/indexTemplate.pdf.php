<?php

use mvc\routing\routingClass as routing;

$nombre = cooperativaTableClass::NOMBRE;
$descripcion = cooperativaTableClass::DESCRIPCION;
$direccion = cooperativaTableClass::DIRECCION;
$telefono = cooperativaTableClass::TELEFONO;
$createdAt = cooperativaTableClass::CREATED_AT;
$updatedAt = cooperativaTableClass::UPDATED_AT;
$deleted_at = cooperativaTableClass::UPDATED_AT;
$nomCiu = cooperativaTableClass::ID_CIUDAD;

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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Cooperativa}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(40, 10, "NOMBRE",1, 0, 'C');
$pdf->Cell(35, 10, "DESCRIPCION",1, 0, 'C');
$pdf->Cell(30, 10, "DIRECCION",1, 0, 'C');
$pdf->Cell(30, 10, "TELEFONO",1, 0, 'C');
$pdf->Cell(55, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();
foreach ($objCooperativa as $valor) {
  $pdf->Cell(40, 8, utf8_decode($valor->$nombre),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$descripcion),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$direccion).' '.ciudadTableClass::getNameCiudad($valor->$nomCiu),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$telefono),1);
  $pdf->Cell(55, 8, utf8_decode($valor->$createdAt),1);
  $pdf->Ln();
}

$pdf->Output();
?>