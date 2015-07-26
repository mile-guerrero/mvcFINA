<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $empresa= pedidoTableClass::EMPRESA_ID ?>
<?php $idEmpresa= empresaTableClass::ID ?>
<?php $nomEmpresa= empresaTableClass::NOMBRE ?>

<?php $proveedor= pedidoTableClass::ID_PROVEEDOR ?>
<?php $idProveedor= proveedorTableClass::ID ?>
<?php $nomProveedor= proveedorTableClass::NOMBREP ?>

<?php $idPedido= pedidoTableClass::ID ?>
<?php $cantidad= pedidoTableClass::CANTIDAD ?>

<?php $producto = pedidoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idProducto = productoInsumoTableClass::ID ?>
<?php $descProducto = productoInsumoTableClass::DESCRIPCION ?>



<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
    
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('pedido', ((isset($objPedido)) ? 'update' : 'create')) ?>">
    <?php if (isset($objPedido) == true): ?>
    <input  name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::ID, true) ?>" value="<?php echo $objPedido[0]->$idPedido ?>" type="hidden">
    <?php endif ?>
    
    <br><br><br><br>
    
    <?php if(session::getInstance()->hasError('selectEmpresa')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectEmpresa') ?>
    </div>
    <?php endif ?>
  
    <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('empresa') ?> </label>
         <div class="col-sm-10">
           
           <select class="form-control" id="<?php echo pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true)?>" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true) ?>">
             <option value="<?php echo (session::getInstance()->hasFlash('selectEmpresa') or request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true))) ? request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true)) : ((isset($objPedido[0])) ? '' : '') ?>"><?php echo i18n::__('selectEmpresa') ?></option>
<?php foreach ($objEmpresa as $key): ?>
<option <?php echo (request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true)) === true and request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true)) == $key->$idEmpresa) ? 'selected' : (isset($objPedido[0]->$empresa) === true and $objPedido[0]->$empresa == $key->$idEmpresa) ? 'selected' : '' ?> value="<?php echo $key->$idEmpresa ?>"><?php echo $key->$nomEmpresa ?></option>
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
  
        
    
<div class="row j1" >
 <label for="" class="col-sm-2"> <?php echo i18n::__('product') ?> </label>
           <div class="col-lg-5">
         <select class="form-control" id="<?php echo pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true)?>" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectProducto') or request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true))) ? request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true)) : ((isset($objPedido[0])) ? '' : '') ?>"><?php echo i18n::__('selectProducto') ?></option>
<?php foreach ($objProducto as $key): ?>
<option <?php echo (request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true)) === true and request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true)) == $key->$idProducto) ? 'selected' : (isset($objPedido[0]->$producto) === true and $objPedido[0]->$producto == $key->$idProducto) ? 'selected' : '' ?> value="<?php echo $key->$idProducto ?>"><?php echo $key->$descProducto ?></option>
              <?php endforeach; ?>
          </select> </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true))) ? request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true)) : ((isset($objPedido[0])) ? $objPedido[0]->$cantidad : '') ?>" type="text" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
     
        </div>
      </div>
<br>
   
    

      
      <?php if(session::getInstance()->hasError('selectProveedor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectProveedor') ?>
    </div>
    <?php endif ?>
      
      <div class="form-group">
      <label for="" class="col-sm-2">  <?php echo i18n::__('pro') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true)?>" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true);?>">
        <option value="<?php echo (session::getInstance()->hasFlash('selectProveedor') or request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true))) ? request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true)) : ((isset($objPedido[0])) ? '' : '') ?>"><?php echo i18n::__('selectProveedor') ?></option>
       <?php foreach($objProveedor as $key):?>
      <option <?php echo (request::getInstance()->hasPost(pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true)) === true and request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true)) == $key->$idProveedor) ? 'selected' : (isset($objPedido[0]->$proveedor) === true and $objPedido[0]->$proveedor == $key->$idProveedor) ? 'selected' : '' ?> value="<?php echo $key->$idProveedor ?>"><?php echo $key->$nomProveedor ?></option>
 <?php endforeach;?>
   </select> 
      </div> 
    </div>

    <input   class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objPedido)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

<br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>