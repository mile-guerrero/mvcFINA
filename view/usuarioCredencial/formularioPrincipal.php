<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $iddUC = usuarioCredencialTableClass::ID ?>
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $usuarios = usuarioTableClass::ID ?>
<?php $des_usuarios = usuarioTableClass::USUARIO ?>
<?php $id_usuarios = usuarioTableClass::ID ?>
<?php $credencial = usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $credencials = credencialTableClass::ID ?>
<?php $des_credencials = credencialTableClass::NOMBRE ?>


<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', ((isset($objUC)) ? 'update' : 'create')) ?>">
  <?php if(isset($objUC)== true): ?>
  <input  name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" value="<?php echo $objUC[0]->$iddUC ?>" type="hidden">
  <?php endif ?>
  
  <br><br><br><br><br>
  <?php if(session::getInstance()->hasError('selectUsuario')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectUsuario') ?>
    </div>
    <?php endif ?>
  
  <div class="form-group">
    <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>" class="col-sm-2"><?php echo i18n::__('usu_id') ?>: </label>
      <div class="col-sm-10"> 
       <select class="form-control " id="<?php usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true); ?>">
         <option value="<?php echo (session::getInstance()->hasFlash('selectUsuario') or request::getInstance()->hasPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true))) ? request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)) : ((isset($objUC[0])) ? '' : '') ?>"><?php echo i18n::__('selectUsuario')?></option>
       <?php foreach($objUCU as $key):?>
       <option <?php echo (request::getInstance()->hasPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)) === true and request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)) == $key->$id_usuarios) ? 'selected' : (isset($objUC[0]->$usuario) === true and $objUC[0]->$usuario == $key->$id_usuarios) ? 'selected' : '' ?> value="<?php echo $key->$id_usuarios ?>"><?php echo $key->$des_usuarios ?></option>  
<!--       <option <?php //echo (request::getInstance()->hasPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)) === true and request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)) == $U->$id_usuarios) ? 'selected' : (isset($objUC[0]->$usuario) === true and $objUC[0]->$usuario == $U->$id_usuarios) ? 'selected' : '' ?>  value="<?php //echo $U->$id_usuarios ?>"><?php //echo $U->$des_usuarios ?></option> -->
       <?php endforeach;?>
   </select>    
      </div> 
    </div> 
   <?php if(session::getInstance()->hasError('selectCredencial')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectCredencial') ?>
    </div>
    <?php endif ?>
  <div class="form-group">
      <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>" class="col-sm-2"><?php echo i18n::__('cre_id') ?>: </label>
      <div class="col-sm-10"> 
       <select class="form-control " id="<?php usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true); ?>">
         <option value="<?php echo (session::getInstance()->hasFlash('selectCredencial') or request::getInstance()->hasPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true))) ? request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true)) : ((isset($objUC[0])) ? '' : '') ?>"><?php echo i18n::__('selectCredencial')?></option>
         <?php foreach($objUCC as $key):?>
          <option <?php echo (request::getInstance()->hasPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true)) === true and request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true)) == $key->$credencials) ? 'selected' : (isset($objUC[0]->$credencial) === true and $objUC[0]->$credencial == $key->$credencials) ? 'selected' : '' ?> value="<?php echo $key->$credencials ?>"><?php echo $key->$des_credencials ?></option>  
       <?php endforeach;?>
   </select>    
      </div> 
    </div> 
  
  
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objUC)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>