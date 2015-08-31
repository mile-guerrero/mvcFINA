<?php

use mvc\routing\routingClass as routing;

$nombre = cooperativaTableClass::NOMBRE;
$descripcion = cooperativaTableClass::DESCRIPCION;
$direccion = cooperativaTableClass::DIRECCION;
$telefono = cooperativaTableClass::TELEFONO;
$updatedAt = cooperativaTableClass::UPDATED_AT;
$deleted_at = cooperativaTableClass::UPDATED_AT;
$nomCiu = cooperativaTableClass::ID_CIUDAD;

class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Cooperativa' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Cooperativa}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 7);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(40, 10, "Nombre",1, 0, 'C');
$pdf->Cell(65, 10, utf8_decode("Descripción"),1, 0, 'C');
$pdf->Cell(50, 10, utf8_decode("Dirección"),1, 0, 'C');
$pdf->Cell(35, 10, utf8_decode("Teléfono"),1, 0, 'C');
$pdf->Ln();
foreach ($objCooperativa as $valor) {
  $pdf->Cell(40, 8, utf8_decode($valor->$nombre),1);
  $pdf->Cell(65, 8, utf8_decode($valor->$descripcion),1);
  $pdf->Cell(50, 8, utf8_decode($valor->$direccion).' '.ciudadTableClass::getNameCiudad($valor->$nomCiu),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$telefono),1);
  $pdf->Ln();
}

$pdf->Output();
?>