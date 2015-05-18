<?php

use mvc\routing\routingClass as routing;

$cantidad = pedidoTableClass::CANTIDAD;
$nomEmpresa = empresaTableClass::NOMBRE;
$nomProveedor = proveedorTableClass::NOMBREP;
$descProducto = productoInsumoTableClass::DESCRIPCION;

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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Pedido}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
foreach ($objPedido as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$cantidad),1);
  $pdf->Ln();
}
$pdf->Ln();
foreach ($objEmpresa as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$nomEmpresa), 1);
  $pdf->Ln();
}
$pdf->Ln();
foreach ($objProducto as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$descProducto), 1);
  $pdf->Ln();
}
$pdf->Ln();
foreach ($objProveedor as $valor) {
  $pdf->Cell(50, 10, utf8_decode($valor->$nomProveedor), 1);
  $pdf->Ln();
}
$pdf->Output();
?>