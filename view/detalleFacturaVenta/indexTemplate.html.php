<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\request\requestClass as request ?>
<?php $idFactura = detalleFacturaVentaTableClass::FACTURA_ID?>
<?php $idCliente = detalleFacturaVentaTableClass::CLIENTE_ID?>
<?php $descripcion = detalleFacturaVentaTableClass::DESCRIPCION ?>
<?php $cantidad = detalleFacturaVentaTableClass::CANTIDAD ?>
<?php $valor_unidad = detalleFacturaVentaTableClass::VALOR_UNIDAD ?>
<?php $valor_total = detalleFacturaVentaTableClass::VALOR_TOTAL ?>
<?php $id = detalleFacturaVentaTableClass::ID ?>
<?php $factura = facturaVentaTableClass::ID ?>
<?php $cliente = clienteTableClass::ID ?>
<?php $nomCliente = clienteTableClass::NOMBRE ?>
 
<div class="container container-fluid" id="cuerpo">
  <header id="">

  </header>
  <nav id="">

  </nav>
  <section id="">

  </section>
  <article id='derecha'>

    <h1><?php echo i18n::__('detallePago') ?></h1> 
    <ul>      
        <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'insert', array(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::FACTURA_ID, true) => request::getInstance()->getGet(detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::FACTURA_ID, true)))) ?>"><?php echo i18n::__('nuevo') ?></a> 
      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFiltres"><?php echo i18n::__('filtros') ?></button>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'index') ?>" class="btn btn-default btn-xs" ><?php echo i18n::__('eFiltros') ?></a>
     <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'index')?>" ><?php echo i18n::__('atras') ?></a>
    </ul> 


    <!-- Modal -->
           


    <form class="form-signin">        
<?php view::includeHandlerMessage() ?>        
      <table class="table table-bordered table-responsive">
        <thead>
          <tr>
            <th>
              Descripcion
            </th>
            <th>
              Cantidad
            </th>
            <th>
              Valor x unidad
            </th>
            <th>
              Valor total
            </th>
            <th>
              Cliente
            </th>
            <th>
              <?php echo i18n::__('acciones')?>
            </th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($objDetalleFactura as $key): ?>
            <tr>
               <td>
                  <?php echo $key->$descripcion ?>
                </td>
                <td>
                  <?php echo $key->$cantidad ?>
                </td>
                <td>
                  <?php echo $key->$valor_unidad ?>
                </td>
                <td>
                  <?php echo $key->$valor_total ?>
                </td>
                <td>
                  <?php echo clienteTableClass::getNameCliente($key->$idCliente) ?>
                 </td>
                 <th>
                     <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'ver', array(detalleFacturaVentaTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                   <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'edit', array(detalleFacturaVentaTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                 </th>
            </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </form> 
    <div class="text-right">
      <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
          <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
<?php endfor; ?>
      </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
    </div>
  </article>
</div>



