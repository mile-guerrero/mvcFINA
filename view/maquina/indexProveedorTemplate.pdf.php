<?php

use mvc\routing\routingClass as routing;

$nom = proveedorTableClass::NOMBREP;
$apell = proveedorTableClass::APELLIDO;
$dire = proveedorTableClass::DIRECCION;
$tel = proveedorTableClass::TELEFONO;
$documento = proveedorTableClass::DOCUMENTO;
$email = proveedorTableClass::EMAIL;
$created_at = proveedorTableClass::CREATED_AT;
$ciudad = proveedorTableClass::ID_CIUDAD;

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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Proveedor}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 6);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(30, 10, "NOMBRE",1, 0, 'C');
$pdf->Cell(35, 10, utf8_decode("DOCUMENTO"),1, 0, 'C');
$pdf->Cell(30, 10, "DIRECCION",1, 0, 'C');
$pdf->Cell(25, 10, "TELEFONO",1, 0, 'C');
$pdf->Cell(30, 10, "EMAIL",1, 0, 'C');
$pdf->Cell(40, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();
foreach ($objProveedor as $valor) {
  $pdf->Cell(30, 8, utf8_decode($valor->$nom).' '.($valor->$apell),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$documento),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$dire).' '.ciudadTableClass::getNameciudad($valor->$ciudad),1);
  $pdf->Cell(25, 8, utf8_decode($valor->$tel),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$email),1);
  $pdf->Cell(40, 8, utf8_decode($valor->$created_at),1);
  $pdf->Ln();
}
$pdf->Output();
?>