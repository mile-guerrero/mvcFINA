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
  <div class="center-block" id="cuerpo2">
  
 
    <?php view::includeHandlerMessage()?>
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('archivo', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
     
    
    <br><br>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('imagen', 'delete') ?>" method="POST">
  
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
       <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
               <input type="hidden"   id="idDelete" name="<?php echo archivoTableClass::getNameField(archivoTableClass::ID, true) ?>">
 
               </th>
             
            </tr>
            <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmar eliminar') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('Desea  eliminar este campo') ?><?php echo $key->$nom ?><?php echo i18n::__('?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>,'<?php echo archivoTableClass::getNameField(archivoTableClass::ID, true) ?>','<?php echo routing::getInstance()->getUrlWeb('archivo', 'delete') ?>')"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>
    <?php endforeach; ?>
        
          </tbody>
          
      </table>
     </form>
  
 
  </div>
  </div>
 
