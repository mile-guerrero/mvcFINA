<?php //

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\request\requestClass as request ?>

<?php $empresa = pagoTrabajadorTableClass::EMPRESA_ID ?>
<?php $idEmpresa = empresaTableClass::ID ?>
<?php $nomEmpresa = empresaTableClass::NOMBRE ?>
<?php $idTra = trabajadorTableClass::ID ?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET ?>
<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $idTrabajador = pagoTrabajadorTableClass::TRABAJADOR_ID ?>
<?php $valor = pagoTrabajadorTableClass::VALOR_SALARIO ?>
<?php $horas = pagoTrabajadorTableClass::HORAS_PERDIDAS ?>
<?php $total = pagoTrabajadorTableClass::TOTAL_PAGAR ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
    <div class="center-block" id="cuerpo3">
<script>
function fncTotal(){
caja=document.forms["sumar"].elements;
var <?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?> = Number(caja["<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?>"].value);
var <?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?> = Number(caja["<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>"].value);

<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true) ?> = (<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?>)+(<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>);
if(!isNaN(<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>)){
caja["<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>"].value=(<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?>)+(<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>) ;
}
}
</script>
      <form  name="sumar" class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', ((isset($objPagoT)) ? 'update' : 'create')) ?>">
        <?php if (isset($objPagoT) == true): ?>
          <input  name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::ID, true) ?>" value="<?php echo $objPagoT[0]->$idPagoT ?>" type="hidden">
        <?php endif ?>
        <br><br><br><br><br>
<!--Primer numero: <input type="text" name="numero1" size="2" onKeyUp="fncTotal()"/>-->



        <?php if (session::getInstance()->hasError('selectEmpresa')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectEmpresa') ?>
          </div>
        <?php endif ?>


        <div class="form-group">
          <label for="" class="col-sm-2"> <?php echo i18n::__('empresa') ?> </label>
          <div class="col-sm-10">
            <select class="form-control" id="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true) ?>" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true) ?>"  required>
              <option value="<?php echo (session::getInstance()->hasFlash('selectEmpresa') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true)) : ((isset($objPagoT[0])) ? '' : '') ?>"  ><?php echo i18n::__('selectEmpresa') ?></option>
              <?php foreach ($objEmpresa as $key): ?>
                <option  <?php echo (request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true)) === true and request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true)) == $key->$idEmpresa) ? 'selected' : (isset($objPagoT[0]->$empresa) === true and $objPagoT[0]->$empresa == $key->$idEmpresa) ? 'selected' : '' ?>  value="<?php echo $key->$idEmpresa ?>"><?php echo $key->$nomEmpresa ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

           <?php  date_default_timezone_set('America/Bogota'); ?>  
        <?php if (session::getInstance()->hasError('selectFechaIni')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectFechaIni') ?>
          </div>
        <?php endif ?>

        <?php if (session::getInstance()->hasError('selectFechaFin')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectFechaFin') ?>
          </div>
        <?php endif ?>

        <div class="row j1" >
          <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true) ?>" class="col-sm-2"><?php echo i18n::__('fechaPagoIni') ?>:</label>     

          <div class="col-lg-5">
            <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('selectFechaIni') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true)) : ((isset($objPagoT) == true) ? date('Y-m-d\TH:i:s', strtotime($objPagoT[0]->$fechaIni)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true) ?>" required>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('fechaPagoFin') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true)) : ((isset($objPagoT) == true) ? date('Y-m-d\TH:i:s', strtotime($objPagoT[0]->$fechaFin)) : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true) ?>" required>

          </div>
        </div>
        <br> 




        <?php if (session::getInstance()->hasError('selectTrabajador')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectTrabajador') ?>
          </div>
        <?php endif ?>

        <div class="form-group">
          <label for="" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
          <div class="col-sm-10">
            <select class="form-control" id="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true) ?>" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true) ?>" required >
              <option value="<?php echo (session::getInstance()->hasFlash('selectTrabajador') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true)) : ((isset($objPagoT[0])) ? '' : '') ?>" ><?php echo i18n::__('selectTrabajador') ?></option>
              <?php foreach ($objT as $key): ?>
                <option <?php echo (request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true)) === true and request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true)) == $key->$idTra) ? 'selected' : (isset($objPagoT[0]->$idTrabajador) === true and $objPagoT[0]->$idTrabajador == $key->$idTra) ? 'selected' : '' ?> value="<?php echo $key->$idTra ?>"><?php echo $key->$nomTrabajador . ' ' . trabajadorTableClass::getNameApellido($key->$idTra). ' ' .  ' CC: ' . ' ' . trabajadorTableClass::getNameDocumento($key->$idTra)  ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <?php if (session::getInstance()->hasError('inputValor')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputValor') ?>
          </div>
        <?php endif ?>

        <?php if (session::getInstance()->hasError('inputHorasPerdidas')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputHorasPerdidas') ?>
          </div>
        <?php endif ?>

        <div class="row j1" >
          <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?>" class="col-sm-2"><?php echo i18n::__('valor') ?>:</label>     

          <div class="col-lg-5">
            <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputValor') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$valor : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?>" placeholder="<?php echo i18n::__('valor') ?>" onKeyUp="fncTotal()" required>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputHorasPerdidas') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$horas : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>" placeholder="<?php echo i18n::__('horasPerdidas') ?>" onKeyUp="fncTotal()" required>

          </div>
        </div>
       
        <br>


        <?php if (session::getInstance()->hasError('inputTotal')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert" id="error">
            <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputTotal') ?>
          </div>
        <?php endif ?>

        <div class="form-group">
          <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>" class="col-sm-2"><?php echo i18n::__('totalPagar') ?>:</label>     
          <div class="col-sm-10">
            <input  class="form-control" value="<?php echo  (session::getInstance()->hasFlash('inputTotal') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$total : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>" placeholder="<?php echo i18n::__('total') ?>" required readonly>
          </div>
        </div>


        <input   class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objPagoT)) ? 'update' : 'register')) ?>">
        <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

        <br><br><br><br><br><br><br><br><br><br>
      </form>
    </div>
  </div>
</div> 