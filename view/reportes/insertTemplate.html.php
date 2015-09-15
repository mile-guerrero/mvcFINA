<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php $value = session::getInstance()->getAttribute('idGrafica'); ?>
 <?php if ($value == 1 or $value == 2) : ?>
<div class="container container-fluid" id="cuerpo">
<div class="center-block" id="cuerpo2">
<h2 class="form-signin-heading">
<?php echo i18n::__('reportes') ?>
</h2>
  <br><br>
   </div>
<?php view::includePartial('reportes/formularioPrincipal',array('objLote'=>$objLote,'objLoteR'=>$objLoteR)) ?>
</div>
<?php endif; ?> 



<?php $value = session::getInstance()->getAttribute('idGrafica');?>
      <?php if ($value == 3) : ?>
<div class="container container-fluid" id="cuerpo">
<div class="center-block" id="cuerpo2">
<h2 class="form-signin-heading">
<?php echo i18n::__('reportes') ?>
</h2>
  <br><br>
   </div>
<?php view::includePartial('reportes/formularioTrabajador',array('objTrabajador'=>$objTrabajador)) ?>
</div>
<?php endif; ?>

<?php $value = session::getInstance()->getAttribute('idGrafica');?>
<?php if ($value == 4) : ?>
<div class="container container-fluid" id="cuerpo">
<div class="center-block" id="cuerpo2">
<h2 class="form-signin-heading">
<?php echo i18n::__('reportes') ?>
</h2>
  <br><br>
   </div>
<?php view::includePartial('reportes/formularioPresupuesto',array('objLoteR'=>$objLoteR)) ?>
</div>
<?php endif; ?>