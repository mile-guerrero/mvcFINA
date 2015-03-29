<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $iddUC = usuarioCredencialTableClass::ID ?>
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $usuarios = usuarioTableClass::ID ?>
<?php $des_usuarios = usuarioTableClass::USUARIO ?>
<?php $credencial = usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $credencials = credencialTableClass::ID ?>
<?php $des_credencials = credencialTableClass::NOMBRE ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', ((isset($objUC)) ? 'update' : 'create')) ?>">
  <?php if(isset($objUC)== true): ?>
  <input  name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" value="<?php echo $objUC[0]->$iddUC ?>" type="hidden">
  <?php endif ?>
    <?php view::includeHandlerMessage()?>
  <div class="form-group">
    <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>" class="col-sm-2"><?php echo i18n::__('usu_id') ?>: </label>
      <div class="col-sm-10"> 
       <select class="form-control" id="<?php usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, TRUE)?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, TRUE);?>">
       <option><?php echo i18n::__('selectUsuario') ?></option>
       <?php foreach($objUCU as $U):?>
       <option value="<?php echo $U->$usuarios?>"><?php echo $U->$des_usuarios?></option>
       <?php endforeach;?>
   </select>    
      </div> 
    </div> 
   
  <div class="form-group">
      <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>" class="col-sm-2"><?php echo i18n::__('cre_id') ?>: </label>
      <div class="col-sm-10"> 
       <select class="form-control" id="<?php  usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, TRUE)?>" name="<?php echo  usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, TRUE);?>">
       <option><?php echo i18n::__('selectCredencial') ?></option>
       <?php foreach($objUCC as $C):?>
       <option value="<?php echo $C->$credencials ?>"><?php echo $C->$des_credencials?></option>
       <?php endforeach;?>
   </select>    
      </div> 
    </div> 
  
  
  <input class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objUC)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
  </article>
</div>