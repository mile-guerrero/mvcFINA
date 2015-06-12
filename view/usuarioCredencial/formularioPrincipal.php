<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $iddUC = usuarioCredencialTableClass::ID ?>
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $usuarios = usuarioTableClass::ID ?>
<?php $des_usuarios = usuarioTableClass::USUARIO ?>
<?php $id_usuarios = usuarioTableClass::ID ?>
<?php $credencial = usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $credencials = credencialTableClass::ID ?>
<?php $des_credencials = credencialTableClass::NOMBRE ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', ((isset($objUC)) ? 'update' : 'create')) ?>">
  <?php if(isset($objUC)== true): ?>
  <input  name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" value="<?php echo $objUC[0]->$iddUC ?>" type="hidden">
  <?php endif ?>
  
  
  
  <div class="form-group">
    <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>" class="col-sm-2"><?php echo i18n::__('usu_id') ?>: </label>
      <div class="col-sm-10"> 
       <select class="form-control " id="<?php usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true); ?>">
         <option><?php echo i18n::__('selectCiudad')?></option>
       <?php foreach($objUCU as $U):?>
       <option <?php echo (isset($objUC[0]->$usuario) === true and $objUC[0]->$usuario == $U->$id_usuarios) ? 'selected' : '' ?> value="<?php echo $U->$id_usuarios ?>"><?php echo $U->$des_usuarios ?></option>  
<!--       <option <?php //echo (request::getInstance()->hasPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)) === true and request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)) == $U->$id_usuarios) ? 'selected' : (isset($objUC[0]->$usuario) === true and $objUC[0]->$usuario == $U->$id_usuarios) ? 'selected' : '' ?>  value="<?php //echo $U->$id_usuarios ?>"><?php //echo $U->$des_usuarios ?></option> -->
       <?php endforeach;?>
   </select>    
      </div> 
    </div> 
   
  <div class="form-group">
      <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>" class="col-sm-2"><?php echo i18n::__('cre_id') ?>: </label>
      <div class="col-sm-10"> 
       <select class="form-control " id="<?php usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true); ?>">
       <option><?php echo i18n::__('selectCiudad')?></option>
         <?php foreach($objUCC as $C):?>
          <option <?php echo (isset($objUC[0]->$credencial) === true and $objUC[0]->$credencial == $C->$credencials) ? 'selected' : '' ?> value="<?php echo $C->$credencials ?>"><?php echo $C->$des_credencials ?></option>  
       <?php endforeach;?>
   </select>    
      </div> 
    </div> 
  
  
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objUC)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
  </article>
</div>