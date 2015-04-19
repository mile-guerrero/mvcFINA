<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = solicitudInsumoTableClass::ID ?>
<?php $fecha = solicitudInsumoTableClass::FECHA_HORA ?>
<?php $cantidad = solicitudInsumoTableClass::CANTIDAD ?>
<?php $idProducto = solicitudInsumoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idLote = solicitudInsumoTableClass::LOTE_ID ?>
<?php $idTrabajador = solicitudInsumoTableClass::TRABAJADOR_ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="encabezado">

  </header>
  <nav id="barramenu">
  </nav>
  <section id="">
    <article id='derecha'>
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objS as $key): ?>
            <tr>
              <th>Fecha Hora</th>      
              <td><?php echo $key->$fecha ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('cantidad') ?></th> 
              <td><?php echo $key->$cantidad ?></td>
            </tr>
<?php endforeach; ?>
          
          <?php foreach ($objS as $trabajador): ?>
          <tr>
          <th><?php echo i18n::__('trabajador') ?></th>      
          <td><?php echo trabajadorTableClass::getNameTrabajador($trabajador->$idTrabajador) ?></td>
          </tr>
          
<?php endforeach; ?>
          
          <?php foreach ($objS as $producto): ?>
          <tr>
          <th><?php echo i18n::__('product') ?></th>      
          <td><?php echo productoInsumoTableClass::getNameProductoInsumo($producto->$idProducto) ?></td>
          </tr>
          
<?php endforeach; ?>
          
          <?php foreach ($objS as $lote): ?>
          <tr>
          <th><?php echo i18n::__('lote') ?></th>      
          <td><?php echo loteTableClass::getNameLote($lote->$idLote) ?></td>
          </tr>
          
<?php endforeach; ?>
        </tbody>
      </table>

    </article>
  </section>
</div>
