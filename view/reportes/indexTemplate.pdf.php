<?php

use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
$ubicacion = registroLoteTableClass::UBICACION;
$produccion = registroLoteTableClass::PRODUCCION;
$cre = registroLoteTableClass::CREATED_AT;
$unidad = registroLoteTableClass::UNIDAD_MEDIDA_ID;

$value = session::getInstance()->getAttribute('idGrafica');
if ($value == 1) {

  class PDF extends FPDF {

    function Header() {



    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(204,204,255);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell(0 , 10, utf8_decode('Informe de la Producción') , 2, 10,'C', true);
    $this->Ln(15);
    }

    function Footer() {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Reportes}', 0, 0, 'C');
    }

  }

  $pdf = new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 8);

  $pdf->Ln();
  $pdf->Ln();
  $pdf->SetFillColor(204,204,255);
  $pdf->Cell(190, 10, utf8_decode($mensaje), 1, 0, 'C', true);
  $pdf->Ln();
  $pdf->Cell(80, 10, "Lote", 1, 0, 'C');
  $pdf->Cell(50, 10, utf8_decode("Poducción"), 1, 0, 'C');
  $pdf->Cell(60, 10, utf8_decode("Fecha producción"), 1, 0, 'C');
  $pdf->Ln();
  foreach ($objLote as $valor) {
    $pdf->Cell(80, 8, utf8_decode($valor->$ubicacion), 1, 0, 'C');
    $pdf->Cell(50, 8, utf8_decode($valor->$produccion) . '  ' . unidadMedidaTableClass::getNameUnidadMedida($valor->$unidad), 1, 0, 'C');
    $pdf->Cell(60, 8, utf8_decode($valor->$cre), 1, 0, 'C');
    $pdf->Ln();
  }
  $pdf->Output();
}


//reporte del historial


$loteNombre = registroLoteTableClass::UBICACION;
$numeroPlantulas = registroLoteTableClass::NUMERO_PLANTULAS;
$fechaRiego = registroLoteTableClass::FECHA_RIEGO;
$insumo = registroLoteTableClass::PRODUCTO_INSUMO_ID;


if ($value == 2) {
  class PDF extends FPDF {

    function Header() {



    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(204,204,255);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell(0 , 10, utf8_decode('Informe de los Lotes') , 2, 10,'C', true);
    $this->Ln(15);
    }

    function Footer() {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Reportes}', 0, 0, 'C');
    }

  }

  $pdf = new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 8);

  $pdf->Ln();
  $pdf->Ln();
  $pdf->SetFillColor(204,204,255);
  $pdf->Cell(190, 10, $mensaje1, 1, 0, 'C',true);
  $pdf->Ln();
  $pdf->Cell(80, 10, "Lote", 1, 0, 'C');
  $pdf->Cell(50, 10, "# Plantulas", 1, 0, 'C');
  $pdf->Cell(60, 10, "Fecha riego", 1, 0, 'C');
  $pdf->Ln();
  foreach ($objLote as $valor) {
    $pdf->Cell(80, 8, utf8_decode($valor->$loteNombre), 1, 0, 'C');
    $pdf->Cell(50, 8, utf8_decode($valor->$numeroPlantulas) . '  ' . productoInsumoTableClass::getNameProductoInsumo($valor->$insumo), 1, 0, 'C');
    $pdf->Cell(60, 8, utf8_decode($valor->$fechaRiego), 1, 0, 'C');
    $pdf->Ln();
  }
  $pdf->Output();
}
?>