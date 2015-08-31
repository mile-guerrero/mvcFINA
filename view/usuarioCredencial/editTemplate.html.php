<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo2">
<h2 class="form-signin-heading">
 <?php echo i18n::__('modificar') ?> 
</h2>
     <br><br>
   </div>
   <?php view::includePartial('usuarioCredencial/formularioPrincipal',array('objUC'=>$objUC, 'usuario_id'=>$usuario,'objUCU'=>$objUCU,'objUCC'=>$objUCC)) ?>
</div>