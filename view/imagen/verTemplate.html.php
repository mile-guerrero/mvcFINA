<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<div class="container container-fluid" id="cuerpo">
  <header id="">

  </header>
  <nav id=""> 

  </nav>
  <section id=""></section>
  <article id='derecha'>

    <h3></h3>       
  </article>
 
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <?php view::includeHandlerMessage()?>
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('imagen', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
    
    <br><br>
 <?php
      
  if ($directorio = opendir("./uploadImagen")){ //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
  
 
    
    if ($archivo != '.' && $archivo != '..')//verificamos si es o no un directorio

    {
     echo '<img id="margenImagen" src="' . routing::getInstance()->getUrlImg('../uploadImagen/' . $archivo) . '"/>';
     echo '<br><br>';
     echo "Archivo: <strong>  $archivo </strong><br />" ; 
     echo '<form class="form-horizontal" id="filterForm" role="form" method="POST" action="'. routing::getInstance()->getUrlWeb('imagen', 'eliminar'). '">' ;
     echo '<input type="hidden" class="form-control" id="filterDocumento" name="filter[documento]"  value="' . htmlspecialchars($archivo) . '" />'."\n";
     echo  '<input class="btn btn-danger btn-xs" type="submit" value="'. i18n::__(((isset($objUsuarios)) ? 'update' : 'eliminar')) .'">';
     echo '<br><br>';
     echo '</form>';
       }
   
        
     }
  
    }
  ?>
    
  </article>
 <!-- <img src="<?php echo routing::getInstance()->getUrlImg('../uploadImagen/' . $nameFile); ?>" />
<?php echo '<img src="' . routing::getInstance()->getUrlImg('../uploadImagen/' . $nameFile) . '"/>' ?>-->
  <?php
  
//   $opciones = "";
////definimos el directorio donde se guadan los archivos
//$path = "./uploadArchivo";
////abrimos el directorio
//$dir = opendir($path);
////guardamos los archivos en un arreglo
//  $img_total=0;
//while ($elemento = readdir($dir))
//{
//  
//  if ($elemento != '.' && $elemento != '..'){//verificamos si es o no un directorio
//if (strlen($elemento)>0)
//{
//  
//$img_array[$img_total]=$elemento;
//}
//  
//$img_total++;
//
//}
//}
//for ($i=0;$i<$img_total; $i++)
//{
//  
//$imagen = $img_array[$i];
////      echo '<br>';
////      print_r($i);
////      echo '</br>';
//$num = $i+1;
//$pathimagen=$path.$imagen;
//
//
//echo "<tr>";
//echo "<td align='center'>";
//echo"<div><b>Detalles de archivo: </b>$imagen</br><b>Guardada en: </b> </br> $path</div>";
//echo  '<form class="form-horizontal" id="filterForm" role="form" method="POST" action="'. routing::getInstance()->getUrlWeb('archivo', 'eliminar'). '">' ;
//echo '<input type="hidden" class="form-control" id="filterDocumento" name="filter[documento]"  value="' . htmlspecialchars($imagen) . '" />'."\n";
//echo  '<input class="btn btn-danger btn-xs" type="submit" value="'. i18n::__(((isset($objUsuarios)) ? 'update' : 'eliminar')) .'">';
//echo '</form>';
//echo "</td>";
//
//}

?>
  </div>
<!--<p>Cargando en un iframe<br />
<a href="pdf/pdf.php?archivo=Sqlite" target="visor">ver pdf</a>
</p>
<iframe name="visor" width="600" height="400" src="about:blank"></iframe>-->
  </div>
