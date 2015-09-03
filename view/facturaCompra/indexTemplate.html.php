<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php $fecha = facturaCompraTableClass::FECHA ?>
<?php $id = facturaCompraTableClass::ID ?>
<?php $idProveedor = facturaCompraTableClass::PROVEEDOR_ID ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo4">
  <div class="center-block" id="cuerpo2">
  <header id="">
   
  </header>
  <nav id="barramenu">
    
  </nav>
  <section id="">
    
  </section>
    <article id='derecha'>

    <h1><?php echo i18n::__('facturaCompra') ?></h1> 
    <ul>      
      <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('registroFactuCompra') ?></a> 
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></button>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'deleteFilters') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>             
    </ul> 


    <!-- Modal -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index') ?>" method="POST">
                
                
               <?php if (session::getInstance()->hasFlash('modalFilters') === true): ?>        
                    <script>
                      $('#myModalFilters').modal({
                        backdrop: 'static', //dejar avierta la ventana modal
                        keyboard: false//true para quitarla con escape 
                      })
                    </script>
                  <?php endif; ?>
                    
                    
                     <div class="form-group">
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label"  for="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha inicio') ?></label>
                        <input type="date" class="form-control-filtro1" id="filterFechaIni" name="filter[fechaIni]" >
               
                    </div>
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label" for="<?php echo facturaCompraTableClass::getNameField(facturaCompraTableClass::CREATED_AT, true) . '_2' ?>" ><?php echo i18n::__('fecha fin') ?></label>
                            <input type="date" class="form-control-filtro2" id="filterFechaFin" name="filter[fechaFin]" >
               
                    </div>
                  </div>
        

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn btn-xs"><?php echo i18n::__('filtros') ?></button>
          </div>
        </div>
      </div>
    </div>             


    <form class="form-signin">        
<?php view::includeHandlerMessage() ?>  
        <br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <thead>
          <tr>
            <th>
              Fecha
            </th>
            <th>
          <?php echo i18n::__('proveedor') ?>
            </th>
            <th>
          <?php echo i18n::__('acciones') ?>
            </th> 
          </tr>
        </thead>
        <tbody>
            <?php foreach ($objFactura as $key): ?>
            <tr>
               <td>
                  <?php echo $key->$fecha ?>
                </td>
                <td>
                  <?php echo proveedorTableClass::getNameProveedor($key->$idProveedor) ?>
                  
                </td>
              <td>
                <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaCompra', 'index', array(facturaCompraTableClass::ID => $key->$id)) ?> "><?php echo i18n::__('detalle')?></a>
              </td>
            </tr>
           
<?php endforeach; ?>
        </tbody>
      </table>
        </div>
    </form> 
    <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('facturaCompra', 'index')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
  </article>
  
</div>
    <br><br><br><br><br><br><br><br>
</div>
</div>


