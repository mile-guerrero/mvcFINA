<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php $idlabor = laborTableClass::ID ?>
<?php $descripcion = laborTableClass::DESCRIPCION?>
<?php $valor = laborTableClass::VALOR ?>

<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('labor', ((isset($objLabor)) ? 'update' : 'create')) ?>">
  <?php if(isset($objLabor)==true): ?>
  <input  name="<?php echo laborTableClass::getNameField(laborTableClass::ID,true) ?>" value="<?php echo $objLabor[0]->$idlabor ?>r" type="hidden">
  <?php endif ?>
 <?php view::includeHandlerMessage()?>
  <div class="form-group">
      <label for="<?php echo laborTableClass::getNameField(laborTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objLabor)==true) ? $objLabor[0]->$descripcion : '') ?>"  type="text" name="<?php echo laborTableClass::getNameField(laborTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
     </div>
  </div>   
  
  <div class="form-group">
      <label for="<?php echo laborTableClass::getNameField(laborTableClass::VALOR, true) ?>" class="col-sm-2"> <?php echo i18n::__('valor') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo ''?>" value="<?php echo ((isset($objLabor)==true) ? $objLabor[0]->$valor : '') ?>" type="text" name="<?php echo laborTableClass::getNameField(laborTableClass::VALOR, true) ?>" placeholder="<?php echo i18n::__('valor') ?>" required>
      </div>
  </div>
  
  
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objLabor)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('labor', 'index') ?>" ><?php echo i18n::__('atras') ?></a>

  </form>
  </article>
  </div>