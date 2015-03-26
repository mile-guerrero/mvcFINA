<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idUsuario = usuarioTableClass::ID ?>
<?php $password = usuarioTableClass::PASSWORD ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form   class="form-horizontal" role="form" class="form-horizontal" role="form"  method="post" action="<?php echo routing::getInstance()->getUrlWeb('default', ((isset($objUsuarios)) ? 'update' : 'create')) ?>">
  <?php if(isset($objUsuarios)==true): ?>
  <input  name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID,true) ?>" value="<?php echo $objUsuarios[0]->$idUsuario ?>" type="hidden">
  <?php endif ?>
 
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::USUARIO, true) ?>" class="col-sm-2"> <?php echo i18n::__('user') ?>:</label>     
      <div class="col-sm-10">
      <input class="form-control" value="<?php echo ((isset($objUsuarios)==true) ? $objUsuarios[0]->$usuario : '') ?>"  type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true) ?>">
     </div>
  </div>  
  
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>" class="col-sm-2"> <?php echo i18n::__('pass') ?>:</label>     
      <div class="col-sm-10"> 
  <input class="form-control" value="<?php echo ((isset($objUsuarios)==true) ? $objUsuarios[0]->$password : '') ?>" type="password" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>">
      </div>
  </div>    
    
  <input class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objUsuarios)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>" ><?php echo i18n::__('atras') ?></a>

  </form>
  </article>
  </div>