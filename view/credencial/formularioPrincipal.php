<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $idCredencial = credencialTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('credencial', ((isset($objCredencial)) ? 'update' : 'create')) ?>">
    <?php if (isset($objCredencial) == true): ?>
      <input  name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>" value="<?php echo $objCredencial[0]->$idCredencial ?>" type="hidden">
    <?php endif ?>

    <div class="form-group">
      <label for="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">      
        <input class="form-control" value="<?php echo ((isset($objCredencial) == true) ? $objCredencial[0]->$nombre : '') ?>" type="text" name="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>">
      </div>
    </div>

    <input   class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objCredencial)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form>
  </article>
</div>  