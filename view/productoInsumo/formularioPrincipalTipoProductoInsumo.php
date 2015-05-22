<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php $idTPI = tipoProductoInsumoTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', ((isset($objTPI)) ? 'updateTipoProductoInsumo' : 'createTipoProductoInsumo')) ?>">
  <?php if(isset($objTPI)==true): ?>
  <input  name="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID,true) ?>" value="<?php echo $objTPI[0]->$idTPI?>" type="hidden">
  <?php endif ?>
    
  
  <?php if(session::getInstance()->hasError('inputDescripcion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescripcion') ?>
    </div>
    <?php endif ?>
  
  
 <div class="form-group">
      <label for="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>: </label>     
      <div class="col-sm-10">   
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true))) ? request::getInstance()->getPost(tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true)) : ((isset($objTPI[0])) ? $objTPI[0]->$descripcion : '') ?>" type="text" name="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
      </div>
 </div>
  
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objTPI)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
  </article>
</div>