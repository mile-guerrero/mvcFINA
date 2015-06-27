<?php
use mvc\routing\routingClass as routing;

$usuario = usuarioCredencialTableClass::USUARIO_ID;
$credencial = usuarioCredencialTableClass::CREDENCIAL_ID;
$created_at = usuarioCredencialTableClass::CREATED_AT;


class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('portada4.png'), 0, 0, 210);
    $this->SetFont('Arial', 'B', '15');
    $this->Ln(10);
   # $this->Cell(80);
   # $this->Cell(30, 10, 'isuariocredencial', 1, 0, 'C');
    $this->Ln(30);
    
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
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(60, 10, "USUARIO",1, 0, 'C');
$pdf->Cell(60, 10, "CREDENCIAL",1, 0, 'C');
$pdf->Cell(70, 10, "FECHA DE CREACCION",1, 0, 'C');
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