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
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
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
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(40, 10, "Empresa",1, 0, 'C');
$pdf->Cell(35, 10, "Trabajador",1, 0, 'C');
$pdf->Cell(60, 10, "Periodo de pago",1, 0, 'C');
$pdf->Cell(55, 10, utf8_decode("Valor Salarió"),1, 0, 'C');
$pdf->Ln();
foreach ($objPT as $valor) {  
  $pdf->Cell(40, 8, empresaTableClass::getNameEmpresa($valor->$nomEmpresa),1);
  $pdf->Cell(35, 8, trabajadorTableClass::getNameTrabajador($valor->$nomTrabajador),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$fechaIni),1); 
  $pdf->Cell(30, 8, utf8_decode($valor->$fechaFin),1);
  $pdf->Cell(55, 8, '$' . number_format($valor->$valorSalario, 0, ',', '.'),1);
  $pdf->Ln();
  $pdf->Ln();
}
$pdf->Cell(50, 10, "Cantidad",1, 0, 'C', true);
$pdf->Cell(55, 10, "Valor horas extras",1, 0, 'C', true);
$pdf->Cell(50, 10, "Horas perdidas",1, 0, 'C', true);
$pdf->Cell(35, 10, "Total",1, 0, 'C', true);
$pdf->Ln();
foreach ($objPT as $valor) {  
  $pdf->Cell(50, 8, utf8_decode($valor->$cantidad),1); 
  $pdf->Cell(55, 8, '$' . number_format($valor->$valorHoras, 0, ',', '.'),1);
  $pdf->Cell(50, 8, '$' . number_format($valor->$horas, 0, ',', '.'),1); 
  $pdf->Cell(35, 8, '$' . number_format($valor->$total, 0, ',', '.'),1); 
  $pdf->Ln();  
}


$pdf->Output();
?>