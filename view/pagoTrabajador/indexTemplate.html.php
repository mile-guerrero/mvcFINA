<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $idEmpresa = pagoTrabajadorTableClass::EMPRESA_ID ?>
<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $idEmp = empresaTableClass::ID ?>
<?php $nomEmpresa = empresaTableClass::NOMBRE ?>
<?php $id = pagoTrabajadorTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">

  </header>
  <nav id="">

  </nav>
  <section id="">

  </section>
  <article id='derecha'>

    <h1><?php echo i18n::__('pagoTrabajador') ?></h1> 
    <ul>      
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'insert') ?>"><?php echo i18n::__('nuevo') ?></a> 
      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFiltres"><?php echo i18n::__('filtros') ?></button>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" class="btn btn-default btn-xs" ><?php echo i18n::__('eFiltros') ?></a>             
    </ul> 


    <!-- Modal -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filters') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" method="POST">
              <div class="form-group">
                <label for="filterEmpresa" class="col-sm-2 control-label"><?php echo i18n::__('empresa') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterEmpresa" name="filter[empresa]">
                    <option><?php echo i18n::__('selectEmpresa') ?></option>
<?php foreach ($objEmpresa as $empresa): ?>
                      <option value="<?php echo $empresa->$idEmp ?>"><?php echo $empresa->$nomEmpresa ?></option>
<?php endforeach; ?>
                  </select>
                </div>
              </div>

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
      <table class="table table-bordered table-responsive">
        <thead>
          <tr>
            <th>
              Fecha Pago
            </th>
            <th>
              <?php echo i18n::__('empresa') ?>
            </th>
            <th>
          <?php echo i18n::__('acciones') ?>
            </th> 
          </tr>
        </thead>
        <tbody>
            <?php foreach ($objPT as $key): ?>
            <tr>
               <td>
                  <?php echo $key->$fechaIni ?>
                </td>
                <td>
                  <?php echo empresaTableClass::getNameEmpresa($key->$idEmpresa) ?>
                 </td>
              <th>
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'ver', array(pagoTrabajadorTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'edit', array(pagoTrabajadorTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detallePagoTrabajador', 'index', array(detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true) => $key->$id)) ?> "><?php echo i18n::__('detalle')?></a>
              </th>
            </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </form> 
    <div class="text-right">
      Pagina <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
          <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
<?php endfor; ?>
      </select> <?php echo i18n::__('of') ?> <?php echo $cntPages ?>
    </div>
  </article>
</div>



