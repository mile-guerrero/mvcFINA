<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo2">
  <h2 class="form-signin-heading"><?php echo i18n::__('nuevo') ?> </h2>
  <br>
    <br>
</div>
<?php view::includePartial('solicitudInsumo/formularioPrincipal',array ('objT' => $objT, 'objP' => $objP, 'objL' => $objL))?>
</div>