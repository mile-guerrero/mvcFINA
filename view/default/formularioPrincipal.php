<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $idUsuario = usuarioTableClass::ID ?>
<?php $password = usuarioTableClass::PASSWORD ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form   class="form-horizontal" role="form" class="form-horizontal" role="form"  method="post" action="<?php echo routing::getInstance()->getUrlWeb('default', ((isset($objUsuarios)) ? 'update' : 'create')) ?>">
  <?php if(isset($objUsuarios)==true): ?>
  <input  name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID,true) ?>" value="<?php echo $objUsuarios[0]->$idUsuario ?>" type="hidden">
  <?php endif ?>
 <?php view::includeHandlerMessage()?>
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::USUARIO, true) ?>" class="col-sm-2"> <?php echo i18n::__('user') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objUsuarios)==true) ? $objUsuarios[0]->$usuario : '') ?>"  type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true) ?>" placeholder="<?php echo i18n::__('user') ?>" required>
     </div>
  </div>  
  
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1' ?>" class="col-sm-2"> <?php echo i18n::__('pass') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1' ?>" value="<?php echo ((isset($objUsuarios)==true) ? $objUsuarios[0]->$password : '') ?>" type="password" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_1' ?>" placeholder="<?php echo i18n::__('pass') ?>" required>
      </div>
  </div>   
  
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2' ?>" class="col-sm-2"> <?php echo i18n::__('pass') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2' ?>" value="<?php echo ((isset($objUsuarios)==true) ? $objUsuarios[0]->$password : '') ?>" type="password" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_2' ?>" placeholder="<?php echo i18n::__('pass') ?>" required>
      </div>
  </div> 
    
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objUsuarios)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>" ><?php echo i18n::__('atras') ?></a>

  </form>
  </article>
  </div>





<!--<div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_1' ?>" class="col-lg-2 control-label"><?php echo i18n::__('mail') ?>:</label>
            <div class="col-lg-10">
                <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_1' ?>" type="text" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$correo : '') ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_1' ?>" placeholder="<?php echo i18n::__('Enter your Mail') ?>">
                <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_2' ?>" class="col-lg-2 control-label"><?php echo i18n::__('Verify Mail') ?>:</label>
            <div class="col-lg-10">
                <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_2' ?>" type="text" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$correo : '') ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_2' ?>" placeholder="<?php echo i18n::__('Verify Mail') ?>">
                <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>-->