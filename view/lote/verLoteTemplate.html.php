<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = loteTableClass::ID ?>
<?php $ubicacion = loteTableClass::UBICACION ?>
<?php $descripcion = loteTableClass::DESCRIPCION ?>
<?php $tamano = loteTableClass::TAMANO ?>
<?php $fechaS = loteTableClass::FECHA_INICIO_SIEMBRA ?>
<?php $numeroP = loteTableClass::NUMERO_PLANTULAS ?>
<?php $presu = loteTableClass::PRESUPUESTO ?>
<?php $nombre_ciudad = loteTableClass::ID_CIUDAD ?>
<?php $nombreInsumo = loteTableClass::PRODUCTO_INSUMO_ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">

   
  </header>
  <nav id="">
  </nav>
  <section id="contenido">
  </section>
    <article id='derecha'>
       
      <a class="btn btn-success btn-xs yo" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>" > <?php echo i18n::__('atras') ?></a>
      <br><br>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <td colspan="2"><?php echo i18n::__('datos') ?></td>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objLote as $key): ?>
            <tr>
              <th><?php echo i18n::__('ubicacion') ?></th>      
              <td><?php echo $key->$ubicacion ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('ciudad') ?></th>      
              <td><?php echo ciudadTableClass::getNameCiudad($key->$nombre_ciudad) ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('tamano') ?></th>      
              <td><?php echo $key->$tamano ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('des') ?></th>      
              <td><?php echo $key->$descripcion ?></td>
            </tr>
            
            <tr>
              <th><?php echo i18n::__('fecha siembra') ?></th>      
              <td><?php echo $key->$fechaS ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('insumo') ?></th>      
              <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$nombreInsumo) ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('numero') ?></th>      
              <td><?php echo $key->$numeroP ?></td>
            </tr>
            <tr>
              <th><?php echo i18n::__('presupuesto') ?></th>      
              <td><?php echo $key->$presu ?></td>
            </tr>
            
         
<?php endforeach; ?>
      
        </tbody>
      </table>
    </article>

</div>
