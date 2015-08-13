<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php $tipo = productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID ?>
<?php $tipos = tipoProductoInsumoTableClass::ID ?>
<?php $des_tipos = tipoProductoInsumoTableClass::DESCRIPCION ?>
<?php// $unidad = productoInsumoTableClass::UNIDAD_MEDIDA_ID ?>
<?php// $unidades = unidadMedidaTableClass::ID ?>
<?php// $des_unidades = unidadMedidaTableClass::DESCRIPCION ?>
<?php $idPI = productoInsumoTableClass::ID ?>
<?php $descripcion = productoInsumoTableClass::DESCRIPCION ?>
<?php// $cantidad = productoInsumoTableClass::CANTIDAD ?>
<?php $nombre = productoInsumoTableClass::NOMBRE_IMAGEN ?>



<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
   <article id='derecha'>
     
<form enctype="multipart/form-data" class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', ((isset($objPI)) ? 'updateProductoInsumo' : 'createProductoInsumo')) ?>">
  <?php if(isset($objPI)==true): ?>
  <input  name="<?php echo productoInsumoTableClass::getNameField(productoInsumoTableClass::ID,true) ?>" value="<?php echo $objPI[0]->$idPI ?>" type="hidden">
  <?php endif ?>
   <br><br><br><br><br>
  
  <?php if(session::getInstance()->hasError('inputDescripcion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescripcion') ?>
    </div>
    <?php endif ?>
  
  
  
   <div class="form-group">
      <label for="<?php echo productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true) ?>" class="col-sm-2">   <?php echo i18n::__('des') ?>: </label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true))) ? request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true)) : ((isset($objPI[0])) ? $objPI[0]->$descripcion : '') ?>" type="text" name="<?php echo productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
  </div>
</div>
   
   
   <?php if(session::getInstance()->hasError('inputImagen')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputImagen') ?>
    </div>
    <?php endif ?>
   
   <div class="form-group">
      <label for="" class="col-sm-2"> <?php echo i18n::__('subir archivos') ?>:</label>     
      <div class="col-sm-10">
               <input class="form-control"  value="<?php echo (session::getInstance()->hasFlash('inputImagen') or request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::NOMBRE_IMAGEN, true))) ? request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::NOMBRE_IMAGEN, true)) : ((isset($objPI[0])) ? $objPI[0]->$nombre : '') ?>"  type="file" name="<?php echo productoInsumoTableClass::getNameField(productoInsumoTableClass::NOMBRE_IMAGEN, true) ?>" required>
     </div>
  </div>
   
   
  
  
   <?php if(session::getInstance()->hasError('selectTipo')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectTipo') ?>
    </div>
    <?php endif ?>
  
  
 <div class="form-group">
      <label for="<?php echo productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true) ?>" class="col-sm-2">   <?php echo i18n::__('tipo') ?>:  </label>
      <div class="col-sm-10"> 
        <select class="form-control" id="<?php productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true)?>" name="<?php echo productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true);?>">
       <option value="<?php echo (session::getInstance()->hasFlash('selectTipo') or request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true))) ? request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true)) : ((isset($objPI[0])) ? '' : '') ?>" ><?php echo i18n::__('selectTPI') ?></option>
       <?php foreach($objPITPI as $TP):?>
       <option <?php echo (request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true)) === true and request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true)) == $TP->$tipos) ? 'selected' : (isset($objPI[0]->$tipo) === true and $objPI[0]->$tipo == $TP->$tipos) ? 'selected' : '' ?> value="<?php echo $TP->$tipos?>"><?php echo $TP->$des_tipos?></option>
       <?php endforeach;?>
   </select>    
      </div> 
    </div>
 
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objPI)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexProductoInsumo') ?>" ><?php echo i18n::__('atras') ?> </a>
<br><br><br><br><br><br>
</form>
   </article>
</div>
</div>
</div>