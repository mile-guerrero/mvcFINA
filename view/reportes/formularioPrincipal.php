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
<?php $nombre = reporteTableClass::NOMBRE ?>
<?php $idLote = registroLoteTableClass::ID ?>
<?php $ubi = registroLoteTableClass::UBICACION ?>
<?php $ubicacion = loteTableClass::UBICACION ?>
<?php $idUbi = loteTableClass::ID ?>

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
<!--<label class="col-sm-2 control-label" for="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('rango de fechas') ?></label>-->

        <div class="row j1" >
          <div class=""> 
          <label class="col-sm-2 control-label" for="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha inicio') ?></label>
           </div>
          <div class="col-lg-4">            
            <input type="date" class="form-control" id="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1' ?>" name="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1' ?>" required>
          </div>
          <div class="">
          <label class="col-sm-2 control-label" for="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha fin') ?></label>
           </div>
          <div class="col-lg-4 ">            
            <input type="date" class="form-control" id="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2' ?>" name="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT, true) . '_2' ?>" required>
          </div>
        </div>
        <br>
        
       
        
         <div class="form-group">
    <label for="filterLote" class="col-sm-2 control-label"><?php echo i18n::__('lote') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterLote" name="<?php echo registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION, true) ?>" required>
        <option value=""><?php echo i18n::__('selectLote') ?></option>
<?php foreach ($objLoteR as $key): ?>
            <option value="<?php echo $key->$ubicacion ?>"><?php echo $key->$ubicacion ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>


        <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objReportes)) ? 'update' : 'register')) ?>">

<?php if (session::getInstance()->hasCredential('admin')): ?>
          <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
<?php endif ?>
           <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </form>
    </div>
  </div>
</div>