<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idTrabajador = trabajadorTableClass::ID ?>
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
<?php $idCredencial = credencialTableClass::ID?>
<?php $nomCredencial = credencialTableClass::NOMBRE?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
  <form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', ((isset($objTrabajador)) ? 'update' : 'create')) ?>">
<?php if (isset($objTrabajador) == true): ?>
    <input  name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, true) ?>" value="<?php echo $objTrabajador[0]->$idTrabajador ?>" type="hidden">
<?php endif ?>

    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objTrabajador) == true) ? $objTrabajador[0]->$nombre : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true) ?>" placeholder="<?php echo i18n::__('nom') ?>">
      </div>
    </div>  

    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true) ?>" class="col-sm-2"> <?php echo i18n::__('apell') ?>:</label>     
      <div class="col-sm-10">            
        <input class="form-control" value="<?php echo ((isset($objTrabajador) == true) ? $objTrabajador[0]->$apellido : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true) ?>" placeholder="<?php echo i18n::__('apell') ?>">
      </div>
    </div> 

    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('dir') ?>: </label>     
      <div class="col-sm-10">             
        <input class="form-control" value="<?php echo ((isset($objTrabajador) == true) ? $objTrabajador[0]->$direccion : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true) ?>" placeholder="<?php echo i18n::__('dir') ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tel') ?>:  </label>     
      <div class="col-sm-10">              
        <input class="form-control" value="<?php echo ((isset($objTrabajador) == true) ? $objTrabajador[0]->$telefono : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true) ?>" placeholder="<?php echo i18n::__('tel') ?>"> 
      </div>
    </div>
    
    <div class="form-group">
      <label for="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true) ?>" class="col-sm-2"> <?php echo i18n::__('email') ?>:  </label>     
      <div class="col-sm-10">              
        <input class="form-control" value="<?php echo ((isset($objTrabajador) == true) ? $objTrabajador[0]->$email : '') ?>" type="text" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true) ?>" placeholder="<?php echo i18n::__('email') ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="" class="col-sm-2"> <?php echo i18n::__('idTipo') ?> </label>
      <div class="col-sm-10"> 
        <select class="form-control" id="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true) ?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true) ?>">
        
<?php foreach ($objCTI as $tipoId): ?>
            <option value="<?php echo $tipoId->$idTipoId ?>"><?php echo $tipoId->$desc ?></option>
<?php endforeach; ?>
        </select> 
      </div> 
    </div>   
      
      <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('idCiudad') ?> </label>
         <div class="col-sm-10">
          <select class="form-control" id="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true)?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true) ?>">
            
<?php foreach ($objCC as $ciudad): ?>
            <option value="<?php echo $ciudad->$idCiudad ?>"><?php echo $ciudad->$nomCiu ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>
    
    <div class="form-group">
         <label for="" class="col-sm-2"> id credencial </label>
         <div class="col-sm-10">
          <select class="form-control" id="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true)?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true) ?>">
            
<?php foreach ($objCredencial as $credencial): ?>
            <option value="<?php echo $credencial->$idCredencial ?>"><?php echo $credencial->$nomCredencial ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>

    <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objTrabajador)) ? 'update' : 'register')) ?>">
    <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

  </form> 
    </article>
</div>