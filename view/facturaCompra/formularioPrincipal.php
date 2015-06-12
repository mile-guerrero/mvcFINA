<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $fecha = facturaCompraTableClass::FECHA ?>
<?php $created_at = facturaCompraTableClass::CREATED_AT ?>

<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', ((isset($objFactura)) ? 'update' : 'create')) ?>">
    <?php if (isset($objFactura) == true): ?>
    <input  name="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::ID, true) ?>" value="<?php echo $objFactura[0]->$idFactura ?>" type="hidden">
    <?php endif ?>
    
     <div class="form-group">
       <label for="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::FECHA, true) ?>" class="col-sm-2"><?php echo i18n::__('fecha') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo ((isset($objFactura)== true) ? $objFactura[0]->$fecha : '') ?>" type="datetime-local" name="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::FECHA, true) ?>">
      </div>
  </div>

          

    <input   class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objFactura)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form>
  </article>
</div>  