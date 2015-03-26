<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $orden = detalleOrdenServicioTableClass::ORDEN_SERVICIO_ID ?>
<h1>EDITAR ORDEN SERVICIO <?php echo $objDOS[0]->$orden ?> </h1>
<?php view::includePartial('detalleOrdenServicio/formularioPrincipal',array('objDOS'=>$objDOS, 'orden_servicio_id'=>$orden)) ?>