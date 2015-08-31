<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\request\requestClass as request ?>

<?php $des = tipoProductoInsumoTableClass::DESCRIPCION ?>
<?php $id = tipoProductoInsumoTableClass::ID ?>
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
      <h1><?php echo i18n::__('tipo insumo') ?></h1>
          <ul>
      <?php if(session::getInstance()->hasCredential('admin')):?>
      <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'insertTipoProductoInsumo') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('registroTiProInsumo') ?></a>
      <a href="javascript:eliminarMasivo()" class="btn btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a>
     <?php endif?>
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a> 
      <a href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'deleteFiltersTipoProductoInsumo') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>            
     </ul> 
      
      
       <!-- filtro -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo') ?>" method="POST">
             
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
                    <label class="col-sm-2 control-label"  for="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha crear') ?></label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control-filtro1" id="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1' ?>" name="filter[<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1' ?>]" >

                      <input type="date" class="form-control-filtro2" id="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_2' ?>" name="filter[<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_2' ?>]" >
                    </div>
                  </div>

               <?php if (session::getInstance()->hasError('inputDescripcion')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescripcion') ?>
                    </div>
                  <?php endif ?>
                    
                  <div class="form-group">
                    <label for="filterDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('des') ?></label>
                    <div class="col-sm-10">
                      <input  type="text"    class="form-control" id="filterDescripcion"   name="filter[<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::DESCRIPCION, true) ?>]" placeholder="descripcion">
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
      
      
      
<!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'reportTipoProductoInsumo')?>">
           
          <?php if (session::getInstance()->hasError('inputFecha')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFecha') ?>
                    </div>
                  <?php endif ?>


                  <div class="form-group">
                    <label class="col-sm-2 control-label"  for="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha crear') ?></label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control-filtro1" id="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1' ?>" name="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_1' ?>" >

                      <input type="date" class="form-control-filtro2" id="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_2' ?>" name="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::CREATED_AT, true) . '_2' ?>" >
                    </div>
                  </div>
          
          <div class="form-group">
    <label for="reportDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportDescripcion" name="report[descripcion]" placeholder="Nombre">
    </div>
  </div>
           
  
</form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cerrar') ?></button>
        <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
      </div>
    </div>
  </div>
</div>

     
      
      
      <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'deleteSelectTipoProductoInsumo') ?>" method="POST">        
        <?php view::includeHandlerMessage()?>
          <br>
        <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
          <tr>
          <thead>
          <th id="cuadrito">
            <input type="checkbox" id="chkAll">
          </th>
          <th>
            <?php echo i18n::__('des') ?>
          </th>

          <th id="acciones">
<?php echo i18n::__('acciones') ?>
          </th>
          </tr>
          </thead>
          <tbody>
<?php foreach ($objTPI as $key): ?>
              <tr>

                <td>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </td>
                <td>
  <?php echo $key->$des ?>
                </td>

                <td>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'verTipoProductoInsumo', array(tipoProductoInsumoTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> 
                  <?php if(session::getInstance()->hasCredential('admin')):?>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'editTipoProductoInsumo', array(tipoProductoInsumoTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a> 
                  <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"><?php echo i18n::__('eliminar') ?></a>
                  <?php endif?>                
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
        <?php echo i18n::__('Desea  eliminar este campo') ?> <?php echo $key->$des ?><?php echo i18n::__('?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>,'<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID, true) ?>','<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'deleteTipoProductoInsumo') ?>')"><?php echo i18n::__('eliminar') ?></button>
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
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'deleteTipoProductoInsumo') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID, true) ?>">
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