<?php

use mvc\routing\routingClass as routing;

$nom = clienteTableClass::NOMBRE;
$apell = clienteTableClass::APELLIDO;
$dire = clienteTableClass::DIRECCION;
$tel = clienteTableClass::TELEFONO;
$documento = clienteTableClass::DOCUMENTO;
$tipo = clienteTableClass::ID_TIPO_ID;
$createdAt = clienteTableClass::CREATED_AT;
$updated_at = clienteTableClass::UPDATED_AT;
$nomCiu = clienteTableClass::ID_CIUDAD;

class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    //IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN)
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0 , 10, 'Cliente' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Cliente}', 0, 0, 'C');
    
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
$pdf->Cell(65, 10, "Nombre y Apellido",1, 0, 'C');
$pdf->Cell(35, 10, "Documento",1, 0, 'C');
$pdf->Cell(60, 10, utf8_decode("Dirección"),1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode("Teléfono"),1, 0, 'C');
$pdf->Ln();
foreach ($objC as $valor) {  
  $pdf->Cell(65, 8, utf8_decode($valor->$nom).' '.($valor->$apell),1);
  $pdf->Cell(35, 8, tipoIdTableClass::getNameTipoId($valor->$tipo).' '.($valor->$documento),1);
  $pdf->Cell(60, 8, utf8_decode($valor->$dire).' '.ciudadTableClass::getNameCiudad($valor->$nomCiu),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$tel),1);  
  $pdf->Ln();  
}


$pdf->Output();
?>