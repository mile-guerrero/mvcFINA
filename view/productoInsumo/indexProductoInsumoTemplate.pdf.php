<?php
use mvc\routing\routingClass as routing;
  
  $descripcion = productoInsumoTableClass::DESCRIPCION;
  $cantidad = productoInsumoTableClass::CANTIDAD;
  $created_at = productoInsumoTableClass::CREATED_AT;
  $unidadMedida = productoInsumoTableClass::UNIDAD_MEDIDA_ID;
  $tipo = productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID;
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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Producto Insumo}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 6);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(40, 10, "DESCRIPCION",1, 0, 'C');
$pdf->Cell(30, 10, "CANTIDAD",1, 0, 'C');
$pdf->Cell(30, 10, "UNIDAD MEDIDA",1, 0, 'C');
$pdf->Cell(40, 10, "TIPO DE INSUMO",1, 0, 'C');
$pdf->Cell(50, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();

foreach ($objPI as $valor) {
  $pdf->Cell(40, 8, utf8_decode($valor->$descripcion),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$cantidad),1, 0, 'C');
  $pdf->Cell(30, 8, unidadMedidaTableClass::getNameUnidadMedida($valor->$unidadMedida),1);
  $pdf->Cell(40, 8, tipoProductoInsumoTableClass::getNameTipoProductoInsumo($valor->$tipo),1);
  $pdf->Cell(50, 8, utf8_decode($valor->$created_at),1);
  $pdf->Ln();
}

$pdf->Output();
?>