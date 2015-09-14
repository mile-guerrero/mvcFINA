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

<?php $lote = presupuestoHistoricoTableClass::LOTE_ID ?>
<?php $insumo = presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID ?>
<?php $id = presupuestoHistoricoTableClass::ID ?>



<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo4">
    <div class="center-block" id="cuerpo2">
      
      <h1><?php echo i18n::__('presupuestoHistorico') ?></h1>
      <ul>
        <?php if (session::getInstance()->hasCredential('admin')): ?>
          <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('registroPresupuesto') ?></a> 
          <a href="javascript:eliminarMasivo()" class="btn  btn btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a> 
        <?php endif ?>
        <a type="button" class="btn  btn btn-xs" data-toggle="modal" data-target="#myModalFilters"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'deleteFilters') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
        <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>          
      </ul>


     <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'deleteSelect') ?>" method="POST">        
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
              <?php echo i18n::__('lote') ?>
            </th>

            <th>
              <?php echo i18n::__('insumo') ?>
            </th>
            <th id="acciones">
              <?php echo i18n::__('acciones') ?>
            </th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($objPresupuestoHistorico as $key): ?>
                <tr>
                  <td>
                    <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                  </td>
                  <td>
                    <?php echo loteTableClass::getNameLote($key->$lote) ?> 
                  </td>

                  <td>
                    <?php echo productoInsumoTableClass::getNameProductoInsumo($key->$insumo) ?>
                  </td>
                  <td>
                    <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'ver', array(presupuestoHistoricoTableClass::ID => $key->$id)) ?>" > <?php echo i18n::__('ver') ?></a>
                    <?php if (session::getInstance()->hasCredential('admin')): ?>
                      <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'edit', array(presupuestoHistoricoTableClass::ID => $key->$id)) ?>"> <?php echo i18n::__('modificar') ?> </a>
                      <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
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
                      <?php echo i18n::__('Desea  eliminar este campo') ?><?php echo $key->$lote ?><?php echo i18n::__('?') ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                      <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'delete') ?>')"><?php echo i18n::__('eliminar') ?></button>
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
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'index') ?>')">
        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
            <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor; ?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('presupuestoHistorico', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::ID, true) ?>">
      </form>

      <!--    </article>-->

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