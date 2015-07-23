<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php $idCooperativa = cooperativaTableClass::ID ?>
<?php $nom = cooperativaTableClass::NOMBRE?>
<?php $descripcion = cooperativaTableClass::DESCRIPCION ?>
<?php $direccion = cooperativaTableClass::DIRECCION ?>
<?php $telefono = cooperativaTableClass::TELEFONO?>
<?php $idCiudaddes = ciudadTableClass::ID ?>
<?php $idCiudad = cooperativaTableClass::ID_CIUDAD ?>
<?php $descripcionciudad = ciudadTableClass::NOMBRE_CIUDAD ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
    
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('cooperativa', ((isset($objCooperativa)) ? 'update' : 'create')) ?>">
  <?php if(isset($objCooperativa)==true): ?>
  <input  name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::ID,true) ?>" value="<?php echo $objCooperativa[0]->$idCooperativa ?>" type="hidden">
  <?php endif ?>
 
   <br><br><br><br>
 
  <br>
  <?php if(session::getInstance()->hasError('inputNombre')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?>
    </div>
    <?php endif ?>
  
  
  <div class="form-group">
      <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputNombre') or request::getInstance()->hasPost(cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true))) ? request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true)) : ((isset($objCooperativa[0])) ? $objCooperativa[0]->$nom : '') ?>"    type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
     </div>
  </div>  
  
 <?php if(session::getInstance()->hasError('inputDescripcion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescripcion') ?>
    </div>
    <?php endif ?> 
  
  
  
  <div class="form-group">
      <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control"  value="<?php echo (session::getInstance()->hasFlash('inputDescripcion') or request::getInstance()->hasPost(cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION, true))) ? request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION, true)) : ((isset($objCooperativa[0])) ? $objCooperativa[0]->$descripcion : '') ?>"   type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
      </div>
  </div>  
  
  
  
   <?php if(session::getInstance()->hasError('inputDireccion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDireccion') ?>
    </div>
    <?php endif ?>
  
   <?php if(session::getInstance()->hasError('selectCiudad')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectCiudad') ?>
    </div>
    <?php endif ?>
  
  
  <div class="row j1" >
 <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::DIRECCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('dir') ?>:</label>     
      <div class="col-lg-5">
          <input class="form-control"  value="<?php echo (session::getInstance()->hasFlash('inputDireccion') or request::getInstance()->hasPost(cooperativaTableClass::getNameField(cooperativaTableClass::DIRECCION, true))) ? request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::DIRECCION, true)) : ((isset($objCooperativa[0])) ? $objCooperativa[0]->$direccion : '') ?>"  type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::DIRECCION, true) ?>" placeholder="<?php echo i18n::__('dir') ?>" required>
      </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
          <select class="form-control" id="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::ID, true)?>" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true) ?>">
            <option value="<?php echo (session::getInstance()->hasFlash('selectCiudad')  or request::getInstance()->hasPost(cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true))) ? request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true)) : ((isset($objCooperativa[0])) ? '' : '') ?>"  ><?php echo i18n::__('selectCiudad') ?></option>
<?php foreach ($objCC as $C): ?>
              <option <?php echo (request::getInstance()->hasPost(cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true)) === true and request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true)) == $C->$idCiudaddes) ? 'selected' : (isset($objCooperativa[0]->$idCiudad) === true and $objCooperativa[0]->$idCiudad == $C->$idCiudaddes) ? 'selected' : '' ?>  value="<?php echo $C->$idCiudaddes ?>"><?php echo $C->$descripcionciudad ?></option>
<?php endforeach; ?>
          </select>
        </div>
      </div>
<br> 
 
  
  
  <?php if(session::getInstance()->hasError('inputTelefono')): ?>
   <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputTelefono') ?>
    </div>
    <?php endif ?>
  
  
  <div class="form-group">
      <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::TELEFONO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tel') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control"  value="<?php echo (session::getInstance()->hasFlash('inputTelefono') or request::getInstance()->hasPost(cooperativaTableClass::getNameField(cooperativaTableClass::TELEFONO, true))) ? request::getInstance()->getPost(cooperativaTableClass::getNameField(cooperativaTableClass::TELEFONO, true)) : ((isset($objCooperativa[0])) ? $objCooperativa[0]->$telefono : '') ?>" type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::TELEFONO, true) ?>" placeholder="<?php echo i18n::__('tel') ?>" required>
      </div>
  </div>
  
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objCooperativa)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cooperativa', 'index') ?>" ><?php echo i18n::__('atras') ?></a>

<br><br><br>
    </form>
  </div>
</div>
</div>
