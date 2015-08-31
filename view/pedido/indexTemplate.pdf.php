<?php

use mvc\routing\routingClass as routing;

$cantidad = pedidoTableClass::CANTIDAD;
$empresa = pedidoTableClass::EMPRESA_ID;
$producto = pedidoTableClass::PRODUCTO_INSUMO_ID;
$proveedor = pedidoTableClass::ID_PROVEEDOR;


class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
      $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Pedidos' , 2, 10,'C', true);
    $this->Ln(45);
    
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
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(47, 10, "Empresa",1, 0, 'C');
$pdf->Cell(47, 10, "Producto",1, 0, 'C');
$pdf->Cell(27, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(69, 10, "Proveedor",1, 0, 'C');
$pdf->Ln();
foreach ($objPedido as $valor) {   
  $pdf->Cell(47, 8, empresaTableClass::getNameEmpresa($valor->$empresa),1);
  $pdf->Cell(47, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$producto),1);
  $pdf->Cell(27, 8, utf8_decode($valor->$cantidad),1);
  $pdf->Cell(69, 8, proveedorTableClass::getNameProveedor($valor->$proveedor) . ' ' .proveedorTableClass::getApellidoProveedor($valor->$proveedor) . ' CC: ' .proveedorTableClass::getDocumentoProveedor($valor->$proveedor),1);
  $pdf->Ln();  
}


$pdf->Output();
?>