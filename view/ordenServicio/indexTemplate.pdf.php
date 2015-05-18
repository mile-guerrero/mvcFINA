<?php

use mvc\routing\routingClass as routing;
  
 $id = ordenServicioTableClass::ID;
 $fecha = ordenServicioTableClass::FECHA_MANTENIMIENTO;
 $cantidad = ordenServicioTableClass::CANTIDAD;
 $valor = ordenServicioTableClass::VALOR;
 $nomTrabajador = trabajadorTableClass::NOMBRET;
 
class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('portada4.png'), 0, 0, 210);
    $this->SetFont('Arial', 'B', '15');
    $this->Ln(30);
   # $this->Cell(80);
   # $this->Cell(30, 10, 'Cliente', 1, 0, 'C');
    $this->Ln(30);
    
  }
  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Orden Servicio}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(180, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
foreach ($objOS as $valor) {
  $pdf->Cell(70, 10, utf8_decode($valor->$fecha),1, 'C');
  $pdf->Cell(60, 10, utf8_decode($valor->$cantidad),1, 'C');
  
foreach ($objOST as $valor) {
  $pdf->Cell(50, 10, utf8_decode($valor->$nomTrabajador),1);
  $pdf->Ln();
}
}
$pdf->Output();
?>