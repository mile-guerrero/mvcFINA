<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php $idM = maquinaTableClass::ID ?>
<?php $descripcion = maquinaTableClass::DESCRIPCION ?>
<?php $tipo_uso = maquinaTableClass::TIPO_USO_ID?>
<?php $tipo_usos = tipoUsoMaquinaTableClass::ID?>
<?php $des_usos = tipoUsoMaquinaTableClass::DESCRIPCION?>
<?php $origen_id = maquinaTableClass::ORIGEN_MAQUINA ?>
<?php $proveedor_id = maquinaTableClass::PROVEEDOR_ID ?>
<?php $proveedor_ids = proveedorTableClass::ID ?>
<?php $des_proveedor = proveedorTableClass::NOMBREP ?>
<div class="container container-fluid" id="cuerpo">
   <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('maquina', ((isset($objMaquina)) ? 'updateMaquina' : 'createMaquina')) ?>">
  <?php if(isset($objMaquina)== true): ?>
  <input  name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ID,true) ?>" value="<?php echo $objMaquina[0]->$idM ?>" type="hidden">
  <?php endif ?>
   
  
  
  <?php if(session::getInstance()->hasError('inputNombre')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?>
    </div>
    <?php endif ?>
  
  
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>: </label>     
      <div class="col-sm-10">  
        <input class="form-control"  value="<?php echo (session::getInstance()->hasFlash('inputNombre') or request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true))) ? request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true)) : ((isset($objMaquina[0])) ? $objMaquina[0]->$nombre : '') ?>" type="text" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
  </div>
</div>
  
  
  
  <?php if(session::getInstance()->hasError('inputDescripcion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescripcion') ?>
    </div>
    <?php endif ?>
  
  
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:  </label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true))) ? request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true)) : ((isset($objMaquina[0])) ? $objMaquina[0]->$descripcion : '') ?>" type="text" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
      </div>
  </div>
  
  
  <?php if(session::getInstance()->hasError('inputOrigen')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputOrigen') ?>
    </div>
    <?php endif ?>
  
  
  <?php if(session::getInstance()->hasError('selectTipo')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectTipo') ?>
    </div>
    <?php endif ?>
  
  
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA, true) ?>" class="col-sm-2"> <?php echo i18n::__('origenM') ?>:  </label>     
      <div class="col-sm-10">
        <input class="form-control-gonza1" value="<?php echo (session::getInstance()->hasFlash('inputOrigen') or request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA, true))) ? request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA, true)) : ((isset($objMaquina[0])) ? $objMaquina[0]->$origen_id : '') ?>" type="text" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ORIGEN_MAQUINA, true) ?>" placeholder="<?php echo i18n::__('origenM') ?>" required>
      
        
        <select class="form-control-gonza2" id="<?php maquinaTableClass::getNameField(maquinaTableClass::ID, true)?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, true);?>">
       <option value="<?php echo (session::getInstance()->hasFlash('selectTipo') or request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, true))) ? request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::TIPO_USO_ID, true)) : ((isset($objMaquina[0])) ? '' : '') ?>" ><?php echo i18n::__('selectTipoUso') ?></option>
       <?php foreach($objMTUM as $TUM):?>
       <option <?php echo (isset($objMaquina[0]->$tipo_uso) === true and $objMaquina[0]->$tipo_uso == $TUM->$tipo_usos) ? 'selected' : '' ?> value="<?php echo $TUM->$tipo_usos ?>"><?php echo $TUM->$des_usos?></option>
       <?php endforeach;?>
   </select>   
      </div> 
    </div> 

  
  <?php if(session::getInstance()->hasError('selectProveedor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectProveedor') ?>
    </div>
    <?php endif ?>
  
  
  <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true) ?>" class="col-sm-2">  <?php echo i18n::__('pro') ?>:   </label>
      <div class="col-sm-10"> 
    <select class="form-control" id="<?php maquinaTableClass::getNameField(maquinaTableClass::ID, true)?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true);?>">
       <option value="<?php echo (session::getInstance()->hasFlash('selectProveedor') or request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true))) ? request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::PROVEEDOR_ID, true)) : ((isset($objMaquina[0])) ? '' : '') ?>" ><?php echo i18n::__('selectProveedor') ?></option>
       <?php foreach($objMP as $P):?>
       <option <?php echo (isset($objMaquina[0]->$proveedor_id) === true and $objMaquina[0]->$proveedor_id == $P->$proveedor_ids) ? 'selected' : '' ?> value="<?php echo $P->$proveedor_ids?>"><?php echo $P->$des_proveedor?></option>
       <?php endforeach;?>
   </select> 
      </div> 
    </div> 
  
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objMaquina)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
   </article>
</div>