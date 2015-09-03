<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>

<?php $ubi = loteTableClass::UBICACION ?>
<?php $id = loteTableClass::ID ?> 

<?php $ciudadIds = loteTableClass::ID_CIUDAD ?>
<?php $idCiudaddes = ciudadTableClass::ID ?>
<?php $descripcionciudad = ciudadTableClass::NOMBRE_CIUDAD ?>

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
        <h1><?php echo i18n::__('lote') ?></h1> 
        <ul>
          <?php if (session::getInstance()->hasCredential('admin')): ?>  
            <a class="btn  btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'insertLote') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('registroLote') ?></a> 
            <a href="javascript:eliminarMasivo()" class="btn  btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a> 
          <?php endif ?>
          <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
          <a href="<?php echo routing::getInstance()->getUrlWeb('lote', 'deleteFiltersLote') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a> 
          <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>           
        </ul> 




        <!-- Modal filtro---------------------------------------------------------------------->
        <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>" method="POST">
                  <?php if (session::getInstance()->hasFlash('modalFilters') === true): ?>        
                    <script>
                      $('#myModalFiltres').modal({
                        backdrop: 'static', //dejar avierta la ventana modal
                        keyboard: false//true para quitarla con escape 
                      })
                    </script>
                  <?php endif; ?>


                  <?php if (session::getInstance()->hasError('inputFecha')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFecha') ?>
                    </div>
                  <?php endif ?>

                  <div class="form-group">
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label" for="<?php echo loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha inicio') ?></label>
                      <input type="date" class="form-control-filtro1" id="<?php echo loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1' ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1' ?>">
                    </div>
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label" for="<?php echo loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2' ?>" ><?php echo i18n::__('fecha fin') ?></label>
                      <input type="date" class="form-control-filtro2" id="<?php echo loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2' ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2' ?>">
                    </div>
                  </div>

                  <?php if (session::getInstance()->hasError('inputUbicacion')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputUbicacion') ?>
                    </div>              
                  <?php endif ?>



                  <div class="form-group">
                    <label for="filterUbicacion" class="col-sm-2 control-label"><?php echo i18n::__('ubicacion') ?></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="filterUbicacion" name="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" placeholder="buscar por ubicacion">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="filterCiudad" class="col-sm-2 control-label hidden"><?php echo i18n::__('filtroCiudad') ?></label>
                    <div class="col-sm-10">
                      <select class="form-control hidden" id="filterCiudad" name="filter[ciudad]">
                        <option value=""><?php echo i18n::__('FCiudad') ?></option>
                        <?php foreach ($objLC as $ciudad): ?>
                          <option value="<?php echo $ciudad->$idCiudaddes ?>"><?php echo $ciudad->$descripcionciudad ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>        

                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn-xs"><?php echo i18n::__('filtrar') ?></button>
              </div>
            </div>
          </div>
        </div>
        <!--    fin del filtro-->

        <!---Informes--->
        <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('lote', 'reportLote') ?>">


                  <div class="form-group">
                    <label for="reportCiudad" class="col-sm-2 control-label"><?php echo i18n::__('filtroCiudad') ?></label>
                    <div class="col-sm-10">
                      <select class="form-control" id="reportCiudad" name="report[ciudad]">
                        <option value=""><?php echo i18n::__('FCiudad') ?></option>
                        <?php foreach ($objLC as $ciudad): ?>
                          <option value="<?php echo $ciudad->$idCiudaddes ?>"><?php echo $ciudad->$descripcionciudad ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>




                  <div class="form-group">
                    <label for="reportFechaIni" class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control-filtro1" id="reportFechaIni" name="report[fechaIni]" >


<!--                <label for="filterFechaFin" class="col-sm-2 control-label"><?php echo i18n::__('fecha fin') ?></label>-->

                      <input type="date" class="form-control-filtro2" id="reportFechaFin" name="report[fechaFin]" >
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="reportUbicacion" class="col-sm-2 control-label"><?php echo i18n::__('ubicacion') ?></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="reportUbicacion" name="report[ubicacion]" placeholder="buscar por ubicacion">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="reportTamanoIni" class="col-sm-2 control-label"><?php echo i18n::__('tamano') ?></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control-filtro1" id="reportTamanoIni" name="filter[tamanoIni]" placeholder="buscar por tamaño">


<!--                <label for="filterTamanoFin" class="col-sm-2 control-label"><?php echo i18n::__('tamano') ?></label>-->

                      <input type="text" class="form-control-filtro2" id="reportTamanoFin" name="report[tamanoFin]" placeholder="buscar por tamaño">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="reportFechaIniSiembra" class="col-sm-2 control-label"><?php echo i18n::__('fechaFsiembra') ?></label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control-filtro1" id="reportFechaIniSiembra" name="report[fechaSI]" >


<!--                <label for="filterFechaFinSiembra" class="col-sm-2 control-label"><?php echo i18n::__('fecha fin') ?></label>-->

                      <input type="date" class="form-control-filtro2" id="reportFechaFinSiembra" name="report[fechaSF]" >
                    </div>
                  </div>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cerrar') ?></button>
                  <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
                </div>            
              </div>
            </div>
          </div>
        </div>
        <!--    fin informe-->

        <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('lote', 'deleteSelectLote') ?>" method="POST">        
          <?php view::includeHandlerMessage() ?>
          <br>
          <div class="rwd">
            <table class="table table-bordered table-responsive rwd_auto">
              <tr>
              <thead>
              <th id="cuadrito">
                <input type="checkbox" id="chkAll">
              </th>
              <th>
                <?php echo i18n::__('ubicacion') ?>
              </th>             
              <th id="acciones">
                <?php echo i18n::__('acciones') ?>
              </th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($objLote as $key): ?>
                  <tr>

                    <td>
                      <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                    </td>
                    <td>
                      <?php echo $key->$ubi ?>
                    </td>     
                    <td>               
                      <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'verLote', array(loteTableClass::ID => $key->$id)) ?>" > <?php echo i18n::__('ver') ?></a> 
                      <?php if (session::getInstance()->hasCredential('admin')): ?>
                        <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'editLote', array(loteTableClass::ID => $key->$id)) ?>"> <?php echo i18n::__('modificar') ?> </a>
                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>"  class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
                        <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'editLoteMas', array(loteTableClass::ID => $key->$id)) ?>"> <?php echo i18n::__('mas') ?> </a>

                      <?php endif ?>
                    </td>                                                       
                  </tr>

                <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmar eliminar') ?></h4>
                      </div>
                      <div class="modal-body">
                        <?php echo i18n::__('Desea  eliminar este campo') ?> <?php echo $key->$ubi ?><?php echo i18n::__('?') ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('lote', 'deleteLote') ?>')"><?php echo i18n::__('eliminar') ?></button>
                      </div>
                    </div>
                  </div>
                </div>                                         
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </form> 

        <div class="text-right">
          <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>')">
          <?php for ($x = 1; $x <= $cntPages; $x++): ?>
              <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
            <?php endfor; ?>
          </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
        </div>
        <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('lote', 'deleteLote') ?>" method="POST">
          <input type="hidden" id="idDelete" name="<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>">
        </form>

      </article>
    </div>
    <br><br><br><br><br><br><br><br>
  </div>
</div>
<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('eliminar en masa') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('eliminar en masa') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>