<?php
use mvc\routing\routingClass as routing;
$ubicacion = registroLoteTableClass::UBICACION;
$produccion = registroLoteTableClass::PRODUCCION;
$cre = registroLoteTableClass::CREATED_AT;
$unidad = registroLoteTableClass::UNIDAD_MEDIDA_ID;
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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Cliente}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(80, 10, "LOTE",1, 0, 'C');
$pdf->Cell(50, 10, "PRODUCCION",1, 0, 'C');
$pdf->Cell(60, 10, "FECHA DE PRODUCCION",1, 0, 'C');
$pdf->Ln();
foreach ($objLote as $valor){
  $pdf->Cell(80,8, utf8_decode($valor->$ubicacion),1);
  $pdf->Cell(50,8, utf8_decode($valor->$produccion). '  ' . unidadMedidaTableClass::getNameUnidadMedida($valor->$unidad),1, 0, 'C');  
  $pdf->Cell(60,8, utf8_decode($valor->$cre),1);
  $pdf->Ln();   
}
$pdf->Output();
?>