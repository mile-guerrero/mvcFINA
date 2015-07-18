<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\request\requestClass as request ?>
<?php $idFacturaCompra = detalleFacturaCompraTableClass::FACTURA_COMPRA_ID?>
<?php $idProveedor = detalleFacturaCompraTableClass::PROVEEDOR_ID?>
<?php $descripcion = detalleFacturaCompraTableClass::DESCRIPCION ?>
<?php $cantidad = detalleFacturaCompraTableClass::CANTIDAD ?>
<?php $valor_unidad = detalleFacturaCompraTableClass::VALOR_UNIDAD ?>
<?php $valor_total = detalleFacturaCompraTableClass::VALOR_TOTAL ?>
<?php $id = detalleFacturaCompraTableClass::ID ?>
<?php $factura = facturaCompraTableClass::ID ?>
<?php $proveedor = proveedorTableClass::ID ?>
<?php $nomProveedor = proveedorTableClass::NOMBREP ?>
 
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo2">
  <header id="">

  </header>
  <nav id="">

  </nav>
  <section id="">

  </section>
  <article id='derecha'>

    <h1><?php echo i18n::__('detallePago') ?></h1> 
    <ul>      
        <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'insert', array(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_COMPRA_ID, true) => request::getInstance()->getGet(detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::FACTURA_COMPRA_ID, true)))) ?>"><?php echo i18n::__('nuevo') ?></a> 
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?>
      <a href="<?php echo routing::getInstance()->getUrlWeb('cooperativa', 'index') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>             
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
                  <?php echo proveedorTableClass::getNameProveedor($key->$idProveedor) ?>
                 </td>
                 <th>
                     <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'ver', array(detalleFacturaCompraTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                   <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'edit', array(detalleFacturaCompraTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                 </th>
            </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </form> 
    <div class="text-right">
      <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
          <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
<?php endfor; ?>
      </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
    </div>
  </article>
    </div>
</div>



