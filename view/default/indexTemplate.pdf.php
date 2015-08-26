<?php
use mvc\routing\routingClass as routing;

$usu = usuarioTableClass::USUARIO;
$actived = usuarioTableClass::ACTIVED;
$cre = usuarioTableClass::CREATED_AT;

class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Usuario' , 2, 10,'C', true);
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
$pdf->Cell(80, 10, "Usuario",1, 0, 'C');
$pdf->Cell(40, 10, "Activacion",1, 0, 'C');
$pdf->Cell(70, 10, "Fecha de la creacion del usuario",1, 0, 'C');
$pdf->Ln();
foreach ($objUsuarios as $valor){
  $pdf->Cell(80,8, utf8_decode($valor->$usu),1);
  $pdf->Cell(40,8, utf8_decode($valor->$actived),1, 0, 'C');
  $pdf->Cell(70,8, utf8_decode($valor->$cre),1);
  $pdf->Ln();   
}
$pdf->Output();
?>