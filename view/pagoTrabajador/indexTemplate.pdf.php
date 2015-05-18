<?php
use mvc\routing\routingClass as routing;
  
 $nomEmpresa = empresaTableClass::NOMBRE;
 $nomTrabajador = trabajadorTableClass::NOMBRET;
 $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL;
 $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL;
 $valorSalario = pagoTrabajadorTableClass::VALOR_SALARIO;
 $cantidad = pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS;
 $valorHoras = pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS;
 $horas = pagoTrabajadorTableClass::HORAS_PERDIDAS;
 $total = pagoTrabajadorTableClass::TOTAL_PAGAR;
class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('portada4.png'), 0, 0, 210);
    $this->SetFont('Arial', 'B', '15');
    $this->Ln(30);
   # $this->Cell(80);
   # $this->Cell(30, 10, 'Cliente', 1, 0, 'C');
    $this->Ln(30);
    
  }
  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Pago al trabajador}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(180, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
foreach ($objPT as $valor) {
  $pdf->Cell(70, 10, 'Fecha Inicio ' . utf8_decode($valor->$fechaIni),1, 'C');
  $pdf->Cell(70, 10, utf8_decode($valor->$fechaFin),1, 'C');
  $pdf->Cell(40, 10, utf8_decode($valor->$valorSalario),1, 'C');
  $pdf->Ln();
  $pdf->Cell(70, 10, utf8_decode($valor->$cantidad),1, 'C');
  $pdf->Cell(70, 10, utf8_decode($valor->$valorHoras),1, 'C');
  $pdf->Cell(40, 10, utf8_decode($valor->$horas),1, 'C');
  $pdf->Ln();
  $pdf->Cell(70, 10, utf8_decode($valor->$total),1, 'C');
  $pdf->Ln();
  $pdf->Ln();
  }
foreach ($objEmpresa as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$nomEmpresa),1);
  $pdf->Ln();
}
$pdf->Ln();
foreach ($objT as $valor) {
  $pdf->Cell(40, 10, utf8_decode($valor->$nomTrabajador),1);
  $pdf->Ln();
}
$pdf->Output();
?>