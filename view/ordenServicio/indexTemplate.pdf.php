<?php

use mvc\routing\routingClass as routing;
  
 $id = ordenServicioTableClass::ID;
 $fechaMantenimiento = ordenServicioTableClass::FECHA_MANTENIMIENTO;
 $cantidad = ordenServicioTableClass::CANTIDAD;
 $valorSalario = ordenServicioTableClass::VALOR;
 $maquina = ordenServicioTableClass::MAQUINA_ID;
 $producto = ordenServicioTableClass::PRODUCTO_INSUMO_ID;
 $trabajador = ordenServicioTableClass::TRABAJADOR_ID;
 
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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Orden servicio}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(40, 10, "Fecha mantenimiento",1, 0, 'C');
$pdf->Cell(30, 10, "Maquina",1, 0, 'C');
$pdf->Cell(30, 10, "Producto",1, 0, 'C');
$pdf->Cell(30, 10, "Cantidad",1, 0, 'C');
$pdf->Cell(30, 10, "Trabajador",1, 0, 'C');
$pdf->Cell(30, 10, "Valor salario",1, 0, 'C');
$pdf->Ln();
foreach ($objOS as $valor) {  
  $pdf->Cell(40, 8, utf8_decode($valor->$fechaMantenimiento),1);  
  $pdf->Cell(30, 8, maquinaTableClass::getNameMaquina($valor->$maquina),1);
  $pdf->Cell(30, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$producto),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$cantidad),1);
  $pdf->Cell(30, 8, trabajadorTableClass::getNameTrabajador($valor->$trabajador),1);
  $pdf->Cell(30, 8, utf8_decode($valor->$valorSalario),1);  
  $pdf->Ln();  
}


$pdf->Output();
?>