<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $idLote = loteTableClass::ID ?>
<?php $ubi = loteTableClass::UBICACION ?>
<?php $tamano = loteTableClass::TAMANO ?>
<?php $descripcion = loteTableClass::DESCRIPCION ?>
<?php $idCiudad = loteTableClass::ID_CIUDAD ?>
<?php $descripcionciudad = ciudadTableClass::NOMBRE_CIUDAD ?>
<?php $idCiudaddes = ciudadTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('lote', ((isset($objLote)) ? 'updateLote' : 'createLote')) ?>">
  <?php if(isset($objLote)== true): ?>
  <input  name="<?php echo loteTableClass::getNameField(loteTableClass::ID,true) ?>" value="<?php echo $objLote[0]->$idLote ?>" type="hidden">
  <?php endif ?>
    <?php view::includeHandlerMessage()?>
  <div class="form-group">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" class="col-sm-2"> <?php echo i18n::__('ubicacion') ?>:</label>     
      <div class="col-sm-10">
        <input  class="form-control"  value="<?php echo ((isset($objLote)==true) ? $objLote[0]->$ubi : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" placeholder="<?php echo i18n::__('ubicacion') ?>" required>
      </div>
  </div>
  
 <div class="form-group">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::TAMANO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tamano') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objLote)==true) ? $objLote[0]->$tamano : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::TAMANO, true) ?>" placeholder="<?php echo i18n::__('tamano') ?>" required>
      </div>
 </div>
  
 <div class="form-group">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>: </label>     
      <div class="col-sm-10">
        <input  class="form-control" value="<?php echo ((isset($objLote)==true) ? $objLote[0]->$descripcion : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
      </div>
 </div>
  
  
  <div class="form-group">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('idCiudad') ?>: </label>
      <div class="col-sm-10">       
<select class="form-control" id="<?php loteTableClass::getNameField(loteTableClass::ID_CIUDAD, TRUE)?>" name="<?php echo loteTableClass::getNameField(loteTableClass::ID_CIUDAD, TRUE);?>">
       <option><?php echo i18n::__('selectCiudad') ?></option>
       <?php foreach($objLC as $C):?>
       <option value="<?php echo $C->$idCiudaddes?>"><?php echo $C->$descripcionciudad?></option>
       <?php endforeach;?>
   </select>
      </div> 
    </div> 
    
<input class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objLote)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
  </article>
</div>