<?php
use mvc\routing\routingClass as routing;
  
  $descripcion = productoInsumoTableClass::DESCRIPCION;
  $created_at = productoInsumoTableClass::CREATED_AT;
  $tipo = productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID;
class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Producto Insumo' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Producto Insumo}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(80, 10, "Descripcion",1, 0, 'C');
$pdf->Cell(60, 10, "Tipo insumo",1, 0, 'C');
$pdf->Cell(50, 10, "Fecha creacion",1, 0, 'C');
$pdf->Ln();

foreach ($objPI as $valor) {
  $pdf->Cell(80, 8, utf8_decode($valor->$descripcion),1, 0, 'C');
  $pdf->Cell(60, 8, tipoProductoInsumoTableClass::getNameTipoProductoInsumo($valor->$tipo),1, 0, 'C');
  $pdf->Cell(50, 8, utf8_decode($valor->$created_at),1, 0, 'C');
  $pdf->Ln();
}

$pdf->Output();
?>