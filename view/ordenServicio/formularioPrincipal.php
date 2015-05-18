<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
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
   <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', ((isset($objOS)) ? 'update' : 'create')) ?>">
  <?php if(isset($objOS)== true): ?>
  <input  name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::ID, true) ?>" value="<?php echo $objOS[0]->$idOS ?>" type="hidden">
  <?php endif ?>
  <?php view::includeHandlerMessage()?>
  <br>
  <div class="form-group">
      <label for="<?php echo ordenServiciotableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true) ?>" class="col-sm-2"> <?php echo i18n::__('fecha_M') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo ((isset($objOS)== true) ? $objOS[0]->$fecha : '') ?>" type="datetime-local" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true) ?>">
      </div>
  </div>
  
  <div class="form-group">
      <label for="<?php echo ordenServiciotableClass::getNameField(ordenServicioTableClass::CANTIDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('cantidad') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo ((isset($objOS)== true) ? $objOS[0]->$cantidad : '') ?>" type="text" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
      </div>
  </div>
  
  
  <div class="form-group">
      <label for="<?php echo ordenServiciotableClass::getNameField(ordenServicioTableClass::VALOR, true) ?>" class="col-sm-2"> <?php echo i18n::__('valor') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo ((isset($objOS)== true) ? $objOS[0]->$valor : '') ?>" type="text" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::VALOR, true) ?>" placeholder="<?php echo i18n::__('valor') ?>">
      </div>
  </div>
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true)?>" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true) ?>">
            <option><?php echo i18n::__('selectTrabajador') ?></option>
<?php foreach ($objOST as $trabajador): ?>
            <option <?php echo (isset($objOS[0]->$idTrabajador) === true and $objOS[0]->$idTrabajador == $trabajador->$idTra) ? 'selected' : '' ?> value="<?php echo $trabajador->$idTra ?>"><?php echo $trabajador->$nomTrabajador ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div> 
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('product') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID, true)?>" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID, true) ?>">
            <option><?php echo i18n::__('selectProducto') ?></option>
<?php foreach ($objOSPI as $produc): ?>
            <option <?php echo (isset($objOS[0]->$producto) === true and $objOS[0]->$producto == $produc->$idProducto) ? 'selected' : '' ?> value="<?php echo $produc->$idProducto ?>"><?php echo $produc->$descProducto ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('maquina') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true)?>" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true) ?>">
            <option><?php echo i18n::__('selectMaquina') ?></option>
<?php foreach ($objOSM as $maq): ?>
            <option <?php echo (isset($objOS[0]->$maquina) === true and $objOS[0]->$maquina == $maq->$idMaquina) ? 'selected' : '' ?> value="<?php echo $maq->$idMaquina ?>"><?php echo $maq->$descMaquina ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>

  
  <input  class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objOS)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
   </article>
</div>