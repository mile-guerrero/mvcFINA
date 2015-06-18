<?php
use mvc\routing\routingClass as routing;

$cre = credencialTableClass::NOMBRE;
$crea = credencialTableClass::CREATED_AT;

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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Credencial}', 0, 0, 'C');
    
  }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(95, 10, "NOMBRE DE CREDENCIAL",1, 0, 'C');
$pdf->Cell(95, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();
foreach ($objCredencial as $valor){
  $pdf->Cell(95,8, utf8_decode($valor->$cre),1);
  $pdf->Cell(95,8, utf8_decode($valor->$crea),1);
  $pdf->Ln();  
  
   
}
$pdf->Output();
?>