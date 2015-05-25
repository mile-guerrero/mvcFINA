<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php $idEmpresa = empresaTableClass::ID ?>
<?php $nombre = empresaTableClass::NOMBRE?>
<?php $direccion = empresaTableClass::DIRECCION ?>
<?php $telefono = empresaTableClass::TELEFONO?>
<?php $email = empresaTableClass::EMAIL ?>



<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('empresa', ((isset($objEmpresa)) ? 'update' : 'create')) ?>">
  <?php if(isset($objEmpresa)==true): ?>
  <input  name="<?php echo empresaTableClass::getNameField(empresaTableClass::ID,true) ?>" value="<?php echo $objEmpresa[0]->$idEmpresa ?>" type="hidden">
  <?php endif ?>
 <?php view::includeHandlerMessage()?>
  <div class="form-group">
      <label for="<?php echo empresaTableClass::getNameField(empresaTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objEmpresa)==true) ? $objEmpresa[0]->$nombre: '') ?>"  type="text" name="<?php echo empresaTableClass::getNameField(empresaTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
     </div>
  </div>   
  
  <div class="form-group">
      <label for="<?php echo empresaTableClass::getNameField(empresaTableClass::DIRECCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('dir') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control"  value="<?php echo ((isset($objEmpresa)==true) ? $objEmpresa[0]->$direccion : '') ?>" type="text" name="<?php echo empresaTableClass::getNameField(empresaTableClass::DIRECCION, true) ?>" placeholder="<?php echo i18n::__('dir') ?>" required>
      </div>
  </div>
  
  <div class="form-group">
      <label for="<?php echo empresaTableClass::getNameField(empresaTableClass::TELEFONO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tel') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control"  value="<?php echo ((isset($objEmpresa)==true) ? $objEmpresa[0]->$telefono : '') ?>" type="text" name="<?php echo empresaTableClass::getNameField(empresaTableClass::TELEFONO, true) ?>" placeholder="<?php echo i18n::__('tel') ?>" required>
      </div>
  </div>
       
      <div class="form-group">
      <label for="<?php echo empresaTableClass::getNameField(empresaTableClass::EMAIL, true) ?>" class="col-sm-2"> <?php echo i18n::__('email') ?>: </label>     
      <div class="col-sm-10"> 
         <input class="form-control"  value="<?php echo ((isset($objEmpresa)==true) ? $objEmpresa[0]->$email : '') ?>" type="text" name="<?php echo empresaTableClass::getNameField(empresaTableClass::EMAIL, true) ?>" placeholder="<?php echo i18n::__('email') ?>" required>
        </div> 
      </div>
  
   <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objEmpresa)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('empresa', 'index') ?>" ><?php echo i18n::__('atras') ?></a>

  </form>
  </article>
  </div>