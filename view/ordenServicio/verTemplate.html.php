<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = ordenServicioTableClass::ID ?>
<?php $fecha_mantenimiento = ordenServicioTableClass::FECHA_MANTENIMIENTO ?>
<?php $cantidad = ordenServicioTableClass::CANTIDAD ?>
<?php $valor = ordenServicioTableClass::VALOR ?>
<?php $created_at = ordenServicioTableClass::CREATED_AT ?>
<?php $updated_at = ordenServicioTableClass::UPDATED_AT ?>
<?php $idTrabajador = ordenServicioTableClass::TRABAJADOR_ID ?>
<?php $idProducto = ordenServicioTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idMaquina = ordenServicioTableClass::MAQUINA_ID ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo6">
  <div class="center-block" id="cuerpo2">
  <header id="">
  </header>

  <nav id="">
  </nav>
  <section id="contenido">

  </section>

  <article id='derecha'>  
    <br><br>
        <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
        <br><br>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objOS as $key): ?>
            <tr>
              <th>Fecha Mantenimiento</th>      
              <td><?php echo $key->$fecha_mantenimiento ?></td>
            </tr>
            <tr>
              <th>cantidad</th>      
              <td><?php echo $key->$cantidad ?></td>
            </tr>
            <tr>
              <th> valor</th>      
              <td><?php echo $key->$valor ?></td>
            </tr>
            
<?php endforeach; ?>
             <?php foreach ($objOS as $trabajador): ?>
          <tr>
          <th>Trabajador</th>      
          <td><?php echo trabajadorTableClass::getNameTrabajador($trabajador->$idTrabajador) ?></td>
          </tr>
<?php endforeach; ?>
            
             <?php foreach ($objOS as $producto): ?>
            <tr>
              <th>Insumo</th>      
              <td><?php echo productoInsumoTableClass::getNameProductoInsumo($producto->$idProducto) ?></td>
            </tr>
            
<?php endforeach; ?>
            
   
             <?php foreach ($objOS as $maquina): ?>
            <tr>
              <th>Maquina</th>      
              <td><?php echo maquinaTableClass::getNameMaquina($maquina->$idMaquina) ?></td>
            </tr>
            
<?php endforeach; ?>
            
        </tbody>
      </table>

    </article>
</div>
    <br><br>
</div>
  
 </div>
