<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = ordenServicioTableClass::ID ?>
<?php $fecha = ordenServicioTableClass::FECHA_MANTENIMIENTO ?>
<?php $cantidad = ordenServicioTableClass::CANTIDAD ?>
<?php $valor = ordenServicioTableClass::VALOR ?>
<?php $idTrabajador = ordenServicioTableClass::TRABAJADOR_ID ?>
<?php $idTra = trabajadorTableClass::ID ?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET ?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo4">
  <div class="center-block" id="cuerpo2">
  <header id="">

  </header>
  <nav id="">

  </nav>
  <section id="">

  </section>
  <article id='derecha'>

    <h1><?php echo i18n::__('orden') ?></h1> 
    <ul>      
      <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>             
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>
    </ul> 

    <!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'report')?>">

           <div class="form-group">
                <label for="reportTrabajador" class="col-sm-2 control-label"><?php echo i18n::__('trabajador') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterTrabajador" name="report[trabajador]">
                    <option value=""><?php echo i18n::__('selectTrabajador') ?></option>
<?php foreach ($objOST as $trabajador): ?>
                      <option value="<?php echo $trabajador->$idTra ?>"><?php echo $trabajador->$nomTrabajador ?></option>
<?php endforeach; ?>
                  </select>
                </div>
              </div>
  <div class="form-group">
    <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
    <div class="col-sm-10">
      <input type="date" class="form-control-filtro1" id="reportFecha1" name="report[fecha1]">
      
       <input type="date" class="form-control-filtro2" id="reportFecha2" name="report[fecha2]">
    </div>
  </div>
</form>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cerrar') ?></button>
        <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" method="POST">
              <div class="form-group">
                <label for="filterTrabajador" class="col-sm-2 control-label"><?php echo i18n::__('trabajador') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterTrabajador" name="filter[trabajador]">
                    <option value=""><?php echo i18n::__('selectTrabajador') ?></option>
<?php foreach ($objOST as $trabajador): ?>
                      <option value="<?php echo $trabajador->$idTra ?>"><?php echo $trabajador->$nomTrabajador ?></option>
<?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control-filtro1" id="filterFechaIni" name="filter[fechaIni]" >
                
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
              <?php echo i18n::__('trabajador') ?>
            </th>
            <th id="acciones">
          <?php echo i18n::__('acciones') ?>
            </th> 
          </tr>
        </thead>
        <tbody>
            <?php foreach ($objOS as $key): ?>
            <tr>
                <td>
                  <?php echo trabajadorTableClass::getNameTrabajador($key->$idTrabajador) ?>
                 </td>
              <td>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'ver', array(ordenServicioTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'edit', array(ordenServicioTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
              </td>
            </tr>
<?php endforeach; ?>
        </tbody>
      </table>
        </div>
    </form> 
    <div class="text-right">
      Pagina <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
          <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
<?php endfor; ?>
      </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
    </div>
  </article>
</div>
    <br><br><br><br><br><br><br><br>
  </div>
</div>

