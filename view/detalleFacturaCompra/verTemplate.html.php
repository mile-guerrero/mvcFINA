<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idProveedor = detalleFacturaCompraTableClass::PROVEEDOR_ID ?>
<?php $descripcion = detalleFacturaCompraTableClass::DESCRIPCION ?>
<?php $cantidad = detalleFacturaCompraTableClass::CANTIDAD ?>
<?php $valor_unidad = detalleFacturaCompraTableClass::VALOR_UNIDAD ?>
<?php $valor_total = detalleFacturaCompraTableClass::VALOR_TOTAL ?>
<?php $id = detalleFacturaCompraTableClass::ID ?>
<?php $idFactura = facturaCompraTableClass::ID ?>
<?php $fecha = facturaCompraTableClass::FECHA ?>
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
      <br>    
             <h1><?php echo i18n::__('facturaCompra') ?></h1>
             <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">   
                <thead>
                <tr>
                <th colspan="2"><?php echo i18n::__('datos') ?></th>
                </tr>
                </thead>
                <tbody>
<?php foreach ($objFactura as $factura): ?>
                        <tr> 
                            <th>id</th>  
                            <th><?php echo i18n::__('fecha') ?></th>
                        </tr>
                        <tr> 
                            <td><?php echo $factura->$idFactura ?></td>                 
                            <td><?php echo $factura->$fecha ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

<?php endforeach; ?>
    
    <article id="derecha">
      <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'insert', array(facturaCompraTableClass::ID => $factura->$idFactura)) ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a>
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'ver', array(facturaCompraTableClass::ID => $factura->$idFactura)) ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
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
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'ver', array(facturaCompraTableClass::ID => $factura->$idFactura)) ?>" method="POST">
                
                
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="filterFechaIni" name="filter[fechaIni]" >
                </div>
              </div>

              <div class="form-group">
                <label  class="col-sm-2 control-label"><?php echo i18n::__('fecha fin') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="filterFechaFin" name="filter[fechaFin]" >
                </div>
              </div>

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
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="reportForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'report', array(facturaCompraTableClass::ID => $factura->$idFactura)) ?>" method="POST">
                
                
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="reportFechaIni" name="report[fechaIni]" >
                </div>
              </div>

              <div class="form-group">
                <label  class="col-sm-2 control-label"><?php echo i18n::__('fecha fin') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="reportFechaFin" name="report[fechaFin]" >
                </div>
              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
            <button type="button" onclick="$('#reportForm').submit()" class="btn btn-xs btn-warning"><?php echo i18n::__('informe') ?></button>
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
                            <th><?php echo i18n::__('nomProveedor') ?></th>
                            <th><?php echo i18n::__('des') ?></th> 
                            <th><?php echo i18n::__('cantidad') ?></th> 
                            <th><?php echo i18n::__('valorPorUnidad') ?></th>
                            <th><?php echo i18n::__('total') ?></th>
                            <th><?php echo i18n::__('acciones') ?></th>
                        </tr>
<?php foreach ($objDetalleFactura as $key): ?>
                        
                        <tr> 
                            <td><?php echo proveedorTableClass::getNameProveedor($key->$idProveedor) ?></td>
                            
                            <td><?php echo $key->$descripcion ?></td>

                            <td><?php echo $key->$cantidad ?></td>

                            <td><?php echo $key->$valor_unidad ?></td>

                            <td><?php echo $key->$valor_total ?></td>

                            

                 <td>
                   <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'edit', array(detalleFacturaCompraTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                 </td>
<?php endforeach; ?>
                
                    </tr>




                </tbody>
            </table>
       </div>
            <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
       
    </article>
</div>

    <br><br><br><br><br><br>
</div>
  
 </div> 
