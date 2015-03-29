<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $descripcion = tipoUsoMaquinaTableClass::DESCRIPCION ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
  <form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'createTipoUsoMaquina') ?>">
   <?php view::includeHandlerMessage()?>
    <div class="form-group">
      <label for="<?php echo tipoUsoMaquinatableClass::getNameField(tipoUsoMaquinaTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:  </label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objTUM) == true) ? $objTUM[0]->$descripcion : '') ?>" type="text" name="<?php echo tipoUsoMaquinaTableClass::getNameField(tipoUsoMaquinaTableClass::DESCRIPCION, true) ?>" placeholder="Descripcion" required>
      </div>
    </div>
    
    <input  class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objOM)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexTipoUsoMaquina') ?>" ><?php echo i18n::__('atras') ?> </a>
 
  </form>
  </article>
</div>