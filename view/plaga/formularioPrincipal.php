<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php $idPlaga = plagaTableClass::ID ?>
<?php $nombre = plagaTableClass::NOMBRE ?>
<?php $descripcion = plagaTableClass::DESCRIPCION ?>
<?php $tratamiento = plagaTableClass::TRATAMIENTO ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo3">
    
    <form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('plaga', ((isset($objPlaga)) ? 'update' : 'create')) ?>">
<?php if (isset($objPlaga) == true): ?>
        <input  name="<?php echo plagaTableClass::getNameField(plagaTableClass::ID, true) ?>" value="<?php echo $objPlaga[0]->$idPlaga ?>" type="hidden">
<?php endif ?>
<br><br><br><br>
 
  <br>
     <?php if(session::getInstance()->hasError('inputNombre')): ?>
   <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?>
    </div>
    <?php endif ?>
        

        
      <div class="form-group">
      <label for="<?php echo plagaTableClass::getNameField(plagaTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
        <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputNombre') or request::getInstance()->hasPost(plagaTableClass::getNameField(plagaTableClass::NOMBRE, true))) ? request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::NOMBRE, true)) : ((isset($objPlaga[0])) ? $objPlaga[0]->$nombre : '') ?>" type="text" name="<?php echo plagaTableClass::getNameField(plagaTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>"required>
        </div>
      </div>  

        
    <?php if(session::getInstance()->hasError('inputDescripcion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescripcion') ?>
    </div>
    <?php endif ?>   
        
      <div class="form-group">
        <label for="<?php echo plagaTableClass::getNameField(plagaTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:</label>     
        <div class="col-sm-10">            
          <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(plagaTableClass::getNameField(plagaTableClass::DESCRIPCION, true))) ? request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::DESCRIPCION, true)) : ((isset($objPlaga[0])) ? $objPlaga[0]->$descripcion : '') ?>" type="text" name="<?php echo plagaTableClass::getNameField(plagaTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>"required>
        </div>
      </div> 
        
      
        
     <?php if(session::getInstance()->hasError('inputTratamiento')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputTratamiento') ?>
    </div>
    <?php endif ?> 
     
        
    
    <div class="form-group">
        <label for="<?php echo plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tratamiento') ?>:</label>     
        <div class="col-sm-10">            
          <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputTratamiento') or request::getInstance()->hasPost(plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO, true))) ? request::getInstance()->getPost(plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO, true)) : ((isset($objPlaga[0])) ? $objPlaga[0]->$tratamiento : '') ?>" type="text" name="<?php echo plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO, true) ?>" placeholder="<?php echo i18n::__('tratamiento') ?>"required>
        </div>
      </div> 



      <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objPlaga)) ? 'update' : 'register')) ?>">
      <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('plaga', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>