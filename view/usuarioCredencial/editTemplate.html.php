<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <h2 class="form-signin-heading">
 <?php echo i18n::__('editar usu cre') ?> <?php echo $objUC[0]->$usuario ?> </h2>
  </article>
   <?php view::includePartial('usuarioCredencial/formularioPrincipal',array('objUC'=>$objUC, 'usuario_id'=>$usuario,'objUCU'=>$objUCU,'objUCC'=>$objUCC)) ?>
</div>