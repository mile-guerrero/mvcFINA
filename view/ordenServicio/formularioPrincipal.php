<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $idOS = ordenServicioTableClass::ID ?>
<?php $fecha = ordenServicioTableClass::FECHA_MANTENIMIENTO ?>
<?php $cantidad = ordenServicioTableClass::CANTIDAD ?>
<?php $valor = ordenServicioTableClass::VALOR ?>
<?php $idTra = trabajadorTableClass::ID?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET?>
<?php $idProducto = productoInsumoTableClass::ID ?>
<?php $descProducto = productoInsumoTableClass::DESCRIPCION ?>
<?php $idMaquina = maquinaTableClass::ID ?>
<?php $descMaquina = maquinaTableClass::NOMBRE ?>
<?php $idTrabajador = ordenServicioTableClass::TRABAJADOR_ID ?>
<?php $producto = ordenServicioTableClass::PRODUCTO_INSUMO_ID ?>
<?php $maquina = ordenServicioTableClass::MAQUINA_ID ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
   
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', ((isset($objOS)) ? 'update' : 'create')) ?>">
  <?php if(isset($objOS)== true): ?>
  <input  name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::ID, true) ?>" value="<?php echo $objOS[0]->$idOS ?>" type="hidden">
  <?php endif ?>
  
   <br><br><br><br>
    
  
   <?php  date_default_timezone_set('America/Bogota'); ?>  
        <?php if (session::getInstance()->hasError('selectFechaIni')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectFechaIni') ?>
          </div>
        <?php endif ?>
  <div class="form-group">
      <label for="<?php echo ordenServiciotableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true) ?>" class="col-sm-2"> <?php echo i18n::__('fecha') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('selectFechaIni') or request::getInstance()->hasPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true))) ? request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true)) : ((isset($objOS) == true) ? date('Y-m-d\TH:i:s', strtotime($objOS[0]->$fecha)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true) ?>"required>
      </div>
  </div>
  
  <?php if(session::getInstance()->hasError('selectMaquina')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectMaquina') ?>
    </div>
    <?php endif ?>
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('maquina') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true)?>" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectMaquina') or request::getInstance()->hasPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::MAQUINA_ID, true))) ? request::getInstance()->getPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::MAQUINA_ID, true)) : ((isset($objOS[0])) ? '' : '') ?>"><?php echo i18n::__('selectMaquina') ?></option>
<?php foreach ($objOSM as $key): ?>
            <option <?php echo (request::getInstance()->hasPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true)) === true and request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true)) == $key->$idMaquina) ? 'selected' : (isset($objOS[0]->$maquina) === true and $objOS[0]->$maquina == $key->$idMaquina) ? 'selected' : '' ?> value="<?php echo $key->$idMaquina ?>"><?php echo $key->$descMaquina ?></option>
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
        <select class="form-control" id="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID, true)?>" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectProducto') or request::getInstance()->hasPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::PRODUCTO_INSUMO_ID, true))) ? request::getInstance()->getPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::PRODUCTO_INSUMO_ID, true)) : ((isset($objOS[0])) ? '' : '') ?>"><?php echo i18n::__('selectProducto') ?></option>
<?php foreach ($objOSPI as $key): ?>
            <option <?php echo (request::getInstance()->hasPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID, true)) === true and request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID, true)) == $key->$idProducto) ? 'selected' : (isset($objOS[0]->$producto) === true and $objOS[0]->$producto == $key->$idProducto) ? 'selected' : '' ?> value="<?php echo $key->$idProducto ?>"><?php echo $key->$descProducto ?></option>
<?php endforeach; ?>
          </select>
          </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::CANTIDAD, true))) ? request::getInstance()->getPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::CANTIDAD, true)) : ((isset($objOS[0])) ? $objOS[0]->$cantidad : '') ?>" type="text" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad por kilo') ?>">
     
        </div>
      </div>
<br>
  
  
  
  <?php if(session::getInstance()->hasError('selectTrabajador')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectTrabajador') ?>
    </div>
    <?php endif ?>
  
  <?php if(session::getInstance()->hasError('inputValor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputValor') ?>
    </div>
    <?php endif ?>
   
  
   <div class="row j1" >
 <label for="" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
          <div class="col-lg-5">
        <select class="form-control" id="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true)?>" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectTrabajador') or request::getInstance()->hasPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::TRABAJADOR_ID, true))) ? request::getInstance()->getPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::TRABAJADOR_ID, true)) : ((isset($objOS[0])) ? '' : '') ?>"><?php echo i18n::__('selectTrabajador') ?></option>
<?php foreach ($objOST as $key): ?>
            <option <?php echo (request::getInstance()->hasPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true)) === true and request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true)) == $key->$idTra) ? 'selected' : (isset($objOS[0]->$idTrabajador) === true and $objOS[0]->$idTrabajador == $key->$idTra) ? 'selected' : '' ?> value="<?php echo $key->$idTra ?>"><?php echo $key->$nomTrabajador . ' ' . trabajadorTableClass::getNameApellido($key->$idTra). ' ' .  ' CC: ' . ' ' . trabajadorTableClass::getNameDocumento($key->$idTra)  ?></option>
<?php endforeach; ?>
          </select> 
          </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
         <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputValor') or request::getInstance()->hasPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::VALOR, true))) ? request::getInstance()->getPost(ordenServiciotableClass::getNameField(ordenServiciotableClass::VALOR, true)) : ((isset($objOS[0])) ? $objOS[0]->$valor : '') ?>" type="text" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::VALOR, true) ?>" placeholder="<?php echo i18n::__('valor a pagar por trabajo realizado') ?>">
      
        </div>
      </div>
<br>
   
  
  <input  class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objOS)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

 <br><br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>