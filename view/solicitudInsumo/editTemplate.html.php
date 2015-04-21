<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<div class="container container-fluid" id="cuerpo">
  <h2 class="form-signin-heading">
    <?php echo i18n::__('solicitudInsumo') ?> 
  </h2>
   <?php view::includePartial('solicitudInsumo/formularioPrincipal', array('objS' => $objS, 'objT' => $objT, 'objP' => $objP, 'objL' => $objL)) ?>
</div>
  