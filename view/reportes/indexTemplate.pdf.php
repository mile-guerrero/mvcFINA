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
      $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Reportes}', 0, 0, 'C');
    }

  }

  $pdf = new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 8);

  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
  $pdf->Ln();
  $pdf->Cell(80, 10, "LOTE", 1, 0, 'C');
  $pdf->Cell(50, 10, "PRODUCCION", 1, 0, 'C');
  $pdf->Cell(60, 10, "FECHA DE PRODUCCION", 1, 0, 'C');
  $pdf->Ln();
  foreach ($objLote as $valor) {
    $pdf->Cell(80, 8, utf8_decode($valor->$ubicacion), 1);
    $pdf->Cell(50, 8, utf8_decode($valor->$produccion) . '  ' . unidadMedidaTableClass::getNameUnidadMedida($valor->$unidad), 1, 0, 'C');
    $pdf->Cell(60, 8, utf8_decode($valor->$cre), 1);
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
      $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Reportes}', 0, 0, 'C');
    }

  }

  $pdf = new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 8);

  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(190, 10, $mensaje1, 1, 0, 'C');
  $pdf->Ln();
  $pdf->Cell(80, 10, "LOTE", 1, 0, 'C');
  $pdf->Cell(50, 10, "# PLANTULAS", 1, 0, 'C');
  $pdf->Cell(60, 10, "FECHA DE RIEGO", 1, 0, 'C');
  $pdf->Ln();
  foreach ($objLote as $valor) {
    $pdf->Cell(80, 8, utf8_decode($valor->$loteNombre), 1);
    $pdf->Cell(50, 8, utf8_decode($valor->$numeroPlantulas) . '  ' . productoInsumoTableClass::getNameProductoInsumo($valor->$insumo), 1, 0, 'C');
    $pdf->Cell(60, 8, utf8_decode($valor->$fechaRiego), 1);
    $pdf->Ln();
  }
  $pdf->Output();
}
?>