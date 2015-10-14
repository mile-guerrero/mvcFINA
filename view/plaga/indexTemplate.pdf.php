<?php

use mvc\routing\routingClass as routing;

$nombre = plagaTableClass::NOMBRE;
$descripcion = plagaTableClass::DESCRIPCION;
$tratamiento = plagaTableClass::TRATAMIENTO;
$createdAt = plagaTableClass::CREATED_AT;

class PDF extends FPDF {

  function Header() {
    
     $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('courier', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51); 
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Plaga' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('courier', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Plaga}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('courier', 'B', 10);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->SetFont('courier', 'B', 8);

foreach ($objPlaga as $valor) {  
  $pdf->Cell(50, 10, "Nombre",1, 0, 'C');
  $pdf->Cell(140, 10, utf8_decode($valor->$nombre),1);
  $pdf->Ln();  


$pdf->Cell(50, 10, utf8_decode("Fecha de cración"),1, 0, 'C');

  $pdf->Cell(140, 10, utf8_decode($valor->$createdAt),1);
  $pdf->Ln();  

  $pdf->MultiCell(190, 5, utf8_decode("Descripción:") . ' '. utf8_decode($valor->$descripcion),1);
  $pdf->MultiCell(190, 5,"Tratamiento:" . ' ' . utf8_decode($valor->$tratamiento),1);
  $pdf->Ln();  
  $pdf->Ln();
  $pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();

$pdf->Output();
?>