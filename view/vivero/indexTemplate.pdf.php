<?php

use mvc\routing\routingClass as routing;
  
  $id = viveroTableClass::ID;
  $fechaInicial = viveroTableClass::FECHA_INICIAL;
  $fechaFinal = viveroTableClass::FECHA_FINAL;
  $producto = viveroTableClass::PRODUCTO_INSUMO_ID;
  $cantidad = viveroTableClass::CANTIDAD;
 
class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('courier', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Vivero' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('courier', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Vivero}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('courier', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(50, 10, "Fecha inicial de siembra",1, 0, 'C');
$pdf->Cell(70, 10, "Fecha final de salida del producto",1, 0, 'C');
$pdf->Cell(40, 10, "Producto",1, 0, 'C');
$pdf->Cell(30, 10, "Cantidad",1, 0, 'C');
$pdf->Ln();
foreach ($objVivero as $valor) {  
  $pdf->Cell(50, 8, utf8_decode($valor->$fechaInicial),1);  
  $pdf->Cell(70, 8, utf8_decode($valor->$fechaFinal),1);  
  $pdf->Cell(40, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$producto),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$cantidad),1);  
  $pdf->Ln();  
}


$pdf->Output();
?>