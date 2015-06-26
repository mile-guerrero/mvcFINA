<?php

use mvc\routing\routingClass as routing;

$documento = trabajadorTableClass::DOCUMENTO;
$nom = trabajadorTableClass::NOMBRET;
$apell = trabajadorTableClass::APELLIDO;
$dire = trabajadorTableClass::DIRECCION;
$tipo = trabajadorTableClass::ID_TIPO_ID;
$tel = trabajadorTableClass::TELEFONO;
$email = trabajadorTableClass::EMAIL;
$createdAt = trabajadorTableClass::CREATED_AT;
$habi = ciudadTableClass::HABITANTES;
$ciudad = trabajadorTableClass::ID_CIUDAD;
$desTipo = tipoIdTableClass::DESCRIPCION;

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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Tipo Producto Insumo}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();


$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(35, 10, "NOMBRE",1, 0, 'C');
$pdf->Cell(35, 10, "DOCUMENTO",1, 0, 'C');
$pdf->Cell(30, 10, "DIRECCION",1, 0, 'C');
$pdf->Cell(30, 10, "TELEFONO",1, 0, 'C');
$pdf->Cell(30, 10, "CORREO",1, 0, 'C');
$pdf->Cell(30, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();

foreach ($objT as $valor) {
  $pdf->Cell(35, 8, utf8_decode($valor->$nom).' '.($valor->$apell),1);
  $pdf->Cell(35, 8, tipoIdTableClass::getNameTipoId($valor->$tipo).' '.($valor->$documento),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$dire).' '.ciudadTableClass::getNameCiudad($valor->$ciudad),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$tel),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$email),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$createdAt),1);
  $pdf->Ln();
}

$pdf->Output();
?>