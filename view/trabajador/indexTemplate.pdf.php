<?php

use mvc\routing\routingClass as routing;

$documento = trabajadorTableClass::DOCUMENTO;
$nom = trabajadorTableClass::NOMBRET;
$apell = trabajadorTableClass::APELLIDO;
$dire = trabajadorTableClass::DIRECCION;
$tipo = trabajadorTableClass::ID_TIPO_ID;
$tel = trabajadorTableClass::TELEFONO;
$email = trabajadorTableClass::EMAIL;
$ciudad = trabajadorTableClass::ID_CIUDAD;
$desTipo = tipoIdTableClass::DESCRIPCION;

class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Trabajador' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Trabajador}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();


$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(35, 10, "Nombre",1, 0, 'C');
$pdf->Cell(35, 10, "Documento",1, 0, 'C');
$pdf->Cell(45, 10, utf8_decode("Dirección"),1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode("Teléfono"),1, 0, 'C');
$pdf->Cell(45, 10, utf8_decode("Correo electrónico"),1, 0, 'C');
$pdf->Ln();

foreach ($objT as $valor) {
  $pdf->Cell(35, 8, utf8_decode($valor->$nom).' '.($valor->$apell),1);
  $pdf->Cell(35, 8, tipoIdTableClass::getNameTipoId($valor->$tipo).' '.($valor->$documento),1);
  $pdf->Cell(45, 8, utf8_decode($valor->$dire).' '.ciudadTableClass::getNameCiudad($valor->$ciudad),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$tel),1);
  $pdf->Cell(45, 8, utf8_decode($valor->$email),1);
  $pdf->Ln();
}

$pdf->Output();
?>