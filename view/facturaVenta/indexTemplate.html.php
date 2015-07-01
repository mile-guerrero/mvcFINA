<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<?php $fecha = facturaVentaTableClass::FECHA ?>
<?php $id = facturaVentaTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">

  </header>
  <nav id="">

  </nav>
  <section id="">

  </section>
  <article id='derecha'>

    <h1><?php echo i18n::__('factura') ?></h1> 
    <ul>      
      <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></button>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>             
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
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>" method="POST">
                
                
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
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filtros') ?></button>
          </div>
        </div>
      </div>
    </div>             


    <form class="form-signin">        
<?php view::includeHandlerMessage() ?>  
        <br>
      <table class="table table-bordered table-responsive">
        <thead>
          <tr>
            <th>
              Fecha
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
              <th>
                <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleFacturaVenta', 'ver', array(facturaVentaTableClass::ID => $key->$id)) ?> "><?php echo i18n::__('detalle')?></a>
              </th>
            </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </form> 
    <div class="text-right">
      <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
          <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
<?php endfor; ?>
      </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
    </div>
  </article>
</div>



