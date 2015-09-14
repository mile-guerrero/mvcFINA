<?php

use mvc\routing\routingClass as routing;

$lote = presupuestoHistoricoTableClass::LOTE_ID;
$insumo = presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID;
$presupuesto = presupuestoHistoricoTableClass::PRESUPUESTO;
$produccion = presupuestoHistoricoTableClass::TOTAL_PRODUCCION;
$totalPago = presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR;


class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    //IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN)
    $this->SetFont('courier', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0 , 10, 'Presupuesto historico' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Presupuesto historico}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('courier', 'B', 9);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(38, 10, "Lote",1, 0, 'C');
$pdf->Cell(30, 10, "Producto",1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode("Presupuesto"),1, 0, 'C');
$pdf->Cell(54, 10, utf8_decode("Total de la producción"),1, 0, 'C');
$pdf->Cell(38, 10, utf8_decode("Total pago"),1, 0, 'C');
$pdf->Ln();
foreach ($objPresupuestoHistorico as $valor) {  
  $pdf->Cell(38, 8, loteTableClass::getNameLote($valor->$lote),1);
  $pdf->Cell(30, 8, utf8_decode(productoInsumoTableClass::getNameProductoInsumo($valor->$insumo)),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$presupuesto),1);
  $pdf->Cell(54, 8, utf8_decode($valor->$produccion),1);
  $pdf->Cell(38, 8, utf8_decode($valor->$totalPago),1);
  $pdf->Ln();  
}


$pdf->Output();
?>