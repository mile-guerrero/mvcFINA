<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idOrden = detalleOrdenServicioTableClass::ID ?>
<?php $orden = detalleOrdenServicioTableClass::ORDEN_SERVICIO_ID ?>
<?php $producto = detalleOrdenServicioTableClass::PRODUCTO_INSUMO_ID ?>
<?php $cantidad = detalleOrdenServicioTableClass::CANTIDAD ?>
<?php $valor = detalleOrdenServicioTableClass::VALOR ?>
<?php $maquina = detalleOrdenServicioTableClass::MAQUINA_ID ?>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('detalleOrdenServicio', ((isset($objDOS)) ? 'update' : 'create')) ?>">
  <?php if(isset($objDOS)==true): ?>
  <input  name="<?php echo detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::ID, true) ?>" value="<?php echo $objDOS[0]->$idOrden ?>" type="hidden">
  <?php endif ?>
  
  <?php echo i18n::__('orden') ?>: <input value="<?php echo ((isset($objDOS)== true) ? $objDOS[0]->$orden : '') ?>" type="text" name="<?php echo detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::ORDEN_SERVICIO_ID, true) ?>">
  <br>
  <?php echo i18n::__('producto') ?>: <input value="<?php echo ((isset($objDOS)== true) ? $objDOS[0]->$producto : '') ?>" type="text" name="<?php echo detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::PRODUCTO_INSUMO_ID, true) ?>">
  <br>
  <br>
  <?php echo i18n::__('cantidad') ?>: <input value="<?php echo ((isset($objDOS)== true) ? $objDOS[0]->$cantidad : '') ?>" type="text" name="<?php echo detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::CANTIDAD, true) ?>">
  <br>
  <br>
  <?php echo i18n::__('valor') ?>: <input value="<?php echo ((isset($objDOS)== true) ? $objDOS[0]->$valor : '') ?>" type="text" name="<?php echo detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::VALOR, true) ?>">
  <br>
  <br>
  <?php echo i18n::__('maquina') ?>: <input value="<?php echo ((isset($objDOS)== true) ? $objDOS[0]->$maquina : '') ?>" type="text" name="<?php echo detalleOrdenServicioTableClass::getNameField(detalleOrdenServicioTableClass::MAQUINA_ID, true) ?>">
  <br>
  <input type="submit" value="<?php echo i18n::__(((isset($objDOS)) ? 'update' : 'register')) ?>">
</form>