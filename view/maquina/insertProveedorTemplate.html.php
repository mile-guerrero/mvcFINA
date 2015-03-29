<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
    <h1> <?php echo i18n::__('nuevo proveedor') ?> <?php echo $mensaje?></h1>
  </article>
<?php view::includePartial('maquina/formularioPrincipalProveedor', array('objCiudad' => $objCiudad))?>
<?php view::includePartial('maquina/formularioPrincipalProveedor', array('mensaje' => $mensaje))?>
</div>