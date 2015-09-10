<?php

use mvc\routing\routingClass as routing;
use mvc\request\requestClass as request;
  
$producto = detalleFacturaCompraTableClass::DESCRIPCION;  
$cantidad = detalleFacturaCompraTableClass::CANTIDAD; 
$valorUnidad = detalleFacturaCompraTableClass::VALOR_UNIDAD; 
$valorTotal = detalleFacturaCompraTableClass::VALOR_TOTAL; 
$id = detalleFacturaCompraTableClass::ID; 
$idFactura = facturaCompraTableClass::ID; 
$proveedor = facturaCompraTableClass::PROVEEDOR_ID; 
$fecha = facturaCompraTableClass::FECHA;  
$idProveedor = proveedorTableClass::ID; 
class PDF extends FPDF {

  function Header() {
    
    $this->SetFont('Arial', 'B', '20');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(204,204,255);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell(0 , 10, utf8_decode('Registros de compras que se hicieron en el día') , 2, 10,'C', true);
    $this->Ln(15);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Factura compra}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

foreach ($objFactura as $valor) {
$pdf->SetFillColor(204,204,255);    
$pdf->Cell(30, 8, "# Factura",1, 0, 'C', true);    
$pdf->Cell(30, 8, str_pad($valor->$idFactura, 6, '0', STR_PAD_LEFT),1);
$pdf->Ln();
$pdf->Cell(30, 8, "Fecha",1, 0, 'C', true);
$pdf->Cell(30, 8, utf8_decode($valor->$fecha),1);
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(55, 8, "Proveedor",1, 0, 'C');
foreach ($objFactura as $valor) {
$pdf->SetFillColor(204,204,255);    
$pdf->Ln();
$pdf->Cell(55, 8, "CC",1, 0, 'C', true);
$pdf->Cell(50, 8, proveedorTableClass::getDocumentoProveedor($valor->$idProveedor),1);
$pdf->Ln();
$pdf->Cell(55, 8, "Nombre y Apellido",1, 0, 'C', true);
$pdf->Cell(50, 8, proveedorTableClass::getNameProveedor($valor->$proveedor). ' '. proveedorTableClass::getApellidoProveedor($valor->$idProveedor),1);
$pdf->Ln();
$pdf->Cell(55, 8, "Direccion",1, 0, 'C', true);
$pdf->Cell(50, 8, proveedorTableClass::getNameDireccion($valor->$idProveedor),1);
$pdf->Ln();
$pdf->Cell(55, 8, "Telefono",1, 0, 'C', true);
$pdf->Cell(50, 8, proveedorTableClass::getNameTelefono($valor->$idProveedor),1);
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(204,204,255);
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C' , true);
$pdf->Ln();
$pdf->Cell(70, 10, "Descripcion",1, 0, 'C');
$pdf->Cell(35, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(30, 10, "Valor por unidad",1, 0, 'C');
$pdf->Cell(55, 10, "Valor Subtotal",1, 0, 'C');
$pdf->Ln();
$idFacturar = request::getInstance()->getGet(facturaCompraTableClass::ID);
foreach ($objDetalleFactura as $valor) {   
  $pdf->Cell(70, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$producto),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$cantidad). ' Kilos',1);
  $pdf->Cell(30, 8, '$' . number_format($valor->$valorUnidad, 0, ',', '.'),1);  
  $pdf->Cell(55, 8, '$' . number_format($valor->$valorTotal, 0, ',', '.'),1);
  $pdf->Ln();  
}
 $pdf->Cell(105);
 $pdf->Cell(30, 8, "Total",1, 0, 'C', true);
 $pdf->Cell(55, 8, '$' . number_format(detalleFacturaCompraTableClass::getNameTotalPagar($idFacturar, 0, ',', '.')),1);


$pdf->Output();
?>