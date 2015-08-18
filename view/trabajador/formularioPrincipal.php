<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php $idTrabajador = trabajadorTableClass::ID ?>
<?php $documento = trabajadorTableClass::DOCUMENTO ?>
<?php $apellido = trabajadorTableClass::APELLIDO ?>
<?php $direccion = trabajadorTableClass::DIRECCION ?>
<?php $telefono = trabajadorTableClass::TELEFONO ?>
<?php $email = trabajadorTableClass::EMAIL ?>
<?php $idTipo = trabajadorTableClass::ID_TIPO_ID ?>
<?php $idTipoId = tipoIdTableClass::ID ?>
<?php $desc = tipoIdTableClass::DESCRIPCION ?>
<?php $ciudadId = trabajadorTableClass::ID_CIUDAD ?>
<?php $idCiudad = ciudadTableClass::ID?>
<?php $nomCiu = ciudadTableClass::NOMBRE_CIUDAD?>
<?php $cre = trabajadorTableClass::ID_CREDENCIAL ?>
<?php $idCredencial = credencialTableClass::ID?>
<?php $nomCredencial = credencialTableClass::NOMBRE?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
  
  <form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', ((isset($objTrabajador)) ? 'update' : 'create')) ?>">
<?php if (isset($objTrabajador) == true): ?>
    <input  name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, true) ?>" value="<?php echo $objTrabajador[0]->$idTrabajador ?>" type="hidden">
<?php endif ?>
   
    <br><br><br><br>
    
   <?php if(session::getInstance()->hasError('inputDocumento')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDocumento') ?>
    </div>
    <?php endif ?>
        
        
    <?php if(session::getInstance()->hasError('selectTipoId')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectTipoId') ?>
    </div>
    <?php endif ?>  
    
    <div class="row j1" >
<label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true) ?>" class="col-sm-2"> <?php echo i18n::__('documento') ?>:</label>     
        <div class="col-lg-5">
          <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDocumento')  or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true)) : ((isset($objTrabajador[0])) ? $objTrabajador[0]->$documento : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true) ?>" placeholder="<?php echo i18n::__('documento') ?>" required>
       </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
          <select class="form-control" id="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, true) ?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true) ?>">
<!--<option value="<?php //echo (session::getInstance()->hasFlash('selectTipoId') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true)) : ((isset($objTrabajador[0])) ? '' : '') ?>"><?php echo i18n::__('selectTipoId') ?></option>-->
<option value=""><?php echo i18n::__('selectTipoId') ?></option>        
<?php foreach ($objCTI as $tipoId): ?>
<option <?php echo (request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true)) === true and request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true)) == $tipoId->$idTipoId) ? 'selected' : (isset($objTrabajador[0]->$idTipo) === true and $objTrabajador[0]->$idTipo == $tipoId->$idTipoId) ? 'selected' : '' ?> value="<?php echo $tipoId->$idTipoId ?>"><?php echo $tipoId->$desc ?></option>
<?php endforeach; ?>
        </select>
        </div>
      </div>
<br>
    
    
    <?php if(session::getInstance()->hasError('inputNombre')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?>
    </div>
    <?php endif ?>
    
    
    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputNombre') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true)) : ((isset($objTrabajador[0])) ? $objTrabajador[0]->$nombre : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
      </div>
    </div>  
    
     <?php if(session::getInstance()->hasError('inputApellido')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputApellido') ?>
    </div>
    <?php endif ?>

    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true) ?>" class="col-sm-2"> <?php echo i18n::__('apell') ?>:</label>     
      <div class="col-sm-10">            
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputApellido') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true)) : ((isset($objTrabajador[0])) ? $objTrabajador[0]->$apellido : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true) ?>" placeholder="<?php echo i18n::__('apell') ?>" required>
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
<label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('dir') ?>: </label>     
       <div class="col-lg-5">
         <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDireccion') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true)) : ((isset($objTrabajador[0])) ? $objTrabajador[0]->$direccion : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true) ?>" placeholder="<?php echo i18n::__('dir') ?>" required>
       </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
          <select class="form-control" id="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, true)?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true) ?>">
 <option value="<?php echo (session::getInstance()->hasFlash('selectCiudad') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true)) : ((isset($objTrabajador[0])) ? '' : '') ?>"><?php echo i18n::__('selectCiudad') ?></option>            
<?php foreach ($objCC as $ciudad): ?>
 <option <?php echo (request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true)) === true and request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true)) == $ciudad->$idCiudad) ? 'selected' : (isset($objTrabajador[0]->$ciudadId) === true and $objTrabajador[0]->$ciudadId == $ciudad->$idCiudad) ? 'selected' : '' ?>  value="<?php echo $ciudad->$idCiudad ?>"><?php echo $ciudad->$nomCiu ?></option>
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
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tel') ?>:  </label>     
      <div class="col-sm-10">              
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputTelefono') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true)) : ((isset($objTrabajador[0])) ? $objTrabajador[0]->$telefono : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true) ?>" placeholder="<?php echo i18n::__('tel') ?>" required> 
      </div>
    </div>
    
    
    <?php if(session::getInstance()->hasError('inputEmail')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputEmail') ?>
    </div>
    <?php endif ?> 
    
    
    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true) ?>" class="col-sm-2"> <?php echo i18n::__('email') ?>:  </label>     
      <div class="col-sm-10">              
        <input class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputEmail') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true)) : ((isset($objTrabajador[0])) ? $objTrabajador[0]->$email : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true) ?>" placeholder="<?php echo i18n::__('email') ?>" required>
      </div>
    </div>

    
    <?php if(session::getInstance()->hasError('selectCredencial')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectCredencial') ?>
    </div>
    <?php endif ?>

    <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('credencial') ?>: </label>
         <div class="col-sm-10">
          <select class="form-control" id="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, true)?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true) ?>">
   <option value="<?php echo (session::getInstance()->hasFlash('selectCredencial') or request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true))) ? request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true)) : ((isset($objTrabajador[0])) ? '' : '') ?>"><?php echo i18n::__('selectCredencial') ?></option>         
<?php foreach ($objCredencial as $credencial): ?>
            <option <?php echo (request::getInstance()->hasPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true)) === true and request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true)) == $credencial->$idCredencial) ? 'selected' : (isset($objTrabajador[0]->$cre) === true and $objTrabajador[0]->$cre == $credencial->$idCredencial) ? 'selected' : '' ?> value="<?php echo $credencial->$idCredencial ?>"><?php echo $credencial->$nomCredencial ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>

    <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objTrabajador)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

 <br><br><br><br><br>
    </form>
  </div>
</div>
</div>