<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
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
        <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
        <br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objOS as $key): ?>
            <tr>
              <td>Fecha Mantenimiento</td>      
              <td><?php echo $key->$fecha_mantenimiento ?></td>
            </tr>
            <tr>
          <td><?php echo i18n::__('trabajador') ?></td>      
          <td><?php echo trabajadorTableClass::getNameTrabajador($key->$idTrabajador) ?></td>
          </tr>
            
            <tr>
              <td><?php echo i18n::__('insumo') ?></td>      
              <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$idProducto) ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('maquina') ?></td>      
              <td><?php echo maquinaTableClass::getNameMaquina($key->$idMaquina) ?></td>
            </tr>
            <tr>
              <td><?php echo i18n::__('cantidad') ?></td>      
              <td><?php echo $key->$cantidad ?></td>
            </tr>
            <tr>
              <td> <?php echo i18n::__('valor') ?></td>      
              <td><?php echo '$' . number_format($key->$valor, 0, ',', '.') ?></td>
            </tr>
            
<?php endforeach; ?>
                        
        </tbody>
      </table>
</div>
    </article>
</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div>
