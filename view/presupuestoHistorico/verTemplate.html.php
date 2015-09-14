<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>


<?php $lote = presupuestoHistoricoTableClass::LOTE_ID ?>
<?php $presupuesto = presupuestoHistoricoTableClass::PRESUPUESTO ?>
<?php $insumo = presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $totalPago = presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR ?>
<?php $totalProduccion = presupuestoHistoricoTableClass::TOTAL_PRODUCCION ?>
<?php $id = presupuestoHistoricoTableClass::ID ?>


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
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
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
<?php foreach ($objPresupuestoHistorico as $key): ?>
            <tr>
              <td><?php echo i18n::__('ubicacion') ?></td>      
              <td><?php echo loteTableClass::getNameLote($key->$lote) ?></td>
            </tr>
            <tr>
          <td><?php echo i18n::__('insumo') ?></td>      
          <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$insumo) ?></td>
          </tr>
           <tr>
          <td><?php echo i18n::__('presupuesto') ?></td>      
          <td><?php echo ($key->$presupuesto) ?></td>
          </tr>
           <tr>
          <td><?php echo i18n::__('totalPago') ?></td>      
          <td><?php echo ($key->$totalPago) ?></td>
          </tr>
          <tr>
          <td><?php echo i18n::__('totalProduccion') ?></td>      
          <td><?php echo ($key->$totalProduccion)?></td>
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
