<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $idM = maquinaTableClass::ID ?>
<?php $descripcion = maquinaTableClass::DESCRIPCION ?>
<?php $tipo_uso = maquinaTableClass::TIPO_USO_ID?>
<?php $tipo_usos = tipoUsoMaquinaTableClass::ID?>
<?php $des_usos = tipoUsoMaquinaTableClass::DESCRIPCION?>
<?php $origen_id = maquinaTableClass::ORIGEN_ID ?>
<?php $origen_ids = origenMaquinaTableClass::ID ?>
<?php $des_origen = origenMaquinaTableClass::DESCRIPCION?>
<?php $proveedor_id = maquinaTableClass::PROVEEDOR_ID ?>
<?php $proveedor_ids = proveedorTableClass::ID ?>
<?php $des_proveedor = proveedorTableClass::NOMBREP ?>
<div class="container container-fluid" id="cuerpo">
   <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('maquina', ((isset($objMaquina)) ? 'updateMaquina' : 'createMaquina')) ?>">
  <?php if(isset($objMaquina)== true): ?>
  <input  name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ID,true) ?>" value="<?php echo $objMaquina[0]->$idM ?>" type="hidden">
  <?php endif ?>
    <?php view::includeHandlerMessage()?>
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>: </label>     
      <div class="col-sm-10">  
        <input class="form-control"  value="<?php echo ((isset($objMaquina)== true) ? $objMaquina[0]->$nombre : '') ?>" type="text" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
  </div>
</div>
  
  
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:  </label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objMaquina)== true) ? $objMaquina[0]->$descripcion : '') ?>" type="text" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
      </div>
  </div>
  
  
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, true) ?>" class="col-sm-2"> <?php echo i18n::__('tipo') ?>:  </label>
      <div class="col-sm-10"> 
        <select class="form-control" id="<?php maquinaTableClass::getNameField(maquinaTableClass::ID, TRUE)?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, TRUE);?>">
       <option><?php echo i18n::__('selectTipoUso') ?></option>
       <?php foreach($objMTUM as $TUM):?>
       <option <?php echo (isset($objMaquina[0]->$tipo_uso) === true and $objMaquina[0]->$tipo_uso == $TUM->$tipo_usos) ? 'selected' : '' ?> value="<?php echo $TUM->$tipo_usos ?>"><?php echo $TUM->$des_usos?></option>
       <?php endforeach;?>
   </select>   
      </div> 
    </div> 
  
   <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_ID, true) ?>" class="col-sm-2">  <?php echo i18n::__('origen') ?>:   </label>
      <div class="col-sm-10"> 
        <select class="form-control" id="<?php maquinaTableClass::getNameField(maquinaTableClass::ID, TRUE)?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_ID, TRUE);?>">
           <option><?php echo i18n::__('selectOrigen') ?></option>
       <?php foreach($objMOM as $O):?>
       <option <?php echo (isset($objMaquina[0]->$origen_id) === true and $objMaquina[0]->$origen_id == $O->$origen_ids) ? 'selected' : '' ?> value="<?php echo $O->$origen_ids?>"><?php echo $O->$des_origen?></option>
       <?php endforeach;?>
   </select>   
      </div> 
    </div> 
  
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true) ?>" class="col-sm-2">  <?php echo i18n::__('pro') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php maquinaTableClass::getNameField(maquinaTableClass::ID, TRUE)?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, TRUE);?>">
       <option><?php echo i18n::__('selectProveedor') ?></option>
       <?php foreach($objMP as $P):?>
       <option <?php echo (isset($objMaquina[0]->$proveedor_id) === true and $objMaquina[0]->$proveedor_id == $P->$proveedor_ids) ? 'selected' : '' ?> value="<?php echo $P->$proveedor_ids?>"><?php echo $P->$des_proveedor?></option>
       <?php endforeach;?>
   </select> 
      </div> 
    </div> 
  
  <input class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objMaquina)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
   </article>
</div>