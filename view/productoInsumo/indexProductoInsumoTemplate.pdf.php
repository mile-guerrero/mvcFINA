<?php
use mvc\routing\routingClass as routing;
  
  $des = productoInsumoTableClass::DESCRIPCION;
  $iva = productoInsumoTableClass::IVA;
  $created_at = productoInsumoTableClass::CREATED_AT;
  $updated_at = productoInsumoTableClass::UPDATED_AT;
  $tipo = tipoProductoInsumoTableClass::DESCRIPCION;
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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Producto Insumo}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(180, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
foreach ($objPI as $valor) {
  $pdf->Cell(70, 10, utf8_decode($valor->$des),1, 'C');
  $pdf->Cell(70, 10, utf8_decode($valor->$iva),1, 'C');
}
foreach ($objTipo as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$tipo),1);
  $pdf->Ln();
  $pdf->Ln();
}
foreach ($objPI as $valor) {
  $pdf->Cell(50, 10, utf8_decode($valor->$created_at),1);
  $pdf->Cell(50, 10, utf8_decode($valor->$updated_at),1);
  $pdf->Ln();
}

$pdf->Output();
?>