<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $idProveedor = proveedorTableClass::ID ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $documento = proveedorTableClass::DOCUMENTO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
<?php $ciudadId = proveedorTableClass::ID_CIUDAD ?>
<?php $email = proveedorTableClass::EMAIL ?>
<?php $idCiudad = ciudadTableClass::ID?>
<?php $nomCiu = ciudadTableClass::NOMBRE_CIUDAD?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
  <form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('maquina', ((isset($objProveedor)) ? 'updateProveedor' : 'createProveedor')) ?>">
<?php if (isset($objProveedor) == true): ?>
    <input  name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true) ?>" value="<?php echo $objProveedor[0]->$idProveedor ?>" type="hidden">
<?php endif ?>
  
    <?php if(session::getInstance()->hasError('inputDocumento')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDocumento') ?>
    </div>
    <?php endif ?>
    
    <div class="form-group">
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true) ?>" class="col-sm-2"> <?php echo i18n::__('documento') ?>:</label>     
      <div class="col-sm-10">            
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDocumento') or request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true))) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true)) : ((isset($objProveedor[0])) ? $objProveedor[0]->$documento : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DOCUMENTO, true) ?>" placeholder="<?php echo i18n::__('documento') ?>"required>
      </div>
    </div> 
    
    
     <?php if(session::getInstance()->hasError('inputNombre')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?>
    </div>
    <?php endif ?>
    
    
    <div class="form-group">
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">
        <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputNombre') or request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true))) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true)) : ((isset($objProveedor[0])) ? $objProveedor[0]->$nombre : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBREP, true) ?>" placeholder="<?php echo i18n::__('nom') ?>"required>
      </div>
    </div>  
    
    <?php if(session::getInstance()->hasError('inputApellido')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputApellido') ?>
    </div>
    <?php endif ?>

    <div class="form-group">
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true) ?>" class="col-sm-2"> <?php echo i18n::__('apell') ?>:</label>     
      <div class="col-sm-10">            
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputApellido') or request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true))) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)) : ((isset($objProveedor[0])) ? $objProveedor[0]->$apellido : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true) ?>" placeholder="<?php echo i18n::__('apell') ?>"required>
      </div>
    </div> 
    
    <?php if(session::getInstance()->hasError('inputDireccion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDireccion') ?>
    </div>
    <?php endif ?> 

    <div class="form-group">
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('dir') ?>: </label>     
      <div class="col-sm-10">             
        <input class="form-control-gonza1" value="<?php echo (session::getInstance()->hasFlash('inputDireccion') or request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true))) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true)) : ((isset($objProveedor[0])) ? $objProveedor[0]->$direccion : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true) ?>" placeholder="<?php echo i18n::__('dir') ?>"required>
     
        
        <?php if(session::getInstance()->hasError('selectCiudad')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectCiudad') ?>
    </div>
    <?php endif ?> 
        
           <select class="form-control-gonza2" id="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true)?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true) ?>">
            <option value="<?php echo (session::getInstance()->hasFlash('selectCiudad') or request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true))) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true)) : ((isset($objProveedor[0])) ? $objProveedor[0]->$nomCiu : '') ?>" ><?php echo i18n::__('selectCiudad') ?></option>
<?php foreach ($objCiudad as $ciudad): ?>
            <option <?php echo (isset($objProveedor[0]->$ciudadId) === true and $objProveedor[0]->$ciudadId == $ciudad->$idCiudad) ? 'selected' : '' ?> value="<?php echo $ciudad->$idCiudad ?>"><?php echo $ciudad->$nomCiu ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>
    
<?php if(session::getInstance()->hasError('inputTelefono')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputTelefono') ?>
    </div>
    <?php endif ?> 
    
    <div class="form-group">
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tel') ?>:  </label>     
      <div class="col-sm-10">              
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputTelefono') or request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true))) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)) : ((isset($objProveedor[0])) ? $objProveedor[0]->$telefono : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true) ?>" placeholder="<?php echo i18n::__('tel') ?>"required>
      </div>
    </div>
    
    
    <?php if(session::getInstance()->hasError('inputEmail')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputEmail') ?>
    </div>
    <?php endif ?> 
    
    
    <div class="form-group">
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::EMAIL, true) ?>" class="col-sm-2"> <?php echo i18n::__('email') ?>:</label>     
      <div class="col-sm-10">            
        <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputEmail') or request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true))) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)) : ((isset($objProveedor[0])) ? $objProveedor[0]->$email : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::EMAIL, true) ?>" placeholder="<?php echo i18n::__('email') ?>"required>
      </div>
    </div> 
    
      

    <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objProveedor)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form> 
  </article>
</div>
