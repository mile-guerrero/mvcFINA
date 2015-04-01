<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idS = solicitudInsumoTableClass::ID ?>
<?php $fecha = solicitudInsumoTableClass::FECHA_HORA ?>
<?php $trabajador = solicitudInsumoTableClass::TRABAJADOR_ID ?>
<div class="container container-fluid" id="cuerpo">
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', ((isset($objOS)) ? 'update' : 'create')) ?>">
  <?php if(isset($objOS)== true): ?>
  <input  name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::ID, true) ?>" value="<?php echo $objOS[0]->$idOS ?>" type="hidden">
  <?php endif ?>
  
  <div class="form-group">
      <label for="<?php echo ordenServiciotableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true) ?>" class="col-sm-2"><?php echo i18n::__('fecha_M') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo ((isset($objOS)== true) ? $objOS[0]->$fecha : '') ?>" type="datetime-local" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::FECHA_HORA, true) ?>">
      </div>
  </div>
  
  <div class="form-group">
      <label for="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true) ?>" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
      <div class="col-sm-10"> 
        <input value="" type="text" name="<?php echo solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::TRABAJADOR_ID, true) ?>" class="form-control" list="nombres" placeholder="Digite nombre">
        <datalist id="nombres">
          <?php foreach ($objST as $tra): ?>
            <option value="<?php echo $tra->$$trabajador ?>"><?php echo $tra->$trabajador ?></option>
          <?php endforeach; ?>
        </datalist>    
      </div> 
    </div> 

  <br>
  <input  class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objOS)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
</div>