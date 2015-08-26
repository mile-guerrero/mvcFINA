<?php

use mvc\routing\routingClass as routing;
  
 $cliente = facturaVentaTableClass::CLIENTE_ID;
 $descripcion = detalleFacturaVentaTableClass::DESCRIPCION; 
 $cantidad = detalleFacturaVentaTableClass::CANTIDAD; 
 $valorUnidad = detalleFacturaVentaTableClass::VALOR_UNIDAD; 
 $valorTotal = detalleFacturaVentaTableClass::VALOR_TOTAL; 
 $id = detalleFacturaVentaTableClass::ID; 
 $idFactura = facturaVentaTableClass::ID; 
 $fecha = facturaVentaTableClass::FECHA; 
 
class PDF extends FPDF {

  function Header() {
    
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(204,204,255);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell(0 , 10, 'Facturacion' , 2, 10,'C', true);
    $this->Ln(15);
   
   # $this->Cell(80);
   # $this->Cell(30, 10, 'Cliente', 1, 0, 'C');
    
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Factura venta}', 0, 0, 'C');
    
    
  }

}


$pdf = new PDF();


$pdf->AddPage();
foreach ($objFactura as $valor) {
$pdf->Cell(130);    
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(204,204,255);//color
$pdf->Cell(30, 8, "# Factura",1, 0, 'C', true);
$pdf->Cell(30, 8, utf8_decode($valor->$idFactura),1);
//$pdf->Ln();
//$pdf->Cell(55, 8, "Cliente",1, 0, 'C');
//$pdf->Cell(55, 8, clienteTableClass::getNameCliente($valor->$cliente),1);
$pdf->Ln();
$pdf->Cell(130);  
$pdf->Cell(30, 8, "Fecha",1, 0, 'C', true);
$pdf->Cell(30, 8, utf8_decode($valor->$fecha),1);
}
$pdf->Ln();

$pdf->SetFont('Arial', '' , 10);
$pdf->Cell(5, 5, 'Empresa: Colmenar');
$pdf->Ln();
$pdf->Cell(20, 5, 'Direccion: Via pierna de chucha');
$pdf->Ln();
$pdf->Cell(20, 5, 'Ciudad: Pradera');
$pdf->Ln();
$pdf->Cell(20, 5, 'Telefono: 2678900 - 3116754355');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B' , 10);
$pdf->Cell(20, 5, 'Facturar a: ');
$pdf->Ln();
//$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');

foreach ($objFactura as $valor) {
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1); 
$pdf->Cell(55, 8, "Cliente",1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(1);
$pdf->Cell(55, 8, clienteTableClass::getNameCliente($valor->$cliente),1);
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(70, 10, "Descripcion",1, 0, 'C', true);
$pdf->Cell(35, 10, "Cantidad",1, 0, 'C', true);
$pdf->Cell(30, 10, "Valor por unidad",1, 0, 'C', true);
$pdf->Cell(55, 10, "Valor total",1, 0, 'C', true);
$pdf->Ln();

foreach ($objDetalleFactura as $valor) {   
  $pdf->Cell(70, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$descripcion),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$cantidad),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$valorUnidad),1);  
  $pdf->Cell(55, 8, utf8_decode($valor->$valorTotal),1);
  $pdf->Ln();  
}


$pdf->Output();
?>