<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>

 

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo3">
  
    
  <form name="sumar" class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', ((isset($objDetalleFactura)) ? 'update' : 'create')) ?>">


       <br><br><br><br><br>
      

 <div class="form-group">
          <label class="col-sm-2"  for="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION, true) ?>">  <?php echo i18n::__('selectTPI') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control" id="slcTipoDeInsumo" required onchange="cargarInsumo('<?php echo routing::getInstance()->getUrlWeb('@getInsumo') ?>')">
              <option value="">Seleccione el tipo de insumo</option>
             
              <option value="2">Venenos</option>
              <option value="3">Fertilizantes</option>
              
             
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2" for="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION, true) ?>" >  <?php echo i18n::__('des') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control" id="slcInsumo" name="<?php echo detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION, true); ?>" required>
              <option value=""><?php echo i18n::__('selectInsumo') ?></option>
            </select>
          </div>
        </div>
        <br>
  
    <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objDetalleFactura)) ? 'update' : 'register')) ?>">
    <br><br><br><br><br><br><br><br><br><br> <br><br><br><br> 
    </form>
  </div>
</div>
</div>