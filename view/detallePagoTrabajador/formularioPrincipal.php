<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idDetalle = detallePagoTrabajadorTableClass::ID ?>
<?php $salario = detallePagoTrabajadorTableClass::VALOR_SALARIO ?>
<?php $cantHoras = detallePagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS ?>
<?php $valorHoras = detallePagoTrabajadorTableClass::VALOR_HORAS_EXTRAS ?>
<?php $horas = detallePagoTrabajadorTableClass::HORAS_PERDIDAS ?>
<?php $total = detallePagoTrabajadorTableClass::TOTAL_PAGAR ?>
<?php $idPago = pagoTrabajadorTableClass::ID ?>
<?php $fecha = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $pago = detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID ?>
<?php $Trabajador = detallePagoTrabajadorTableClass::TRABAJADOR_ID ?>
<?php $idTrabajador = trabajadorTableClass::ID ?>
<?php $nomTrabajador = trabajadorTableClass::NOMBRET ?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
  <form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('detallePagoTrabajador', ((isset($objDPT)) ? 'update' : 'create')) ?>">
<?php if (isset($objDPT) == true): ?>
      <input  name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::ID, true) ?>" value="<?php echo $objDPT[0]->$idDetalle ?>" type="hidden">
<?php endif ?>

    <div class="form-group">
      <label for="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::VALOR_SALARIO, true) ?>" class="col-sm-2"> <?php echo i18n::__('salario') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objDPT) == true) ? $objDPT[0]->$salario : '') ?>" type="text" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::VALOR_SALARIO, true) ?>" placeholder="<?php echo i18n::__('salario') ?>">
      </div>
    </div>  

    <div class="form-group">
      <label for="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true) ?>" class="col-sm-2"> <?php echo i18n::__('cantidad') ?>:</label>     
      <div class="col-sm-10">            
        <input class="form-control" value="<?php echo ((isset($objDPT) == true) ? $objDPT[0]->$cantHoras : '') ?>" type="text" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
      </div>
    </div> 

    <div class="form-group">
      <label for="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true) ?>" class="col-sm-2"> <?php echo i18n::__('horasExtras') ?>: </label>     
      <div class="col-sm-10">             
        <input class="form-control" value="<?php echo ((isset($objDPT) == true) ? $objDPT[0]->$valorHoras : '') ?>" type="text" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true) ?>" placeholder="<?php echo i18n::__('horasExtras') ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>" class="col-sm-2"> <?php echo i18n::__('horasPerdidas') ?>:  </label>     
      <div class="col-sm-10">              
        <input class="form-control" value="<?php echo ((isset($objDPT) == true) ? $objDPT[0]->$horas : '') ?>" type="text" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::HORAS_PERDIDAS, true) ?>" placeholder="<?php echo i18n::__('horasPerdidas') ?>">
      </div>
    </div>

     <div class="form-group">
      <label for="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>" class="col-sm-2"> <?php echo i18n::__('totalPagar') ?>:  </label>     
      <div class="col-sm-10">              
        <input class="form-control" value="<?php echo ((isset($objDPT) == true) ? $objDPT[0]->$total : '') ?>" type="text" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::TOTAL_PAGAR, true) ?>" placeholder="<?php echo i18n::__('totalPagar') ?>">
      </div>
    </div> 
      
       
      
      <div class="form-group">
         <label for="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true) ?>" class="col-sm-2"><?php  echo i18n::__('pagoTrabajador') ?>:  </label>     
         <div class="col-sm-10">
          <input class="form-control" value=" <?php echo ((isset($objDPT) == true) ? $objDPT[0]->$pago : $objDPTT[0]->$idPago) ?>"
            type="text" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true) ?>" placeholder="<?php echo i18n::__('pagoTrabajador') ?>" >
      </div>
    </div> 
      
<!--     <div class="form-group">
         <label for="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true) ?>" class="col-sm-2"><?php  echo i18n::__('pagoTrabajador') ?>:  </label>     
         <div class="col-sm-10">
          <input class="form-control" value=" 
            <?php foreach ($objDPTT as $trabajador): ?>
              <?php echo $trabajador->$pago ?>
            <?php endforeach; ?>" 
            type="text" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID, true) ?>" placeholder="<?php echo i18n::__('pagoTrabajador') ?>" >
      </div>
    </div> -->
      
      
      
      <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
         <div class="col-sm-10">
          <select class="form-control" id="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::TRABAJADOR_ID, true)?>" name="<?php echo detallePagoTrabajadorTableClass::getNameField(detallePagoTrabajadorTableClass::TRABAJADOR_ID, true) ?>">
        
<?php foreach ($objTrabajador as $trabajador): ?>
            <option value="<?php echo $trabajador->$idTrabajador ?>"><?php echo $trabajador->$nomTrabajador ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>

    <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objDPT)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form> 
    </article>
</div>