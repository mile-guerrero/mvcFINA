<?php

use mvc\routing\routingClass as routing;

$nom = proveedorTableClass::NOMBREP;
$apell = proveedorTableClass::APELLIDO;
$dire = proveedorTableClass::DIRECCION;
$tel = proveedorTableClass::TELEFONO;
$documento = proveedorTableClass::DOCUMENTO;
$email = proveedorTableClass::EMAIL;
$ciudad = proveedorTableClass::ID_CIUDAD;

class PDF extends FPDF {

  function Header() {
    
     $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Proveedor' , 2, 10,'C', true);
    $this->Ln(45);
    
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Proveedor}', 0, 0, 'C');
    
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
$pdf->Cell(35, 10, utf8_decode("Documento"),1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode("Dirección"),1, 0, 'C');
$pdf->Cell(25, 10, utf8_decode("Teléfono"),1, 0, 'C');
$pdf->Cell(50, 10, utf8_decode("Correo electrónico"),1, 0, 'C');
$pdf->Ln();
foreach ($objProveedor as $valor) {
  $pdf->Cell(40, 8, utf8_decode($valor->$nom).' '.($valor->$apell),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$documento),1);
  $pdf->Cell(40, 8, utf8_decode($valor->$dire).' '.ciudadTableClass::getNameciudad($valor->$ciudad),1);
  $pdf->Cell(25, 8, utf8_decode($valor->$tel),1);
  $pdf->Cell(50, 8, utf8_decode($valor->$email),1);
  $pdf->Ln();
}
$pdf->Output();
?>