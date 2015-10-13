<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $idDetalle = detalleFacturaVentaTableClass::ID ?>
<?php $cantidad = detalleFacturaVentaTableClass::CANTIDAD ?>
<?php $valor_unidad = detalleFacturaVentaTableClass::VALOR_UNIDAD ?>
<?php $valor_total = detalleFacturaVentaTableClass::VALOR_TOTAL ?>
<?php $idFactura = facturaVentaTableClass::ID ?>
<?php $fecha = facturaVentaTableClass::FECHA ?>
<?php $factura = detalleFacturaVentaTableClass::FACTURA_ID ?>

<?php $insumo = detalleFacturaVentaTableClass::DESCRIPCION ?>
<?php $idInsumo = tipoProductoInsumoTableClass::ID ?>
<?php $nomInsumo = tipoProductoInsumoTableClass::DESCRIPCION ?>

<?php $insumoInsumo = detalleFacturaVentaTableClass::DESCRIPCION ?>
<?php $idInsumoInsumo = productoInsumoTableClass::ID ?>
<?php $nomInsumoInsumo = productoInsumoTableClass::DESCRIPCION ?>

<?php $idUnidadMedidaId = detalleFacturaVentaTableClass::UNIDAD_MEDIDA_ID ?>
<?php $idUnidadMedida = unidadMedidaTableClass::ID ?>
<?php $desUnidadMedida = unidadMedidaTableClass::DESCRIPCION ?>


<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
    <div class="center-block" id="cuerpo3">

      <script>
        function fncTotal() {
          caja = document.forms["sumar"].elements;
          var <?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true) ?> = Number(caja["<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true) ?>"].value);
          var <?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true) ?> = Number(caja["<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true) ?>"].value);

<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true) ?> = (<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true) ?>) * (<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true) ?>);
          if (!isNaN(<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true) ?>)) {
            caja["<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true) ?>"].value = (<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true) ?>) * (<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true) ?>);
          }
        }
      </script>

      <form name="sumar" class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', ((isset($objDetalleFactura)) ? 'update' : 'create')) ?>">
        <?php if (isset($objDetalleFactura) == true): ?>
          <input  name="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::ID, true) ?>" value="<?php echo $objDetalleFactura[0]->$idDetalle ?>" type="hidden">
        <?php endif ?>


        <br><br><br><br><br>



        <?php if (session::getInstance()->hasError('inputDescripcion')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescripcion') ?>
          </div>
        <?php endif ?>


 
        <div class="form-group">
          <label class="col-sm-2"  for="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true) ?>">  <?php echo i18n::__('selectTPI') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control" id="slcTipoDeInsumo" required onchange="cargarInsumo('<?php echo routing::getInstance()->getUrlWeb('@getInsumo') ?>')">
              <option value="">Seleccione el tipo de insumo</option>
              <?php foreach ($objTipo as $key): ?>
              <option <?php echo (isset($idTipoProducto) and $idTipoProducto == $key->$idInsumo ) ? 'selected' : '' ?> value="<?php echo $key->$idInsumo ?>"><?php echo $key->$nomInsumo ?></option>
              <?php endforeach; ?>
             
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2" for="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true) ?>" >  <?php echo i18n::__('des') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control" id="slcInsumo" name="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true); ?>" required>
              <option value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true))) ? request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true)) : ((isset($objDetalleFactura[0])) ? '' : '') ?>"><?php echo i18n::__('selectInsumo') ?></option>
              <?php  foreach ($objProducto as $key): ?>
         
              <option <?php echo (request::getInstance()->hasPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true)) === true and request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION, true)) == $key->$idInsumoInsumo) ? 'selected' : (isset($objDetalleFactura[0]->$insumoInsumo) === true and $objDetalleFactura[0]->$insumoInsumo == $key->$idInsumoInsumo) ? 'selected' : ''  ?> value="<?php echo $key->$idInsumoInsumo  ?>"><?php echo $key->$nomInsumoInsumo  ?></option>
                <?php  endforeach; ?>
            </select>
          </div>
        </div>
        <br>
        <?php if (session::getInstance()->hasError('inputCantidad')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?>
          </div>
        <?php endif ?>

        <div class="row j1" >
          <label for="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('cantidad') ?>:</label>
          <div class="col-sm-5">
            <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true))) ? request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true)) : ((isset($objDetalleFactura[0])) ? $objDetalleFactura[0]->$cantidad : '') ?>" type="text" name="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>" onKeyUp="fncTotal()" required>
          </div>
        
        
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <select  class="form-control" id="<?php detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::ID, true)?>" name="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::UNIDAD_MEDIDA_ID, true);?>" required>
      <option value="2" ><?php echo i18n::__('selectUnidadPeso') ?></option>
       <?php foreach($objUnidadMedida as $key):?>
       <option  <?php  echo (request::getInstance()->hasPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::UNIDAD_MEDIDA_ID, true)) === true and request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::UNIDAD_MEDIDA_ID, true)) == $key->$idUnidadMedida) ? 'selected' :  (isset($objDetalleFactura[0]->$idUnidadMedidaId) === true and $objDetalleFactura[0]->$idUnidadMedidaId == $key->$idUnidadMedida) ? 'selected' : '' ?>  value="<?php echo $key->$idUnidadMedida?>"><?php echo $key->$desUnidadMedida?></option>
        <?php endforeach;?>
   </select>
        </div>
            </div>
        
        <br>

        <?php if (session::getInstance()->hasError('inputValor')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputValor') ?>
          </div>
        <?php endif ?>

        <div class="form-group">
          <label for="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('valorPorUnidad') ?>: </label>
          <div class="col-sm-10">
            <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputValor') or request::getInstance()->hasPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true))) ? request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true)) : ((isset($objDetalleFactura[0])) ? $objDetalleFactura[0]->$valor_unidad : '') ?>" type="text" name="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_UNIDAD, true) ?>" placeholder="<?php echo i18n::__('valorPorUnidad') ?>" onKeyUp="fncTotal()" required>
          </div>
        </div>

        <?php if (session::getInstance()->hasError('inputTotal')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputTotal') ?>
          </div>
        <?php endif ?>

        <div class="form-group">
          <label for="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true) ?>" class="col-sm-2"> <?php echo i18n::__('total') ?>:  </label>
          <div class="col-sm-10">
            <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputTotal') or request::getInstance()->hasPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true))) ? request::getInstance()->getPost(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true)) : ((isset($objDetalleFactura[0])) ? $objDetalleFactura[0]->$valor_total : '') ?>" type="text" name="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::VALOR_TOTAL, true) ?>" placeholder="<?php echo i18n::__('total') ?>" required readonly>
          </div>
        </div>

        <?php $idFacturar = request::getInstance()->getGet('id') ?>
        <div class="form-group">
          <!--            <label class="col-sm-2" >Factura:</label>-->
          <div class="col-sm-10">
            <select class="form-control hidden" id="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::ID, TRUE) ?>" name="<?php echo detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::FACTURA_ID, TRUE) ?>">
              <?php foreach ($objFactura as $fact): ?>
                <option <?php echo ($idFacturar == $fact->$idFactura) ? 'selected' : '' ?> value="<?php echo $fact->$idFactura ?>"> <?php echo $fact->$idFactura ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>



        <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objDetalleFactura)) ? 'update' : 'register')) ?>">
        <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
      </form>
    </div>
  </div>
</div>