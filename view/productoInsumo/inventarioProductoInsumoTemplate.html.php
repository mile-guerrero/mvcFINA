<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $idProducto = productoInsumoTableClass::ID ?>
<?php $idDetalle = detalleFacturaCompraTableClass::ID ?>
<?php $idInsumo = productoInsumoTableClass::ID ?>
<?php $desInsumo = productoInsumoTableClass::DESCRIPCION ?>
<?php $idTipo = tipoProductoInsumoTableClass::ID ?>
<?php $idControlPlaga = controlPlagaTableClass::ID ?>
<?php $idControlEnfermedad = controlEnfermedadTableClass::ID ?>

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
      <br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive ">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        <tr></tr>
         <th><?php echo i18n::__('insumo') ?></th> 
         <th><?php echo i18n::__('cantidad') ?></th> 
        </thead>
        </tr>
        <tbody>
       
          
<?php foreach ($objProducto as $key): ?>
            <tr>                  
              <td> <?php echo ($key->$desInsumo) ?></td>
              <?php $suma=((controlPlagaTableClass::getInventario($key->$idControlPlaga))+(controlEnfermedadTableClass::getInventario($key->$idControlEnfermedad))) ?>
              <td><?php echo ((productoInsumoTableClass::getInventario($key->$idProducto))-$suma) ?></td>
            </tr>
<?php endforeach; ?>
      
        </tbody>
      </table>
      </div>
    </article>

</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div> 
      