<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\config\configClass as config; ?>


<?php $id = imagenTableClass::ID ?>
<?php $nom = imagenTableClass::NOMBRE ?>
<?php $extencion = imagenTableClass::EXTENCION ?>
<?php $hash = imagenTableClass::HASH ?>

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
   <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('imagen', 'delete') ?>" method="POST">
  
    <table class="table table-bordered table-responsive">
        
        <thead>
        <th colspan="3"> <?php echo i18n::__('datos') ?></th>
        </thead>
        
        <tbody>
    <?php foreach ($objImagen as $key): ?>
            <tr>
              <th>  
              <?php
 
   if($key->$extencion == 'gif'){//para poner icono a word
           echo '<img id="margenImagen" src="' . routing::getInstance()->getUrlImg('../uploadImagen/' . $key->$hash) . '"/>' ;          
      }
   if($key->$extencion == 'png'){//para poner icono a word
          echo '<img id="margenImagen" src="' . routing::getInstance()->getUrlImg('../uploadImagen/' . $key->$hash) . '"/>' ;          
      }
   if($key->$extencion == 'jpg'){//para poner icono a word
          echo '<img id="margenImagen" src="' . routing::getInstance()->getUrlImg('../uploadImagen/' . $key->$hash) . '"/>' ;         
      }?>
              </th> 
              <th>
                <?php    
              echo imagenTableClass::getNameImagen($key->$id);
              
                ?>
               </th>              
               <th>
              <a class="btn btn-lg btn-success btn-xs" href="<?php echo mvc\config\configClass::getUrlBase() . 'uploadImagen/' . $key->$hash ?>"><?php echo i18n::__('descargar') ?></a> 
              <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
               <input type="hidden"   id="idDelete" name="<?php echo imagenTableClass::getNameField(imagenTableClass::ID, true) ?>">
 
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
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>,'<?php echo imagenTableClass::getNameField(imagenTableClass::ID, true) ?>','<?php echo routing::getInstance()->getUrlWeb('imagen', 'delete') ?>')"><?php echo i18n::__('eliminar') ?></button>
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
