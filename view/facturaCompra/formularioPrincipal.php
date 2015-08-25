<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>
<?php $fecha = facturaCompraTableClass::FECHA ?>
<?php $created_at = facturaCompraTableClass::CREATED_AT ?>

<?php $proveedor = facturaCompraTableClass::PROVEEDOR_ID ?>
<?php $idProveedor = proveedorTableClass::ID ?>
<?php $nomProveedor = proveedorTableClass::NOMBREP ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
    
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', ((isset($objFactura)) ? 'update' : 'create')) ?>">
    <?php if (isset($objFactura) == true): ?>
    <input  name="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::ID, true) ?>" value="<?php echo $objFactura[0]->$idFactura ?>" type="hidden">
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
       <label for="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::FECHA, true) ?>" class="col-sm-2"><?php echo i18n::__('fechaNormal') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('fechaPagoFin') or request::getInstance()->hasPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::FECHA, true))) ? request::getInstance()->getPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::FECHA, true)) : ((isset($objFactura) == true) ? date('Y-m-d\TH:i:s', strtotime($objFactura[0]->$fecha)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::FECHA, true) ?>"required readonly>
      </div>
  </div>
    
    <?php if(session::getInstance()->hasError('selectProveedor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectProveedor') ?>
    </div>
    <?php endif ?>
      
     
      
      <div class="form-group">
      <label for="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::PROVEEDOR_ID, true) ?>" class="col-sm-2">  <?php echo i18n::__('proveedor') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php facturaCompraTableClass::getNameField(facturaCompraTableClass::PROVEEDOR_ID, true)?>" name="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::PROVEEDOR_ID, true);?>"required>
        <option value="<?php echo (session::getInstance()->hasFlash('selectProveedor') or request::getInstance()->hasPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::PROVEEDOR_ID, true))) ? request::getInstance()->getPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::TRABAJADOR_ID, true)) : ((isset($objFactura[0])) ? '' : '') ?>"><?php echo i18n::__('selectProveedor') ?></option>
       <?php foreach($objProveedor as $key):?>
      <option <?php echo (request::getInstance()->hasPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::PROVEEDOR_ID, true)) === true and request::getInstance()->getPost(facturaCompraTableClass::getNameField(facturaCompraTableClass::PROVEEDOR_ID, true)) == $key->$idProveedor) ? 'selected' : (isset($objFactura[0]->$proveedor) === true and $objFactura[0]->$proveedor == $key->$idProveedor) ? 'selected' : '' ?> value="<?php echo $key->$idProveedor ?>"><?php echo $key->$nomProveedor . ' ' . proveedorTableClass::getApellidoProveedor($key->$idProveedor). ' ' .  ' CC: ' . ' ' . proveedorTableClass::getDocumentoProveedor($key->$idProveedor)  ?></option>
       <?php endforeach;?>
   </select> 
      </div> 
    </div>
    
   

          

    <input   class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objFactura)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

       <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>