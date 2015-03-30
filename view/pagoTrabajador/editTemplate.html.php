<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $idPagoT = pagoTrabajadorTableClass::ID?>
<div class="container container-fluid" id="cuerpo">
  <h2 class="form-signin-heading">
    <?php echo i18n::__('editar credencial') ?> 
  </h2>
   <?php view::includePartial('pagoTrabajador/formularioPrincipal', array('objPagoT' => $objPagoT, 'idPagoT' => $idPagoT, 'objEmpresa' => $objEmpresa)) ?>
</div>
  