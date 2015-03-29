<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idOS = ordenServicioTableClass::ID ?>
<?php $fecha = ordenServicioTableClass::FECHA_MANTENIMIENTO ?>
<?php $trabajador = trabajadorTableClass::NOMBRET ?>
<?php $trabajadorId = trabajadorTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
   <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', ((isset($objOS)) ? 'update' : 'create')) ?>">
  <?php if(isset($objOS)== true): ?>
  <input  name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::ID, true) ?>" value="<?php echo $objOS[0]->$idOS ?>" type="hidden">
  <?php endif ?>
  
  <div class="form-group">
      <label for="<?php echo ordenServiciotableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true) ?>" class="col-sm-2"> <?php echo i18n::__('fecha_M') ?>:</label>     
      <div class="col-sm-10">
   <input  class="form-control" value="<?php echo ((isset($objOS)== true) ? $objOS[0]->$fecha : '') ?>" type="datetime-local" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true) ?>">
      </div>
  </div>
  
  <div class="form-group">
      <label for="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true) ?>" class="col-sm-2"> <?php echo i18n::__('trabajador') ?> </label>
      <div class="col-sm-10"> 
        <input value="" type="text" name="<?php echo ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true) ?>" class="form-control" list="nombres" placeholder="Digite nombre">
        <datalist id="nombres">
          <?php foreach ($objOST as $tra): ?>
            <option value="<?php echo $tra->$$trabajadorId ?>"><?php echo $tra->$trabajador ?></option>
          <?php endforeach; ?>
        </datalist>    
      </div> 
    </div> 

  
  <input  class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objOS)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
   </article>
</div>