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
  <header id="">
   
  </header>
  <nav id="">
  </nav>
  <section id="contenido">
  </section>
    <article id='derecha'>
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
       <br>
       <br>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objPedido as $key): ?>
            <tr> 
              <th><?php echo i18n::__('cantidad') ?></th>                   
              <td><?php echo $key->$cantidad ?></td>
            </tr>

<?php endforeach; ?>
            
<?php foreach ($objPedido as $empresa): ?>
          <tr>
          <th>Empresa</th>      
          <td><?php echo empresaTableClass::getNameEmpresa($empresa->$idEmpresa) ?></td>
          </tr>
          
<?php endforeach; ?>
          
          <?php foreach ($objPedido as $producto): ?>
          <tr>
          <th><?php echo i18n::__('product') ?></th>      
          <td><?php echo productoInsumoTableClass::getNameProductoInsumo($producto->$idProducto) ?></td>
          </tr>
          
<?php endforeach; ?>
          
          <?php foreach ($objPedido as $proveedor): ?>
          <tr>
          <th>Proveedor</th>      
          <td><?php echo proveedorTableClass::getNameProveedor($proveedor->$idProveedor) ?></td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </article>
  
</div>

