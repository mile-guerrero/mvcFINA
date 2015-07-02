<?php
use mvc\routing\routingClass as routing;

$insumo = historialTableClass::PRODUCTO_INSUMO_ID;
$enfermedad = historialTableClass::ENFERMEDAD_ID;
$createdAt = historialTableClass::CREATED_AT;


class PDF extends FPDF {

  function Header() {
    
    $this->Image(routing::getInstance()->getUrlImg('portada4.png'), 0, 0, 210);
    $this->SetFont('Arial', 'B', '15');
    $this->Ln(10);
   # $this->Cell(80);
   # $this->Cell(30, 10, 'Historial', 1, 0, 'C');
    $this->Ln(30);
    
  }
 

  
  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'page' . $this->PageNo() . '/{Historial}', 0, 0, 'C');
    
  }

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(190, 10, $mensaje, 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(30, 10, "INSUMO",1, 0, 'C');
$pdf->Cell(30, 10, "ENFERMEDAD",1, 0, 'C');
$pdf->Cell(50, 10, "DESCRIPCION",1, 0, 'C');
$pdf->Cell(45, 10, "TRATAMIENTO",1, 0, 'C');
$pdf->Cell(35, 10, "FECHA DE CREACCION",1, 0, 'C');
$pdf->Ln();
foreach ($objHistorial as $valor) {
  $pdf->Cell(30, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$insumo),1);
  $pdf->Cell(30, 8, enfermedadTableClass::getNameEnfermedad($valor->$enfermedad),1);
  $pdf->Cell(50, 8, enfermedadTableClass::getNameDes($valor->$enfermedad),1);
  $pdf->Cell(45, 8, enfermedadTableClass::getNameTratamiento($valor->$enfermedad),1);
  $pdf->Cell(35, 8, utf8_decode($valor->$createdAt),1);
  $pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Output();

//class PDF extends FPDF
//{
//var $B;
//var $I;
//var $U;
//var $HREF;
//
//function PDF($orientation='P', $unit='mm', $size='A4')
//{
//    // Llama al constructor de la clase padre
//    $this->FPDF($orientation,$unit,$size);
//    // Iniciación de variables
//    $this->B = 0;
//    $this->I = 0;
//    $this->U = 0;
//    $this->HREF = '';
//}
//
//function WriteHTML($html)
//{
//    // Intérprete de HTML
//    $html = str_replace("\n",' ',$html);
//    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
//    foreach($a as $i=>$e)
//    {
//        if($i%2==0)
//        {
//            // Text
//            if($this->HREF)
//                $this->PutLink($this->HREF,$e);
//            else
//                $this->Write(5,$e);
//        }
//        else
//        {
//            // Etiqueta
//            if($e[0]=='/')
//                $this->CloseTag(strtoupper(substr($e,1)));
//            else
//            {
//                // Extraer atributos
//                $a2 = explode(' ',$e);
//                $tag = strtoupper(array_shift($a2));
//                $attr = array();
//                foreach($a2 as $v)
//                {
//                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
//                        $attr[strtoupper($a3[1])] = $a3[2];
//                }
//                $this->OpenTag($tag,$attr);
//            }
//        }
//    }
//}
//
//function OpenTag($tag, $attr)
//{
//    // Etiqueta de apertura
//    if($tag=='B' || $tag=='I' || $tag=='U')
//        $this->SetStyle($tag,true);
//    if($tag=='A')
//        $this->HREF = $attr['HREF'];
//    if($tag=='BR')
//        $this->Ln(5);
//}
//
//function CloseTag($tag)
//{
//    // Etiqueta de cierre
//    if($tag=='B' || $tag=='I' || $tag=='U')
//        $this->SetStyle($tag,false);
//    if($tag=='A')
//        $this->HREF = '';
//}
//
//function SetStyle($tag, $enable)
//{
//    // Modificar estilo y escoger la fuente correspondiente
//    $this->$tag += ($enable ? 1 : -1);
//    $style = '';
//    foreach(array('B', 'I', 'U') as $s)
//    {
//        if($this->$s>0)
//            $style .= $s;
//    }
//    $this->SetFont('',$style);
//}
//
//function PutLink($URL, $txt)
//{
//    // Escribir un hiper-enlace
//    $this->SetTextColor(0,0,255);
//    $this->SetStyle('U',true);
//    $this->Write(5,$txt,$URL);
//    $this->SetStyle('U',false);
//    $this->SetTextColor(0);
//}
//}
//
//
//
//$html = 'Ahora puede imprimir <br><fácilmente texto mezclando diferentes estilos: <b>negrita</b>, <i>itálica</i>,
//<u>subrayado</u>, o ¡ <b><i><u>todos a la vez</u></i></b>!<br><br>También puede incluir enlaces en el
//texto, como <a href="http://www.fpdf.org">www.fpdf.org</a>, o en una imagen: pulse en el logotipo.';
//
//
//
//$pdf = new PDF();
//// Primera página
//$pdf->AddPage();
//$pdf->SetFont('Arial','',20);
//$pdf->Write(5,'Para saber qué hay de nuevo en este tutorial, pulse ');
//$pdf->SetFont('','U');
//$link = $pdf->AddLink();
//$pdf->Write(5,'aquí',$link);
//$pdf->SetFont('');
//// Segunda página
//$pdf->AddPage();
//$pdf->SetLink($link);
//$pdf->Image(routing::getInstance()->getUrlImg('portada4.png'), 10,12,30,0);
//$pdf->SetLeftMargin(45);
//$pdf->SetFontSize(14);
//$pdf->WriteHTML($html);
//
//foreach ($objHistorial as $valor) {
//  $pdf->Cell(30, 8, productoInsumoTableClass::getNameProductoInsumo($valor->$insumo),1);
//  $pdf->Cell(30, 8, enfermedadTableClass::getNameEnfermedad($valor->$enfermedad),1);
//  $pdf->Cell(50, 8, enfermedadTableClass::getNameDes($valor->$enfermedad),1);
//  $pdf->Cell(45, 8, enfermedadTableClass::getNameTratamiento($valor->$enfermedad),1);
//  $pdf->Cell(35, 8, utf8_decode($valor->$createdAt),1);
//  $pdf->Ln();
//}
//$pdf->Output();
  
?>