<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idEmp = pagoTrabajadorTableClass::EMPRESA_ID?>
<?php $idEmpresa = empresaTableClass::ID?>
<?php $nomEmpresa = empresaTableClass::NOMBRE?>
<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $created_at = pagoTrabajadorTableClass::CREATED_AT ?>
<?php $updated_at = pagoTrabajadorTableClass::UPDATED_AT ?>

<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', ((isset($objPagoT)) ? 'update' : 'create')) ?>">
    <?php if (isset($objPagoT) == true): ?>
    <input  name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::ID, true) ?>" value="<?php echo $objPagoT[0]->$idPagoT ?>" type="hidden">
    <?php endif ?>
    
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

    <div class="form-group">
      <label for="" class="col-sm-2"> <?php echo i18n::__('empresa') ?> </label>
      <div class="col-sm-10"> 
        <select class="form-control" id="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true) ?>" name="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true) ?>">
          
<?php foreach ($objEmpresa as $empresa): ?>
            <option value="<?php echo $empresa->$idEmpresa ?>"><?php echo $empresa->$nomEmpresa ?></option>
<?php endforeach; ?>
        </select> 
      </div> 
    </div>   
      

    <input   class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objPagoT)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form>
  </article>
</div>  