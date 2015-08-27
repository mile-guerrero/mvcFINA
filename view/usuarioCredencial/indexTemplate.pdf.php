<?php
use mvc\routing\routingClass as routing;

$usuario = usuarioCredencialTableClass::USUARIO_ID;
$credencial = usuarioCredencialTableClass::CREDENCIAL_ID;
$created_at = usuarioCredencialTableClass::CREATED_AT;


class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('logoColmenar.png'), 10, 22, 80);
    $this->SetFont('Arial', 'B', '25');
//    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(255,204,51);
//    $this->SetTextColor(220,50,50);
//    $this->Cell(10);
//    $this->SetFillColor(200,220,255);
    
    $this->Cell( 0, 10, 'Usuario Credencial' , 2, 10,'C', true);
    $this->Ln(45);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{UsuarioCredencial}', 0, 0, 'C');
    
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
$pdf->Cell(60, 10, "Usuario",1, 0, 'C');
$pdf->Cell(60, 10, "Credencial",1, 0, 'C');
$pdf->Cell(70, 10, utf8_decode("Fecha de creación"),1, 0, 'C');
$pdf->Ln();
foreach ($objUC as $valor) {
  $pdf->Cell(60, 8, utf8_decode($valor->$usuario).' '.usuarioTableClass::getNameUsuario($valor->$usuario),1);
  $pdf->Cell(60, 8, utf8_decode($valor->$credencial).' '.credencialTableClass::getNameCredencial($valor->$credencial),1);
  $pdf->Cell(70, 8, utf8_decode($valor->$created_at),1);
  $pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Output();
?>