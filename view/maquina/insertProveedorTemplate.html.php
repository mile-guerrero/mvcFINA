<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo2">
     <h2> <?php echo i18n::__('registroProveedor') ?></h2>
 <br>
    <br>
</div>
<?php view::includePartial('maquina/formularioPrincipalProveedor', array('objCiudad' => $objCiudad))?>
</div>