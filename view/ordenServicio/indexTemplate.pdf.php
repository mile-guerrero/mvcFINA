<?php

use mvc\routing\routingClass as routing;
  
 $id = ordenServicioTableClass::ID;
 $fechaMantenimiento = ordenServicioTableClass::FECHA_MANTENIMIENTO;
 $cantidad = ordenServicioTableClass::CANTIDAD;
 $valorSalario = ordenServicioTableClass::VALOR;
 $maquina = ordenServicioTableClass::MAQUINA_ID;
 $lote = ordenServicioTableClass::LOTE_ID;
 $trabajador = ordenServicioTableClass::TRABAJADOR_ID;
 $unidadDistancia = ordenServicioTableClass::UNIDAD_DISTANCIA_ID;
 
class PDF extends FPDF {

  function Header() {
    
   $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    //IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN)
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0 , 10, 'Orden servicio' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Orden servicio}', 0, 0, 'C');
    
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
$pdf->Cell(30, 10, "Maquina",1, 0, 'C');
$pdf->Cell(40, 10, "Lote",1, 0, 'C');
$pdf->Cell(35, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(55, 10, "Trabajador",1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode("Valor salarió"),1, 0, 'C');
$pdf->Ln();
foreach ($objOS as $valor) {  
  $pdf->Cell(30, 8, utf8_decode(maquinaTableClass::getNameMaquina($valor->$maquina)),1);
  $pdf->Cell(40, 8, loteTableClass::getNameLote($valor->$lote),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$cantidad). ' ' . unidadDistanciaTableClass::getNameUnidadDistancia($valor->$unidadDistancia),1);
  $pdf->Cell(55, 8, trabajadorTableClass::getNameTrabajador($valor->$trabajador). ' ' . trabajadorTableClass::getNameApellido($valor->$trabajador) . ' CC '.trabajadorTableClass::getNameDocumento($valor->$trabajador),1);
  $pdf->Cell(30, 8, '$' . number_format($valor->$valorSalario, 0, ',', '.'),1);  
  $pdf->Ln();  
}


$pdf->Output();
?>