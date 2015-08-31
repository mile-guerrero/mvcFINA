<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php $idProducto = detalleFacturaVentaTableClass::DESCRIPCION?>
<?php $idCliente = facturaVentaTableClass::CLIENTE_ID?>
<?php $descripcion = detalleFacturaVentaTableClass::DESCRIPCION ?>
<?php $cantidad = detalleFacturaVentaTableClass::CANTIDAD ?>
<?php $valor_unidad = detalleFacturaVentaTableClass::VALOR_UNIDAD ?>
<?php $valor_total = detalleFacturaVentaTableClass::VALOR_TOTAL ?>
<?php $id = detalleFacturaVentaTableClass::ID ?>
<?php $idFactura = facturaVentaTableClass::ID ?>
<?php $fecha = facturaVentaTableClass::FECHA ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo6">
  <div class="center-block" id="cuerpo2">
  <header id="">

   
  </header>
  <nav id="">
  </nav>
  <section id="contenido">
  </section>
    
      <br>    
      
             <h1><?php echo i18n::__('factura') ?></h1>
            <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
                
                <thead>
                <tr>
                <th colspan="3"><?php echo i18n::__('datos') ?></th>
                </tr>
                </thead>
                <tbody>
<?php foreach ($objFactura as $factura): ?>
                        <tr> 
                            <th><?php echo i18n::__('documento') ?></th>  
                            <th><?php echo i18n::__('fechaNormal') ?></th>
                            <th><?php echo i18n::__('cliente') ?></th>
                        </tr>
                        <tr> 
                            <td><?php echo $factura->$idFactura ?></td>                 
                            <td><?php echo $factura->$fecha ?></td>
                            <td><?php echo clienteTableClass::getNameCliente($factura->$idCliente) ?></td>
                        </tr>
                    </tbody>
                </table>
  </div>

<?php endforeach; ?>
    
    <article id="derecha">
      <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'insert', array(facturaVentaTableClass::ID => $factura->$idFactura)) ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a>
<!--      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'ver', array(facturaVentaTableClass::ID => $factura->$idFactura)) ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
     -->
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>  
        
      <!-- Modal -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'ver', array(facturaVentaTableClass::ID => $factura->$idFactura)) ?>" method="POST">
                
                
               <?php echo i18n::__('verFacturaVenta') ?>


            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-xs btn-primary"><?php echo i18n::__('filtros') ?></button>
          </div>
        </div>
      </div>
    </div>
      
      <!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('factura') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="reportForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'report', array(facturaVentaTableClass::ID => $factura->$idFactura)) ?>" method="POST">
                
       <div class="modal-body">
           <label><?php echo i18n::__('verFacturaVenta') ?></label>
       </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
            <button type="button" onclick="$('#reportForm').submit()" class="btn btn-xs btn-warning"><?php echo i18n::__('verFactura') ?></button>
          </div>
        </div>
      </div>
    </div>
      
        <br>
        <br>
       <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
                
                <thead>
                <tr>
                <th colspan="6"><?php echo i18n::__('datos') ?></th>
                </tr>
                </thead>
                
                <tbody> 
                    <tr> 
                            <th><?php echo i18n::__('des') ?></th> 
                            <th><?php echo i18n::__('cantidad') ?></th> 
                            <th><?php echo i18n::__('valorPorUnidad') ?></th>
                            <th><?php echo i18n::__('subTotal') ?></th>
                            <th><?php echo i18n::__('acciones') ?></th>
                        </tr>
<?php foreach ($objDetalleFactura as $key): ?>
                        
                        <tr> 
                            
                          <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$idProducto) ?></td>

                            <td><?php echo $key->$cantidad ?></td>

                            <td><?php echo '$' . number_format($key->$valor_unidad, 0, ',', '.') ?></td>

                            <td><?php echo '$' . number_format($key->$valor_total, 0, ',', '.') ?></td>

                           

                 <td>
                   <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'edit', array(facturaVentaTableClass::ID => $key->$idFactura)) ?>"><?php echo i18n::__('modificar') ?></a>
                 </td>
<?php endforeach; ?>
                </tr>
                 <tr>
                   <td></td><td></td>  <td><?php echo i18n::__('total') ?></td> <td colspan="3"><?php $idFacturar = request::getInstance()->getGet(facturaventaTableClass::ID) ?><?php echo '$' . number_format (detalleFacturaVentaTableClass::getNameTotalPagar($idFacturar, 0, ',', '.'));  ?></td>
                    </tr>





                </tbody>
            </table>
          <?php $idFacturar = request::getInstance()->getGet(facturaventaTableClass::ID) ?>
         <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'index', array(facturaVentaTableClass::ID => $idFacturar))?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
        </div>
            <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
      
        
    </article>
</div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div> 