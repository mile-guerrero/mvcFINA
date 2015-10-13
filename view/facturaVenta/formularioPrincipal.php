<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>



<?php $fecha = facturaVentaTableClass::FECHA ?>
<?php $created_at = facturaVentaTableClass::CREATED_AT ?>
<?php $updated_at = facturaVentaTableClass::UPDATED_AT ?>

<?php $cliente = facturaVentaTableClass::CLIENTE_ID ?>
<?php $idCliente = clienteTableClass::ID ?>
<?php $nomCliente = clienteTableClass::NOMBRE ?>

<?php $trabajador = facturaVentaTableClass::TRABAJADOR_ID ?>
<?php $idTrabajador = trabajadorTableClass::ID ?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo3">
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', ((isset($objFactura)) ? 'update' : 'create')) ?>">
    <?php if (isset($objFactura) == true): ?>
    <input  name="<?php echo facturaVentaTableClass::getNameField(facturaVentaTableClass::ID, true) ?>" value="<?php echo $objFactura[0]->$idFactura ?>" type="hidden">
    <?php endif ?>
    
    <br><br><br><br><br>
    
    <?php  date_default_timezone_set('America/Bogota'); ?>  
        <?php if (session::getInstance()->hasError('selectFechaIni')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectFechaIni') ?>
          </div>
        <?php endif ?>
    
     <div class="form-group">
       <label for="<?php echo facturaVentaTableClass::getNameField(facturaVentaTableClass::FECHA, true) ?>" class="col-sm-2"><?php echo i18n::__('fechaNormal') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('fechaPagoFin') or request::getInstance()->hasPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::FECHA, true))) ? request::getInstance()->getPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::FECHA, true)) : ((isset($objFactura) == true) ? date('Y-m-d\TH:i:s', strtotime($objFactura[0]->$fecha)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo facturaVentaTableClass::getNameField(facturaVentaTableClass::FECHA, true) ?>"required >
      </div>
  </div>
    
    
    <?php if(session::getInstance()->hasError('selectTrabajador')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectTrabajador') ?>
    </div>
    <?php endif ?>
      
     
      
      <div class="form-group">
      <label for="<?php echo facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true) ?>" class="col-sm-2">  <?php echo i18n::__('trabajador') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true)?>" name="<?php echo facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true);?>"required>
        <option value="<?php echo (session::getInstance()->hasFlash('selectTrabajador') or request::getInstance()->hasPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true))) ? request::getInstance()->getPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true)) : ((isset($objFactura[0])) ? '' : '') ?>"><?php echo i18n::__('selectTrabajador') ?></option>
       <?php foreach($objTrabajador as $key):?>
        <option <?php echo (request::getInstance()->hasPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true)) === true and request::getInstance()->getPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::TRABAJADOR_ID, true)) == $key->$idTrabajador) ? 'selected' : (isset($objFactura[0]->$trabajador) === true and $objFactura[0]->$trabajador == $key->$idTrabajador) ? 'selected' : '' ?> value="<?php echo $key->$idTrabajador ?>"><?php echo $key->$nomTrabajador . ' ' . trabajadorTableClass::getNameApellido($key->$idTrabajador). ' ' .  ' CC: ' . ' ' . trabajadorTableClass::getNameDocumento($key->$idTrabajador) ?></option>
       <?php endforeach;?>
   </select> 
      </div> 
    </div>
       
      <?php if(session::getInstance()->hasError('selectCliente')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectCliente') ?>
    </div>
    <?php endif ?>
      
     
      
      <div class="form-group">
      <label for="<?php echo facturaVentaTableClass::getNameField(facturaVentaTableClass::CLIENTE_ID, true) ?>" class="col-sm-2">  <?php echo i18n::__('cliente') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php facturaVentaTableClass::getNameField(facturaVentaTableClass::CLIENTE_ID, true)?>" name="<?php echo facturaVentaTableClass::getNameField(facturaVentaTableClass::CLIENTE_ID, true);?>"required>
        <option value="<?php echo (session::getInstance()->hasFlash('selectCliente') or request::getInstance()->hasPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::CLIENTE_ID, true))) ? request::getInstance()->getPost(facturaVentaTableClass::getNameField(facturaVentaTableClass::CLIENTE_ID, true)) : ((isset($objFactura[0])) ? '' : '') ?>"><?php echo i18n::__('selectCliente') ?></option>
       <?php foreach($objCliente as $clien):?>
       <option <?php echo (isset($objFactura[0]->$cliente) === true and $objFactura[0]->$cliente == $clien->$idCliente) ? 'selected' : '' ?> value="<?php echo $clien->$idCliente?>"><?php echo $clien->$nomCliente . ' ' . clienteTableClass::getNameApellido($clien->$idCliente). ' ' .  ' CC: ' . ' ' . clienteTableClass::getNameDocumento($clien->$idCliente) ?></option>
       <?php endforeach;?>
   </select> 
      </div> 
    </div>

          

    <input   class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objFactura)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>