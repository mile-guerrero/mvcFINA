<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $id = solicitudInsumoTableClass::ID ?>
<?php $fecha = solicitudInsumoTableClass::FECHA_HORA ?>

<?php $idTrabajador = solicitudInsumoTableClass::TRABAJADOR_ID ?>
<?php $idTra = trabajadorTableClass::ID ?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET ?>


<?php $lote = solicitudInsumoTableClass::LOTE_ID ?>
<?php $cantidad = solicitudInsumoTableClass::CANTIDAD ?>

<?php $idLote = loteTableClass::ID ?>
<?php $descLote = loteTableClass::UBICACION ?>


<?php $insumo = solicitudInsumoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idInsumo = tipoProductoInsumoTableClass::ID ?>
<?php $nomInsumo = tipoProductoInsumoTableClass::DESCRIPCION ?>

<?php $insumoInsumo = solicitudInsumoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idInsumoInsumo = productoInsumoTableClass::ID ?>
<?php $nomInsumoInsumo = productoInsumoTableClass::DESCRIPCION ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo3">
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', ((isset($objS)) ? 'update' : 'create')) ?>">
  <?php if(isset($objS)== true): ?>
  <input  name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::ID, true) ?>" value="<?php echo $objS[0]->$id ?>" type="hidden">
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
      <label for="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true) ?>" class="col-sm-2"><?php echo i18n::__('fecha') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('selectFechaIni') or request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true))) ? request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true)) : ((isset($objS) == true) ? date('Y-m-d\TH:i:s', strtotime($objS[0]->$fecha)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true) ?>"required readonly>
      </div>
  </div>
  
  <?php if(session::getInstance()->hasError('selectLote')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectLote') ?>
    </div>
    <?php endif ?>
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('lote') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true)?>" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectProducto') or request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true))) ? request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true)) : ((isset($objS[0])) ? '' : '') ?>"><?php echo i18n::__('selectLote') ?></option>
<?php foreach ($objL as $key): ?>
            <option <?php echo (request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true)) === true and request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::LOTE_ID, true)) == $key->$idLote) ? 'selected' : (isset($objS[0]->$lote) === true and $objS[0]->$lote == $key->$idLote) ? 'selected' : '' ?> value="<?php echo $key->$idLote ?>"><?php echo $key->$descLote ?></option>
<?php endforeach; ?>
          </select>
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
          <label class="col-sm-2"  for="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true) ?>">  <?php echo i18n::__('selectTPI') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control" id="slcTipoDeInsumo" required onchange="cargarInsumo('<?php echo routing::getInstance()->getUrlWeb('@getInsumo') ?>')">
              <option value="">Seleccione el tipo de insumo</option>
              <?php foreach ($objTipo as $key): ?>
              <option <?php echo (isset($idTipoProducto) and $idTipoProducto == $key->$idInsumo ) ? 'selected' : '' ?> value="<?php echo $key->$idInsumo ?>"><?php echo $key->$nomInsumo ?></option>
              <?php endforeach; ?>
             
            </select>
          </div>
        </div>
        
        
  
   <div class="row j1" >
        <label class="col-sm-2" for="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true) ?>" >  <?php echo i18n::__('des') ?>:   </label>
           <div class="col-lg-5">
          <select class="form-control" id="slcInsumo" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true); ?>" required>
              <option value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true))) ? request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true)) : ((isset($objS[0])) ? '' : '') ?>"><?php echo i18n::__('selectInsumo') ?></option>
              <?php  foreach ($objProducto as $key): ?>
         
              <option <?php echo (request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true)) === true and request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true)) == $key->$idInsumoInsumo) ? 'selected' : (isset($objS[0]->$insumoInsumo) === true and $objS[0]->$insumoInsumo == $key->$idInsumoInsumo) ? 'selected' : ''  ?> value="<?php echo $key->$idInsumoInsumo  ?>"><?php echo $key->$nomInsumoInsumo  ?></option>
                <?php  endforeach; ?>
            </select>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
             <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true))) ? request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true)) : ((isset($objS[0])) ? $objS[0]->$cantidad : '') ?>" type="text" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad por kilo') ?>">
     
        </div>
      </div>

      <br> 
  
  
  
  <?php if(session::getInstance()->hasError('selectTrabajador')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectTrabajador') ?>
    </div>
    <?php endif ?>
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true)?>" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectTrabajador') or request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true))) ? request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true)) : ((isset($objS[0])) ? '' : '') ?>"><?php echo i18n::__('selectTrabajador') ?></option>
<?php foreach ($objT as $key): ?>
<option <?php echo (request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true)) === true and request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true)) == $key->$idTra) ? 'selected' : (isset($objS[0]->$idTrabajador) === true and $objS[0]->$idTrabajador == $key->$idTra) ? 'selected' : '' ?> value="<?php echo $key->$idTra ?>"><?php echo $key->$nomTrabajador . ' ' . trabajadorTableClass::getNameApellido($key->$idTra). ' ' .  ' CC: ' . ' ' . trabajadorTableClass::getNameDocumento($key->$idTra)  ?></option>
              <?php endforeach; ?>
          </select>
      </div>
    </div>
 
  
  

  <br>
  <input  class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objS)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
      <br><br><br><br><br><br><br><br><br><br><br>
  
  </div>
</div>
</div>