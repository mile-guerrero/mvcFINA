<?php

use mvc\routing\routingClass as routing;

$cantidad = pedidoTableClass::CANTIDAD;
$empresa = pedidoTableClass::EMPRESA_ID;
$producto = pedidoTableClass::PRODUCTO_INSUMO_ID;
$proveedor = pedidoTableClass::ID_PROVEEDOR;


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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Pedido}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(47, 10, "Maquina",1, 0, 'C');
$pdf->Cell(47, 10, "Producto",1, 0, 'C');
$pdf->Cell(47, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(49, 10, "Proveedor",1, 0, 'C');
$pdf->Ln();
foreach ($objPedido as $valor) {   
  $pdf->Cell(47, 8, empresaTableClass::getNameEmpresa($valor->$empresa),1);
  $pdf->Cell(47, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$producto),1);
  $pdf->Cell(47, 8, utf8_decode($valor->$cantidad),1);
  $pdf->Cell(49, 8, proveedorTableClass::getNameProveedor($valor->$proveedor),1);
  $pdf->Ln();  
}


$pdf->Output();
?>