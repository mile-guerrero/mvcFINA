<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idEmpresa = pedidoTableClass::EMPRESA_ID ?>
<?php $idProveedor = pedidoTableClass::ID_PROVEEDOR ?>
<?php $idProducto = pedidoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $cantidad = pedidoTableClass::CANTIDAD ?>
<?php $created_at = pedidoTableClass::CREATED_AT ?>
<?php $updated_at = pedidoTableClass::UPDATED_AT ?>
<?php $id = pedidoTableClass::ID ?>
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
       <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
       <br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objPedido as $key): ?>
          
          <tr>
         <td><?php echo i18n::__('empresa') ?></td>      
          <td><?php echo empresaTableClass::getNameEmpresa($key->$idEmpresa) ?></td>
          </tr>
          <tr>
          <td><?php echo i18n::__('product') ?></td>      
          <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$idProducto) ?></td>
          </tr>
            <tr> 
              <td><?php echo i18n::__('cantidad') ?></td>                   
              <td><?php echo $key->$cantidad ?></td>
            </tr>
            <tr>
          <td><?php echo i18n::__('proveedor') ?></td>   
          <td><?php echo proveedorTableClass::getNameProveedor($key->$idProveedor) ?></td>
          </tr>

<?php endforeach; ?>

        </tbody>
      </table>
        </div>
    </article>
  </div>
    <br><br><br><br>
</div>
  
 </div>


