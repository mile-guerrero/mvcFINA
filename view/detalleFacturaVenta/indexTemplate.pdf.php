<?php

use mvc\routing\routingClass as routing;
  
 $cliente = detalleFacturaVentaTableClass::CLIENTE_ID;
 $descripcion = detalleFacturaVentaTableClass::DESCRIPCION; 
 $cantidad = detalleFacturaVentaTableClass::CANTIDAD; 
 $valorUnidad = detalleFacturaVentaTableClass::VALOR_UNIDAD; 
 $valorTotal = detalleFacturaVentaTableClass::VALOR_TOTAL; 
 $id = detalleFacturaVentaTableClass::ID; 
 $idFactura = facturaVentaTableClass::ID; 
 $fecha = facturaVentaTableClass::FECHA; 
 
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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Cliente}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(95, 10, "Id",1, 0, 'C');
$pdf->Cell(95, 10, "Fecha",1, 0, 'C');
$pdf->Ln();
foreach ($objFactura as $valor) {
$pdf->Cell(95, 8, utf8_decode($valor->$idFactura),1);  
$pdf->Cell(95, 8, utf8_decode($valor->$fecha),1);
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40, 10, "Cliente",1, 0, 'C');
$pdf->Cell(35, 10, "Descripcion",1, 0, 'C');
$pdf->Cell(30, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(30, 10, "Valor por unidad",1, 0, 'C');
$pdf->Cell(55, 10, "Valor total",1, 0, 'C');
$pdf->Ln();

foreach ($objDetalleFactura as $valor) {   
  $pdf->Cell(40, 8, clienteTableClass::getNameCliente($valor->$cliente),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$descripcion),1);  
  $pdf->Cell(30, 8, utf8_decode($valor->$cantidad),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$valorUnidad),1);  
  $pdf->Cell(55, 8, utf8_decode($valor->$valorTotal),1);
  $pdf->Ln();  
}


$pdf->Output();
?>