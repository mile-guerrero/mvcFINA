<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $idT = tipoIdTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
  <form class="form-horizontal" role="form"  method="post" action="<?php echo routing::getInstance()->getUrlWeb('cliente', ((isset($objTI)) ? 'updateTipoId' : 'createTipoId')) ?>">
    <?php if (isset($objTI) == true): ?>
      <input  name="<?php echo tipoIdTableClass::getNameField(tipoIdTableClass::ID, true) ?>" value="<?php echo $objTI[0]->$idT ?>" type="hidden">
    <?php endif ?>

    <div class="form-group">
      <label for="<?php echo tipoIdtableClass::getNameField(tipoIdTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:</label>     
      <div class="col-sm-10"> 
        <input  class="form-control" value="<?php echo ((isset($objTI) == true) ? $objTI[0]->$descripcion : '') ?>" type="text" name="<?php echo tipoIdTableClass::getNameField(tipoIdTableClass::DESCRIPCION, true) ?>">
      </div>
    </div>  
      
      <input class="btn btn-lg btn-primary btn-xs"  type="submit" value="<?php echo i18n::__(((isset($objTI)) ? 'update' : 'register')) ?>">
      <a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexTipoId') ?>" >Ir Paguina Anterior</a>

      </form>
  </article>
    </div>