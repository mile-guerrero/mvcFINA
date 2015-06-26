<?php
use mvc\routing\routingClass as routing;

          
  $nombb =  maquinaTableClass::NOMBRE;
  $des =  maquinaTableClass::DESCRIPCION;
  $createdAt =  maquinaTableClass::CREATED_AT;
  $tipo =  maquinaTableClass::TIPO_USO_ID;
  $origen =  maquinaTableClass::ORIGEN_MAQUINA;
  $proveedor =  maquinaTableClass::PROVEEDOR_ID;
  
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
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Maquina}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 6);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(30, 10, "NOMBRE",1, 0, 'C');
$pdf->Cell(35, 10, utf8_decode("DESCRIPCION"),1, 0, 'C');
$pdf->Cell(30, 10, "ORIGEN MAQUINA",1, 0, 'C');
$pdf->Cell(25, 10, "TIPO USO MAQUINA ",1, 0, 'C');
$pdf->Cell(30, 10, "PROVEEEODOR",1, 0, 'C');
$pdf->Cell(40, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();
foreach ($objMaquina as $valor){
  $pdf->Cell(30,8, utf8_decode($valor->$nombb),1);
  $pdf->Cell(35,8, utf8_decode($valor->$des),1);
  $pdf->Cell(30,8, utf8_decode($valor->$origen),1);
  $pdf->Cell(25,8, tipoUsoMaquinaTableClass::getNameTipoUsoMaquina($valor->$tipo),1);
  $pdf->Cell(30,8, proveedorTableClass::getNameProveedor($valor->$proveedor),1);
  $pdf->Cell(40,8, utf8_decode($valor->$createdAt),1);
  $pdf->Ln();    
}
$pdf->Output();
?>