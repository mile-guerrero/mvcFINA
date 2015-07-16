<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $id = archivoTableClass::ID ?>
<?php $nom = archivoTableClass::NOMBRE ?>
<?php $extencion = archivoTableClass::EXTENCION ?>
<?php $hash = archivoTableClass::HASH ?>

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
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('archivo', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
     
<table class="table table-bordered table-responsive">
        
        <thead>
        <th colspan="3"> <?php echo i18n::__('datos') ?></th>
        </thead>
        
        <tbody>
    <?php foreach ($objArchivo as $key): ?>
            <tr>
              <th><?php
  if($key->$extencion == 'pdf'){//para poner icono a pdf
         echo '<img src="' . routing::getInstance()->getUrlImg('../img/reporte.gif') . '"/>' ;         
      }
   if($key->$extencion == 'zip'){//para poner icono a zip
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconZip.png') . '"/>' ;         
      }
   if($key->$extencion == 'txt'){//para poner icono a zip
         echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconTxt.png') . '"/>' ;         
      }
   if($key->$extencion == 'docx'){//para poner icono a word
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconWord.png') . '"/>' ;         
      }
   if($key->$extencion == 'doc'){//para poner icono a word
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconWord.png') . '"/>' ;         
      }
   if($key->$extencion == 'xlsx'){//para poner icono a word
          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconExel.png') . '"/>' ;         
      }?></th> 
              <td><?php echo $key->$nom ?></td>
               
              <th><a class="btn btn-lg btn-success btn-xs" href="<?php echo mvc\config\configClass::getUrlBase() . 'uploadArchivo/' . $key->$hash ?>"><?php echo i18n::__('descargar') ?></a> 
       
              </th>
            </tr>
    <?php endforeach; ?>
        
          </tbody>
          
      </table>
    
  </article>
 
  </div>
       
  </div>
