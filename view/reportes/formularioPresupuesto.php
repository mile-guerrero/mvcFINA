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

<?php $idReporte = reporteTableClass::ID ?>
<?php $lote = presupuestoHistoricoTableClass::LOTE_ID ?>
<?php $idLote = loteTableClass::ID ?>
<?php $nomLote = loteTableClass::UBICACION ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
    <div class="center-block" id="cuerpo2">

      <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('reportes', 'create') ?>" method="POST">
<?php if (isset($objReportes) == true): ?>
          <input  name="<?php echo reporteTableClass::getNameField(reporteTableClass::ID, true) ?>" value="<?php echo $objReportes[0]->$idReporte ?>" type="hidden">
        <?php endif ?>

        <br><br><br><br>

        <br>

<?php if (session::getInstance()->hasError('inputFecha')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFecha') ?>
          </div>
<?php endif ?>
<!--<label class="col-sm-2 control-label" for="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('rango de fechas') ?></label>-->

        <div class="row j1" >
          <div class=""> 
          <label class="col-sm-2 control-label" for="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha inicio') ?></label>
           </div>
          <div class="col-lg-4">            
            <input type="date" class="form-control" id="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1' ?>" name="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1' ?>" required>
          </div>
          <div class="">
          <label class="col-sm-2 control-label" for="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha fin') ?></label>
           </div>
          <div class="col-lg-4 ">            
            <input type="date" class="form-control" id="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2' ?>" name="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_2' ?>" required>
          </div>
        </div>
        <br>
        
        
        <div class="row j1" >
          <div class=""> 
          <label class="col-sm-2 control-label" for="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_3' ?>" ><?php echo i18n::__('fecha inicio') ?></label>
           </div>
          <div class="col-lg-4">            
            <input type="date" class="form-control" id="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_3' ?>" name="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_3' ?>" required>
          </div>
          <div class="">
          <label class="col-sm-2 control-label" for="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_4' ?>" ><?php echo i18n::__('fecha fin') ?></label>
           </div>
          <div class="col-lg-4 ">            
            <input type="date" class="form-control" id="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_4' ?>" name="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::CREATED_AT, true) . '_4' ?>" required>
          </div>
        </div>
        <br>
        
       
     

       <div class="form-group">
          <label class="col-sm-2" for="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true) ?>" >  <?php echo i18n::__('lote') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control"  name="<?php echo presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true); ?>" required>
              <option value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true))) ? request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true)) : ((isset($objpresupuestoHistorico[0])) ? '' : '') ?>"><?php echo i18n::__('selectLote') ?></option>
              <?php  foreach ($objLoteR as $key): ?>
         
              <option <?php echo (request::getInstance()->hasPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true)) === true and request::getInstance()->getPost(presupuestoHistoricoTableClass::getNameField(presupuestoHistoricoTableClass::LOTE_ID, true)) == $key->$idLote) ? 'selected' : (isset($objpresupuestoHistorico[0]->$lote) === true and $objpresupuestoHistorico[0]->$lote == $key->$idLote) ? 'selected' : ''  ?> value="<?php echo $key->$idLote  ?>"><?php echo $key->$nomLote  ?></option>
                <?php  endforeach; ?>
            </select>
          </div>
        </div>
        <br>


        <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objReportes)) ? 'update' : 'register')) ?>">

<?php if (session::getInstance()->hasCredential('admin')): ?>
          <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
<?php endif ?>
           <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </form>
    </div>
  </div>
</div>