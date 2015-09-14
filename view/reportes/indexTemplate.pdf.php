<?php

use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
$ubicacion = registroLoteTableClass::UBICACION;
$produccion = registroLoteTableClass::PRODUCCION;
$cre = registroLoteTableClass::CREATED_AT;
$unidad = registroLoteTableClass::UNIDAD_MEDIDA_ID;
$insumo = registroLoteTableClass::PRODUCTO_INSUMO_ID;


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
  $pdf->Cell(40, 10, utf8_decode("Poducción"), 1, 0, 'C');
  $pdf->Cell(40, 10, utf8_decode("Fecha producción"), 1, 0, 'C');
  $pdf->Cell(30, 10, utf8_decode("Total"), 1, 0, 'C');
  $pdf->Ln();
  foreach ($objLote as $valor) {
    $pdf->Cell(80, 8, utf8_decode($valor->$ubicacion . '  ' . productoInsumoTableClass::getNameProductoInsumo($valor->$insumo)), 1, 0, 'C');
    $pdf->Cell(40, 8, utf8_decode($valor->$produccion) . '  ' . unidadMedidaTableClass::getNameUnidadMedida($valor->$unidad), 1, 0, 'C');
    $pdf->Cell(40, 8, utf8_decode($valor->$cre), 1, 0, 'C');
    $pdf->Cell(30, 8, utf8_decode(registroLoteTableClass::getNameTotal($valor->$insumo). '  ' . unidadMedidaTableClass::getNameUnidadMedida($valor->$unidad)), 1, 0, 'C');
    $pdf->Ln();
    
  }
  $pdf->Output();
}


//reporte del historial


$loteNombre = registroLoteTableClass::UBICACION;
$numeroPlantulas = registroLoteTableClass::NUMERO_PLANTULAS;
$fechaRiego = registroLoteTableClass::FECHA_RIEGO;
$insumo = registroLoteTableClass::PRODUCTO_INSUMO_ID;
$enfermedad = historialTableClass::ENFERMEDAD_ID;


if ($value == 2) {
  class PDF extends FPDF {

    function Header() {



    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
    $this->SetFillColor(204,204,255);
    $this->Cell(10);
    
    $this->Cell(0 , 10, utf8_decode('Informe de los Lotes') , 2, 10,'C', true);
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
  
  $pdf->Cell(40, 10, "Enfermedad",1, 0, 'C',true);
  $pdf->Cell(150, 10,utf8_decode(registroLoteTableClass::getNameEnfermedadNombre($valor->$insumo)),1);
  $pdf->Ln();
  $pdf->Cell(40, 10, utf8_decode("Descripción"),1, 0, 'C',true);
  $pdf->MultiCell(150, 8,utf8_decode(registroLoteTableClass::getNameEnfermedadDescripcion($valor->$insumo)),1);
  $pdf->Cell(40, 10, utf8_decode("Tratamiento"),1, 0, 'C',true);
  $pdf->MultiCell(150, 8,utf8_decode(registroLoteTableClass::getNameEnfermedadTratamiento($valor->$insumo)),1,'J', false);
  
  $pdf->Cell(40, 10, "plaga",1, 0, 'C',true);
  $pdf->Cell(150, 10,utf8_decode(registroLoteTableClass::getNamePlagaNombre($valor->$insumo)),1);
  $pdf->Ln();
  $pdf->Cell(40, 10, utf8_decode("Descripción"),1, 0, 'C',true);
  $pdf->MultiCell(150, 8,utf8_decode(registroLoteTableClass::getNamePlagaDescripcion($valor->$insumo)),1);
  $pdf->Cell(40, 10, utf8_decode("Tratamiento"),1, 0, 'C',true);
  $pdf->MultiCell(150, 8,utf8_decode(registroLoteTableClass::getNamePlagaTratamiento($valor->$insumo)),1,'J', false);
  $pdf->Ln();$pdf->Ln();
  }
 $pdf->Ln();
 
  $pdf->Output();
}

if ($value == 3) {
  
  $nomEmpresa = pagoTrabajadorTableClass::EMPRESA_ID;
 $nomTrabajador = pagoTrabajadorTableClass::TRABAJADOR_ID;
 $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL;
 $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL;
 $valorSalario = pagoTrabajadorTableClass::VALOR_SALARIO;
 $horas = pagoTrabajadorTableClass::HORAS_PERDIDAS;
 $total = pagoTrabajadorTableClass::TOTAL_PAGAR;
 
 
 class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(204,204,255);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Pago trabajador' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Pago trabajador}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(204,204,255);//color
$pdf->Cell(190, 10, $mensaje3, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(40, 10, "Empresa",1, 0, 'C',true);
$pdf->Cell(55, 10, "Trabajador",1, 0, 'C',true);
$pdf->Cell(60, 10, "Periodo de pago",1, 0, 'C',true);
$pdf->Cell(35, 10, utf8_decode("Valor Salarió"),1, 0, 'C',true);
$pdf->Ln();
foreach ($objPTrabajador as $valor) {  
  $pdf->Cell(40, 8, empresaTableClass::getNameEmpresa($valor->$nomEmpresa),1);
  $pdf->Cell(55, 8, trabajadorTableClass::getNameTrabajador($valor->$nomTrabajador). ' '. trabajadorTableClass::getNameApellido($valor->$nomTrabajador) . ' CC:' . trabajadorTableClass::getNameDocumento($valor->$nomTrabajador),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$fechaIni),1); 
  $pdf->Cell(30, 8, utf8_decode($valor->$fechaFin),1);
  $pdf->Cell(35, 8, '$' . number_format($valor->$valorSalario, 0, ',', '.'),1);
  $pdf->Ln();
  $pdf->Ln();
}

$pdf->Cell(95, 10, "Bonificaciones",1, 0, 'C', true);
$pdf->Cell(95, 10, "Subtotal",1, 0, 'C', true);
$pdf->Ln();
foreach ($objPTrabajador as $valor) { 
  $pdf->Cell(95, 8, '$' . number_format($valor->$horas, 0, ',', '.'),1); 
  $pdf->Cell(95, 8, '$' . number_format($valor->$total, 0, ',', '.'),1); 
  $pdf->Ln(); 
  $pdf->Ln();
}

$pdf->Cell(190, 10, "Total",1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(190, 8, '$' . number_format(pagoTrabajadorTableClass::getTotal($idTrabajador), 0, ',', '.'),1, 0, 'C'); 
$pdf->Ln();
$pdf->Ln();
$pdf->Output();
  
}
?>