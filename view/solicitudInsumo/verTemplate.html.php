<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = solicitudInsumoTableClass::ID ?>
<?php $fecha = solicitudInsumoTableClass::FECHA_HORA ?>
<?php $cantidad = solicitudInsumoTableClass::CANTIDAD ?>
<?php $idProducto = solicitudInsumoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idLote = solicitudInsumoTableClass::LOTE_ID ?>
<?php $idTrabajador = solicitudInsumoTableClass::TRABAJADOR_ID ?>
<?php $idUnidadMedida = solicitudInsumoTableClass::UNIDAD_MEDIDA_ID ?>

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
                <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
                <br><br>
                <div class="rwd">
                    <table class="table table-bordered table-responsive rwd_auto">
                        <tr>
                        <thead>
                        <th colspan="2"><?php echo i18n::__('datos') ?></th>
                        </thead>
                        </tr>
                        <tbody>
<?php foreach ($objS as $key): ?>
                                <tr>
                                    <td>Fecha Hora</td>      
                                    <td><?php echo $key->$fecha ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo i18n::__('lote') ?></td>      
                                    <td><?php echo loteTableClass::getNameLote($key->$idLote) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo i18n::__('trabajador') ?></td>      
                                    <td><?php echo trabajadorTableClass::getNameTrabajador($key->$idTrabajador) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo i18n::__('product') ?></td>      
                                    <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$idProducto) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo i18n::__('cantidad') ?></td> 
                                    <td><?php echo $key->$cantidad . ' ' . unidadMedidaTableClass::getNameUnidadMedida($key->$idUnidadMedida) ?></td>
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
