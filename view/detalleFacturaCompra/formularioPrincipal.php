<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php $idDetalle = detalleFacturaCompraTableClass::ID ?>
<?php $descripcion = detalleFacturaCompraTableClass::DESCRIPCION ?>
<?php $cantidad = detalleFacturaCompraTableClass::CANTIDAD ?>
<?php $valor_unidad = detalleFacturaCompraTableClass::VALOR_UNIDAD ?>
<?php $valor_total = detalleFacturaCompraTableClass::VALOR_TOTAL ?>
<?php $idFactura = facturaCompraTableClass::ID ?>
<?php $fecha = facturaCompraTableClass::FECHA ?>
<?php $facturaCompra = detalleFacturaCompraTableClass::FACTURA_COMPRA_ID ?>
<?php $proveedor = detalleFacturaCompraTableClass::PROVEEDOR_ID ?>
<?php $idProveedor = proveedorTableClass::ID ?>
<?php $nomProveedor = proveedorTableClass::NOMBREP ?>
<div class="container container-fluid" id="cuerpo">
  <form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', ((isset($objDetalleFactura)) ? 'update' : 'create')) ?>">
<?php if (isset($objDetalleFactura) == true): ?>
      <input  name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::ID, true) ?>" value="<?php echo $objDetalleFactura[0]->$idDetalle ?>" type="hidden">
<?php endif ?>

    <div class="form-group">
      <label for="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:</label>     
      <div class="col-sm-10">
          <input class="form-control" value="<?php echo ((isset($objDetalleFactura) == true) ? $objDetalleFactura[0]->$descripcion : '') ?>" type="text" name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>">
      </div>
    </div>  

    <div class="form-group">
      <label for="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::CANTIDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('cantidad') ?>:</label>     
      <div class="col-sm-10">            
          <input class="form-control" value="<?php echo ((isset($objDetalleFactura) == true) ? $objDetalleFactura[0]->$cantidad : '') ?>" type="text" name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
      </div>
    </div> 

    <div class="form-group">
      <label for="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_UNIDAD, true) ?>" class="col-sm-2"><?php echo i18n::__('valorPorUnidad') ?>: </label>     
      <div class="col-sm-10">             
          <input class="form-control" value="<?php echo ((isset($objDetalleFactura) == true) ? $objDetalleFactura[0]->$valor_unidad : '') ?>" type="text" name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_UNIDAD, true) ?>" placeholder="<?php echo i18n::__('valorPorUnidad') ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_TOTAL, true) ?>" class="col-sm-2"><?php echo i18n::__('total') ?>:  </label>     
      <div class="col-sm-10">              
          <input class="form-control" value="<?php echo ((isset($objDetalleFactura) == true) ? $objDetalleFactura[0]->$valor_total : '') ?>" type="text" name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::VALOR_TOTAL, true) ?>" placeholder="<?php echo i18n::__('total') ?>">
      </div>
    </div>

   <?php $idFacturar = request::getInstance()->getGet('id') ?>
    <div class="form-group">
            <label class="col-sm-2" >Factura:</label>
            <div class="col-sm-10">
                <select class="form-control" id="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_COMPRA_ID, TRUE) ?>" name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_COMPRA_ID, TRUE) ?>">
                    <?php foreach ($objFactura as $fact): ?>
                        <option <?php echo ($idFacturar == $fact->$idFactura) ? 'selected' : '' ?> value="<?php echo $fact->$idFactura ?>">
                            <?php echo $fact->$idFactura ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
         
    <div class="form-group">
      <label for="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::PROVEEDOR_ID, true) ?>" class="col-sm-2">  <?php echo i18n::__('nomProveedor') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::PROVEEDOR_ID, true)?>" name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::PROVEEDOR_ID, true);?>">
       <option><?php echo i18n::__('selectProveedor') ?></option>
       <?php foreach($objProveedor as $pro):?>
       <option <?php echo (isset($objDetalleFactura[0]->$proveedor) === true and $objDetalleFactura[0]->$proveedor == $pro->$idProveedor) ? 'selected' : '' ?> value="<?php echo $pro->$idProveedor?>"><?php echo $pro->$nomProveedor?></option>
       <?php endforeach;?>
   </select> 
      </div> 
    </div>

    <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objDetalleFactura)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>
  </form> 
</div>