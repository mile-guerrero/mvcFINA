<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>


<?php $lote = controlPlagaTableClass::LOTE_ID ?>
<?php $plaga = controlPlagaTableClass::PLAGA_ID ?>
<?php $insumo = controlPlagaTableClass::PRODUCTO_INSUMO_ID ?>
<?php $cantidad = controlPlagaTableClass::CANTIDAD ?>
<?php $unidadMedida = controlPlagaTableClass::UNIDAD_MEDIDA_ID ?>
<?php $id = controlPlagaTableClass::ID ?>


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
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('controlPlaga', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
      <br>
      <br>
      
      <div class="rwd">
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objControlPlaga as $key): ?>
            <tr>
              <td><?php echo i18n::__('ubicacion') ?></td>      
              <td><?php echo loteTableClass::getNameLote($key->$lote) ?></td>
            </tr>
            <tr>
          <td><?php echo i18n::__('insumo') ?></td>      
          <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$insumo) ?></td>
          </tr>
           <tr>
          <td><?php echo i18n::__('cantidad') ?></td>      
          <td><?php echo ($key->$cantidad). ' ' . unidadMedidaTableClass::getNameUnidadMedida($key->$unidadMedida) ?></td>
          </tr>
           <tr>
          <td><?php echo i18n::__('plaga') ?></td>      
          <td><?php echo plagaTableClass::getNamePlaga($key->$plaga) ?></td>
          </tr>
          <tr>
          <td><?php echo i18n::__('des') ?></td>      
          <td><?php echo plagaTableClass::getNameDes($key->$plaga)?></td>
          </tr>
          <tr>
          <td><?php echo i18n::__('tratamiento') ?></td>      
          <td><?php echo plagaTableClass::getNameTratamiento($key->$plaga)?></td>
          </tr>
          

        <?php endforeach; ?>

        </tbody>
      </table>
      </div>
    </article>
 
</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div>
