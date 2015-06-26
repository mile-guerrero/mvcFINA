<?php
use mvc\routing\routingClass as routing;
  
  $des = tipoProductoInsumoTableClass::DESCRIPCION;
  $cre = tipoProductoInsumoTableClass::CREATED_AT;
  $upd = tipoProductoInsumoTableClass::UPDATED_AT;
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
$pdf->SetFont('Arial', 'B', 6);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(95, 10, "DESCRIPCION",1, 0, 'C');
$pdf->Cell(95, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();
foreach ($objTPI as $valor) {
  $pdf->Cell(95, 8, utf8_decode($valor->$des),1, 0, 'C');
  $pdf->Cell(95, 8, utf8_decode($valor->$cre),1, 0, 'C');
}
$pdf->Output();
?>