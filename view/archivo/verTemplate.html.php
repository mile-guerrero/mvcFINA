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
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('archivo', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
    <br><br>
 <?php
      
  if ($directorio = opendir("./uploadArchivo")){ //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
  $ext = substr($archivo, -3);//para poner icono
     // print_r($ext);
  if($ext == 'pdf'){//para poner icono a pdf
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/reporte.gif') . '"/>' ;         
      }
   if($ext == 'zip'){//para poner icono a zip
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconZip.png') . '"/>' ;         
      }
   if($ext == 'txt'){//para poner icono a zip
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconTxt.png') . '"/>' ;         
      }
      $extOfice = substr($archivo, -4);
   if($extOfice == 'docx'){//para poner icono a word
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconWord.png') . '"/>' ;         
      }
   if($extOfice == 'xlsx'){//para poner icono a word
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconExel.png') . '"/>' ;         
      }   
      
    if ($archivo != '.' && $archivo != '..')//verificamos si es o no un directorio
    {
     echo "Archivo: <strong>  $archivo </strong><br />" ; 
       }
   
        
     }
  
    }
  ?>
  </article>
  
  </div>
<!--<p>Cargando en un iframe<br />
<a href="pdf/pdf.php?archivo=Sqlite" target="visor">ver pdf</a>
</p>
<iframe name="visor" width="600" height="400" src="about:blank"></iframe>-->
  </div>
