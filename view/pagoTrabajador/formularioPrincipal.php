<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $idEmp = pagoTrabajadorTableClass::EMPRESA_ID?>
<?php $idEmpresa = empresaTableClass::ID?>
<?php $nomEmpresa = empresaTableClass::NOMBRE?>
<?php $idTra = trabajadorTableClass::ID?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET?>
<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $idTrabajador = pagoTrabajadorTableClass::TRABAJADOR_ID ?>
<?php $valor = pagoTrabajadorTableClass::VALOR_SALARIO ?>
<?php $cantidad = pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS?>
<?php $valorHoras = pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS ?>
<?php $horas = pagoTrabajadorTableClass::HORAS_PERDIDAS?>
<?php $total = pagoTrabajadorTableClass::TOTAL_PAGAR ?>

<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', ((isset($objPagoT)) ? 'update' : 'create')) ?>">
    <?php if (isset($objPagoT) == true): ?>
    <input  name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::ID, true) ?>" value="<?php echo $objPagoT[0]->$idPagoT ?>" type="hidden">
    <?php endif ?>
    
    <br>
     <div class="form-group">
       <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true) ?>" class="col-sm-2"><?php echo i18n::__('fechaPagoIni') ?>:</label>     
      <div class="col-sm-10">
        <input  class="form-control" value="<?php echo ((isset($objPagoT)== true) ? $objPagoT[0]->$fechaIni : '') ?>" type="datetime-local" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true) ?>">
      </div>
  </div>
    
    <div class="form-group">
       <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true) ?>" class="col-sm-2"><?php echo i18n::__('fechaPagoFin') ?>:</label>     
      <div class="col-sm-10">
        <input  class="form-control" value="<?php echo ((isset($objPagoT)== true) ? $objPagoT[0]->$fechaFin : '') ?>" type="datetime-local" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true) ?>">
      </div>
  </div>
    
    <?php if(session::getInstance()->hasError('inputValor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputValor') ?>
    </div>
    <?php endif ?>
    
    <div class="form-group">
       <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?>" class="col-sm-2"><?php echo i18n::__('valor') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputValor') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$valor : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true) ?>" placeholder="<?php echo i18n::__('valor') ?>">
      </div>
  </div>
    
    <?php if(session::getInstance()->hasError('inputCantidad')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?>
    </div>
    <?php endif ?>
    
    <div class="form-group">
       <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true) ?>" class="col-sm-2"><?php echo i18n::__('cantidad') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$cantidad : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
      </div>
  </div>
    
    <?php if(session::getInstance()->hasError('inputHoras')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputHoras') ?>
    </div>
    <?php endif ?>
    
    <div class="form-group">
       <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true) ?>" class="col-sm-2"><?php echo i18n::__('horasExtras') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputHoras') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$valorHoras : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true) ?>" placeholder="<?php echo i18n::__('horasExtras') ?>">
      </div>
  </div>
    
    <?php if(session::getInstance()->hasError('inputHorasPerdidas')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputHorasPerdidas') ?>
    </div>
    <?php endif ?>
    
    <div class="form-group">
       <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>" class="col-sm-2"><?php echo i18n::__('horasPerdidas') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputHorasPerdidas') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$horas : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>" placeholder="<?php echo i18n::__('horasPerdidas') ?>">
      </div>
  </div>
    
     <?php if(session::getInstance()->hasError('inputTotal')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputTotal') ?>
    </div>
    <?php endif ?>
    
    <div class="form-group">
       <label for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>" class="col-sm-2"><?php echo i18n::__('totalPagar') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputTotal') or request::getInstance()->hasPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true))) ? request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true)) : ((isset($objPagoT[0])) ? $objPagoT[0]->$total : '') ?>" type="text" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>" placeholder="<?php echo i18n::__('totalPagar') ?>">
      </div>
  </div>
    
    <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('empresa') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true)?>" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true) ?>">
            <option><?php echo i18n::__('selectEmpresa') ?></option>
<?php foreach ($objEmpresa as $empresa): ?>
            <option <?php echo (isset($objPagoT[0]->$idEmp) === true and $objPagoT[0]->$idEmp == $empresa->$idEmpresa) ? 'selected' : '' ?> value="<?php echo $empresa->$idEmpresa ?>"><?php echo $empresa->$nomEmpresa ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>

    <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true)?>" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true) ?>">
            <option><?php echo i18n::__('selectTrabajador') ?></option>
<?php foreach ($objT as $trabajador): ?>
            <option <?php echo (isset($objPagoT[0]->$idTrabajador) === true and $objPagoT[0]->$idTrabajador == $trabajador->$idTra) ? 'selected' : '' ?> value="<?php echo $trabajador->$idTra ?>"><?php echo $trabajador->$nomTrabajador ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>
     
    <input   class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objPagoT)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form>
  </article>
</div>  