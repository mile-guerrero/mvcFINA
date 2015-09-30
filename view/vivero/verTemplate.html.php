<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = viveroTableClass::ID ?>
<?php $fechaInicial = viveroTableClass::FECHA_INICIAL ?>
<?php $fechaFinal = viveroTableClass::FECHA_FINAL ?>
<?php $cantidad = viveroTableClass::CANTIDAD ?>
<?php $idProducto = viveroTableClass::PRODUCTO_INSUMO_ID ?>

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
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('vivero', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
      <br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objVivero as $key): ?>
            <tr>
              <td><?php echo i18n::__('fecha inicio') ?></td>      
              <td><?php echo $key->$fechaInicial ?></td>
            </tr>
            <tr>
            <tr>
              <td><?php echo i18n::__('fecha fin') ?></td>      
              <td><?php echo $key->$fechaFinal ?></td>
            </tr>
            <tr>
          <td><?php echo i18n::__('product') ?></td>      
          <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$idProducto) ?></td>
          </tr>
            <tr>
              <td><?php echo i18n::__('cantidad') ?></td> 
              <td><?php echo $key->$cantidad ?></td>
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
