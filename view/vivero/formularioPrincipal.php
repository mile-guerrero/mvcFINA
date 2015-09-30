<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $id = viveroTableClass::ID ?>
<?php $fechaInicial = viveroTableClass::FECHA_INICIAL ?>
<?php $fechaFinal = viveroTableClass::FECHA_FINAL ?>


<?php $cantidad = viveroTableClass::CANTIDAD ?>

<?php $insumo = viveroTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idInsumo = productoInsumoTableClass::ID ?>
<?php $nomInsumo = productoInsumoTableClass::DESCRIPCION ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo3">
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('vivero', ((isset($objVivero)) ? 'update' : 'create')) ?>">
  <?php if(isset($objVivero)== true): ?>
  <input  name="<?php echo viveroTableClass::getNameField(viveroTableClass::ID, true) ?>" value="<?php echo $objVivero[0]->$id ?>" type="hidden">
  <?php endif ?>
  
<br><br><br><br><br>  
  <?php  date_default_timezone_set('America/Bogota'); ?> 
<?php if (session::getInstance()->hasError('selectFechaInicial')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectFechaInicial') ?>
          </div>
        <?php endif ?>
<div class="form-group">
  <div class="row j1" >
      <label for="<?php echo viveroTableClass::getNameField(viveroTableClass::FECHA_INICIAL, true) ?>" class="col-sm-2"><?php echo i18n::__('fecha') ?>:</label>     

          <div class="col-lg-5">
            <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('selectFechaInicial') or request::getInstance()->hasPost(viveroTableClass::getNameField(viveroTableClass::FECHA_INICIAL, true))) ? request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::FECHA_INICIAL, true)) : ((isset($objVivero) == true) ? date('Y-m-d\TH:i:s', strtotime($objVivero[0]->$fechaInicial)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo viveroTableClass::getNameField(viveroTableClass::FECHA_INICIAL, true) ?>" required>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('fechaFinal') or request::getInstance()->hasPost(viveroTableClass::getNameField(viveroTableClass::FECHA_FINAL, true))) ? request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::FECHA_FINAL, true)) : ((isset($objVivero) == true) ? date('Y-m-d\TH:i:s', strtotime($objVivero[0]->$fechaFinal)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo viveroTableClass::getNameField(viveroTableClass::FECHA_FINAL, true) ?>" required>

          </div>
        </div>
  </div>
  <?php if(session::getInstance()->hasError('selectProducto')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectProducto') ?>
    </div>
    <?php endif ?>
  
   <?php if(session::getInstance()->hasError('inputCantidad')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?>
    </div>
    <?php endif ?>
      
        
  <div class="form-group">
   <div class="row j1" >
        <label class="col-sm-2" for="<?php echo viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true) ?>" >  <?php echo i18n::__('product') ?>:   </label>
           <div class="col-lg-5">
          <select class="form-control" id="slcInsumo" name="<?php echo viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true); ?>" required>
              <option value="<?php echo (session::getInstance()->hasFlash('selectProducto') or request::getInstance()->hasPost(viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true))) ? request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true)) : ((isset($objVivero[0])) ? '' : '') ?>"><?php echo i18n::__('selectProducto') ?></option>
              <?php  foreach ($objProducto as $key): ?>
         <option <?php echo (request::getInstance()->hasPost(viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true)) === true and request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true)) == $key->$idInsumo) ? 'selected' : (isset($objVivero[0]->$insumo) === true and $objVivero[0]->$insumo == $key->$idInsumo) ? 'selected' : ''  ?> value="<?php echo $key->$idInsumo  ?>"><?php echo $key->$nomInsumo  ?></option>
                <?php  endforeach; ?>
            </select>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
             <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(viveroTableClass::getNameField(viveroTableClass::CANTIDAD, true))) ? request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::CANTIDAD, true)) : ((isset($objVivero[0])) ? $objVivero[0]->$cantidad : '') ?>" type="text" name="<?php echo viveroTableClass::getNameField(viveroTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
     
        </div>
      </div>
</div>
      <br> 
    <br>
  <input  class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objVivero)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('vivero', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  
  </div>
</div>
</div>