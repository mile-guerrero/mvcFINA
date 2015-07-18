<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $id = videoTableClass::ID ?>
<?php $nom = videoTableClass::NOMBRE ?>
<?php $extencion = videoTableClass::EXTENCION ?>
<?php $hash = videoTableClass::HASH ?>

<div class="container container-fluid" id="cuerpo">
  
 
 
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <?php view::includeHandlerMessage()?>
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('video', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
    
    <br><br>

   <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('video', 'delete') ?>" method="POST">
  
    <table class="table table-bordered table-responsive">
        
        <thead>
        <th colspan="3"> <?php echo i18n::__('datos') ?></th>
        </thead>
        
        <tbody>
    <?php foreach ($objVideo as $key): ?>
            <tr>
              <th>  
              <?php
 
   if($key->$extencion == 'mp4'){//para poner icono a word
          // echo '<img id="margenImagen" src="' . routing::getInstance()->getUrlImg('../uploadVideo/' . $key->$hash) . '"/>' ;          
   //echo '<embed src="'. '../uploadVideo/' . $key->$hash .'" width="100" height="150" autostart="true" loop="true" />';
       
     echo '<video src="'. $key->$hash .'" type="video/mp4" width="320" height="240" />';    
   }
   ?>
              </th> 
              <th>
                <?php    
              echo videoTableClass::getNameVideo($key->$id);
              
                ?>
               </th>              
               <th>
              <a class="btn btn-lg btn-success btn-xs" href="<?php echo mvc\config\configClass::getUrlBase() . 'uploadVideo/' . $key->$hash ?>"><?php echo i18n::__('descargar') ?></a> 
              <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
               <input type="hidden"   id="idDelete" name="<?php echo videoTableClass::getNameField(videoTableClass::ID, true) ?>">
 
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
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>,'<?php echo videoTableClass::getNameField(videoTableClass::ID, true) ?>','<?php echo routing::getInstance()->getUrlWeb('video', 'delete') ?>')"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div> 
    <?php endforeach; ?>
        
          </tbody>
          
      </table>
  </form>
    
  </article>
   </div>
  
  </div>
