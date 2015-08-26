<?php

use mvc\routing\routingClass as routing;
  
  $id = manoObraTableClass::ID;
  $cantidad = manoObraTableClass::CANTIDAD_HORA;
  $valorHoras = manoObraTableClass::VALOR_HORA;
  $labor = manoObraTableClass::LABOR_ID;
  $maquina = manoObraTableClass::MAQUINA_ID;
  $cooperativa = manoObraTableClass::COOPERATIVA_ID;
 
class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Mano de obra' , 2, 10,'C', true);
    $this->Ln(45);
    
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
$pdf->SetFillColor(255,204,51);//color
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C', true);
$pdf->Ln();
$pdf->Cell(40, 10, "Cooperativa",1, 0, 'C');
$pdf->Cell(35, 10, "Maquina",1, 0, 'C');
$pdf->Cell(30, 10, "Labor",1, 0, 'C');
$pdf->Cell(30, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(55, 10, "Valor Salario",1, 0, 'C');
$pdf->Ln();
foreach ($objManoObra as $valor) {  
  $pdf->Cell(40, 8, cooperativaTableClass::getNameCooperativa($valor->$cooperativa),1);
  $pdf->Cell(35, 8, maquinaTableClass::getNameMaquina($valor->$maquina),1);
  $pdf->Cell(30, 8, laborTableClass::getNameLabor($valor->$labor),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$cantidad),1);  
  $pdf->Cell(55, 8, utf8_decode($valor->$valorHoras),1);
  $pdf->Ln();  
}


$pdf->Output();
?>