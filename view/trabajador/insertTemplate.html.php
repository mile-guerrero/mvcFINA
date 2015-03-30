<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid" id="cuerpo">
<h2 class="form-signin-heading"><?php echo i18n::__('nuevoTrabajador') ?> </h2>
<?php view::includePartial('trabajador/formularioPrincipal',array ('objCC' => $objCC, 'objCTI' => $objCTI, 'objCredencial' => $objCredencial))?>
</div>
<!-- <form id="frmTraductor" action="<?php echo routing::getInstance()->getUrlWeb('cliente', 'traductor')?>" method="POST">
    <select name="language" onchange="$('#frmTraductor').submit()">
    <option <?php echo (config::getDefaultCulture() == 'es') ? 'selected' : '' ?> value="es">Español</option>
    <option <?php echo (config::getDefaultCulture() == 'en') ? 'selected' : '' ?> value="en">English</option>
  </select>
    <input type="text" name="PATH_INFO" value="<?php echo request::getInstance()->getServer('PATH_INFO')?>">
</form>-->