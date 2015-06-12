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
    <header id="">

    </header>
    <nav id="">
    </nav>
    <section id="contenido">
    </section>
    
         <div id="derecha">
             <h1><?php echo i18n::__('facturaCompra') ?></h1>
            <table class="table table-bordered table-responsive">
                
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
      <a href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'index') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
        
        <br>
        <br>
        <div>
            <table class="table table-bordered table-responsive">
                
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

                            

                 <th>
                   <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'edit', array(detalleFacturaCompraTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                 </th>
<?php endforeach; ?>
                
                    </tr>




                </tbody>
            </table>
            <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
        </div>
    </article>

</div>
