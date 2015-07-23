<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>

<?php $idCredencial = credencialTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('credencial', ((isset($objCredencial)) ? 'update' : 'create')) ?>">
    <?php if (isset($objCredencial) == true): ?>
      <input  name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>" value="<?php echo $objCredencial[0]->$idCredencial ?>" type="hidden">
    <?php endif ?>
      <br><br><br><br><br><br><br><br>
  <?php view::includeHandlerMessage()?>
    <div class="form-group">
      <label for="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">      
        <input class="form-control" value="<?php echo ((isset($objCredencial) == true) ? $objCredencial[0]->$nombre : '') ?>" type="text" name="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
      </div>
    </div>

    <input   class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objCredencial)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  <br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div> 