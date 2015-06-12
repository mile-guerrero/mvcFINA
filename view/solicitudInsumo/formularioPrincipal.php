<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $id = solicitudInsumoTableClass::ID ?>
<?php $fecha = solicitudInsumoTableClass::FECHA_HORA ?>
<?php $idTrabajador = solicitudInsumoTableClass::TRABAJADOR_ID ?>
<?php $idTra = trabajadorTableClass::ID?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET?>
<?php $producto = solicitudInsumoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $lote = solicitudInsumoTableClass::LOTE_ID ?>
<?php $cantidad = solicitudInsumoTableClass::CANTIDAD ?>
<?php $idProducto = productoInsumoTableClass::ID ?>
<?php $descProducto = productoInsumoTableClass::DESCRIPCION ?>
<?php $idLote = loteTableClass::ID ?>
<?php $descLote = loteTableClass::UBICACION ?>


<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', ((isset($objS)) ? 'update' : 'create')) ?>">
  <?php if(isset($objS)== true): ?>
  <input  name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::ID, true) ?>" value="<?php echo $objS[0]->$id ?>" type="hidden">
  <?php endif ?>
  
  <div class="form-group">
      <label for="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true) ?>" class="col-sm-2"><?php echo i18n::__('fecha_M') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo ((isset($objS)== true) ? $objS[0]->$fecha : '') ?>" type="datetime-local" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true) ?>">
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
<?php foreach ($objL as $lot): ?>
            <option <?php echo (isset($objS[0]->$lote) === true and $objS[0]->$lote == $lot->$idLote) ? 'selected' : '' ?> value="<?php echo $lot->$idLote ?>"><?php echo $lot->$descLote ?></option>
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
         <label for="" class="col-sm-2"> <?php echo i18n::__('product') ?> </label>
         <div class="col-sm-10">
           <select class="form-control-gonza1" id="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true)?>" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectProducto') or request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true))) ? request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true)) : ((isset($objS[0])) ? '' : '') ?>"><?php echo i18n::__('selectProducto') ?></option>
<?php foreach ($objP as $produc): ?>
            <option <?php echo (isset($objS[0]->$producto) === true and $objS[0]->$producto == $produc->$idProducto) ? 'selected' : '' ?> value="<?php echo $produc->$idProducto ?>"><?php echo $produc->$descProducto ?></option>
<?php endforeach; ?>
          </select>
     
  
  
<!--      <label for="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true) ?>" class="col-sm-2"><?php echo i18n::__('cantidad') ?>:</label>     
     -->
        <input class="form-control-gonza2" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true))) ? request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true)) : ((isset($objS[0])) ? $objS[0]->$cantidad : '') ?>" type="text" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
      </div>
  </div>
  
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
<?php foreach ($objT as $trabajador): ?>
            <option <?php echo (isset($objS[0]->$idTrabajador) === true and $objS[0]->$idTrabajador == $trabajador->$idTra)  ? 'selected' : '' ?> value="<?php echo $trabajador->$idTra ?>"><?php echo $trabajador->$nomTrabajador ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>
 
  
  

  <br>
  <input  class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objS)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
    </article>
</div>