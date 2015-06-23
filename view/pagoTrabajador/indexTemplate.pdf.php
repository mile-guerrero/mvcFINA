<?php
use mvc\routing\routingClass as routing;
  
 
 $nomEmpresa = pagoTrabajadorTableClass::EMPRESA_ID;
 $nomTrabajador = pagoTrabajadorTableClass::TRABAJADOR_ID;
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
    $this->Ln(10);
   # $this->Cell(80);
   # $this->Cell(30, 10, 'Cliente', 1, 0, 'C');
    $this->Ln(30);
    
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
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(40, 10, "Empresa",1, 0, 'C');
$pdf->Cell(35, 10, "Trabajador",1, 0, 'C');
$pdf->Cell(30, 10, "Fecha inicial",1, 0, 'C');
$pdf->Cell(30, 10, "Fecha final",1, 0, 'C');
$pdf->Cell(55, 10, "Valor Salario",1, 0, 'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(30, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(55, 10, "Valor horas extras",1, 0, 'C');
$pdf->Cell(30, 10, "Horas perdidas",1, 0, 'C');
$pdf->Cell(30, 10, "Total",1, 0, 'C');
$pdf->Ln();
foreach ($objPT as $valor) {  
  $pdf->Cell(40, 8, empresaTableClass::getNameEmpresa($valor->$nomEmpresa),1);
  $pdf->Cell(35, 8, trabajadorTableClass::getNameTrabajador($valor->$nomTrabajador),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$fechaIni),1); 
  $pdf->Cell(30, 8, utf8_decode($valor->$fechaFin),1); 
  $pdf->Cell(30, 8, utf8_decode($valor->$valorSalario),1); 
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(30, 8, utf8_decode($valor->$cantidad),1); 
  $pdf->Cell(55, 8, utf8_decode($valor->$valorHoras),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$horas),1); 
  $pdf->Cell(30, 8, utf8_decode($valor->$total),1); 
  $pdf->Ln();  
}


$pdf->Output();
?>