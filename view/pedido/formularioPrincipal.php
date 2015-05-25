<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $idEmp= pedidoTableClass::EMPRESA_ID ?>
<?php $idPro= pedidoTableClass::ID_PROVEEDOR ?>
<?php $cantidad= pedidoTableClass::CANTIDAD ?>
<?php $producto = pedidoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idProducto = productoInsumoTableClass::ID ?>
<?php $descProducto = productoInsumoTableClass::DESCRIPCION ?>
<?php $idEmpresa= empresaTableClass::ID ?>
<?php $nomEmpresa= empresaTableClass::NOMBRE ?>
<?php $idProveedor= proveedorTableClass::ID ?>
<?php $nomProveedor= proveedorTableClass::NOMBREP ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('pedido', ((isset($objPedido)) ? 'update' : 'create')) ?>">
    <?php if (isset($objPedido) == true): ?>
    <input  name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::ID, true) ?>" value="<?php echo $objPedido[0]->$idPedido ?>" type="hidden">
    <?php endif ?>

    <?php if(session::getInstance()->hasError('inputCantidad')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?>
    </div>
    <?php endif ?>
  <br>
    <div class="form-group">
      <label for="<?php echo pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('cantidad') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true))) ? request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true)) : ((isset($objPedido[0])) ? $objPedido[0]->$cantidad : '') ?>" type="text" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
      </div>
  </div>
    
    <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('empresa') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true)?>" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true) ?>">
            <option><?php echo i18n::__('selectEmpresa') ?></option>
<?php foreach ($objEmpresa as $empresa): ?>
            <option <?php echo (isset($objPedido[0]->$idEmp) === true and $objPedido[0]->$idEmp == $empresa->$idEmpresa) ? 'selected' : '' ?> value="<?php echo $empresa->$idEmpresa ?>"><?php echo $empresa->$nomEmpresa ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>   
    
    <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('product') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true)?>" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true) ?>">
            <option><?php echo i18n::__('selectProducto') ?></option>
<?php foreach ($objProducto as $produc): ?>
            <option <?php echo (isset($objPedido[0]->$producto) === true and $objPedido[0]->$producto == $produc->$idProducto) ? 'selected' : '' ?> value="<?php echo $produc->$idProducto ?>"><?php echo $produc->$descProducto ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>
      
      <div class="form-group">
      <label for="" class="col-sm-2">  <?php echo i18n::__('pro') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true)?>" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true);?>">
       <option><?php echo i18n::__('selectProveedor') ?></option>
       <?php foreach($objProveedor as $proveedor):?>
       <option <?php echo (isset($objPedido[0]->$idPro) === true and $objPedido[0]->$idPro == $proveedor->$idProveedor) ? 'selected' : '' ?> value="<?php echo $proveedor->$idProveedor?>"><?php echo $proveedor->$nomProveedor?></option>
       <?php endforeach;?>
   </select> 
      </div> 
    </div>

    <input   class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objPedido)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form>
  </article>
</div>  