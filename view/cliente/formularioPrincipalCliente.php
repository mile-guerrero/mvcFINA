<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<?php $idCliente = clienteTableClass::ID ?>
<?php $apellido = clienteTableClass::APELLIDO ?>
<?php $direccion = clienteTableClass::DIRECCION ?>
<?php $telefono = clienteTableClass::TELEFONO ?>
<?php $idTipo = clienteTableClass::ID_TIPO_ID ?>
<?php $idCiudad = clienteTableClass::ID_CIUDAD ?>
<?php $descripcionciudad = ciudadTableClass::NOMBRE_CIUDAD ?>
<?php $descripciontipo = tipoIdTableClass::DESCRIPCION ?>
      <?php $idCiudaddes = ciudadTableClass::ID ?>
      <?php $idTipoId = tipoIdTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('cliente', ((isset($objCliente)) ? 'updateCliente' : 'createCliente')) ?>">
<?php if (isset($objCliente) == true): ?>
        <input  name="<?php echo clienteTableClass::getNameField(clienteTableClass::ID, true) ?>" value="<?php echo $objCliente[0]->$idCliente ?>" type="hidden">
<?php endif ?>
<?php view::includeHandlerMessage() ?>
      <div class="form-group">

        <label for="<?php echo clienteTableClass::getNameField(clienteTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
        <div class="col-sm-10">
          <input class="form-control" value="<?php echo ((isset($objCliente) == true) ? $objCliente[0]->$nombre : '') ?>" type="text" name="<?php echo clienteTableClass::getNameField(clienteTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
        </div>
      </div>  

      <div class="form-group">
        <label for="<?php echo clienteTableClass::getNameField(clienteTableClass::APELLIDO, true) ?>" class="col-sm-2"> <?php echo i18n::__('apell') ?>:</label>     
        <div class="col-sm-10">            
          <input class="form-control" value="<?php echo ((isset($objCliente) == true) ? $objCliente[0]->$apellido : '') ?>" type="text" name="<?php echo clienteTableClass::getNameField(clienteTableClass::APELLIDO, true) ?>" placeholder="<?php echo i18n::__('apell') ?>" required>
        </div>
      </div> 

      <div class="form-group">
        <label for="<?php echo clienteTableClass::getNameField(clienteTableClass::DIRECCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('dir') ?>: </label>     
        <div class="col-sm-10">             
          <input class="form-control" value="<?php echo ((isset($objCliente) == true) ? $objCliente[0]->$direccion : '') ?>" type="text" name="<?php echo clienteTableClass::getNameField(clienteTableClass::DIRECCION, true) ?>" placeholder="<?php echo i18n::__('dir') ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label for="<?php echo clienteTableClass::getNameField(clienteTableClass::TELEFONO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tel') ?>:  </label>     
        <div class="col-sm-10">              
          <input class="form-control" value="<?php echo ((isset($objCliente) == true) ? $objCliente[0]->$telefono : '') ?>" type="number" name="<?php echo clienteTableClass::getNameField(clienteTableClass::TELEFONO, true) ?>" placeholder="<?php echo i18n::__('tel') ?>" required>
        </div>
      </div>



      <div class="form-group">
        <label for="<?php echo clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, true) ?>" class="col-sm-2"> <?php echo i18n::__('idTipo') ?> </label>
        <div class="col-sm-10">   
          <select class="form-control" id="<?php clienteTableClass::getNameField(clienteTableClass::ID, TRUE) ?>" name="<?php echo clienteTableClass::getNameField(clienteTableClass::ID_TIPO_ID, TRUE); ?>">
            <option><?php echo i18n::__('selectTipoId')?></option>
<?php foreach ($objCTI as $IT): ?>
              <option <?php echo (isset($objCliente[0]->$idTipo) === true and $objCliente[0]->$idTipo == $IT->$idTipoId) ? 'selected' : '' ?> value="<?php echo $IT->$idTipoId ?>"><?php echo $IT->$descripciontipo ?></option>
<?php endforeach; ?>
          </select>  
        </div> 
      </div>

      <div class="form-group">
        <label for="<?php echo clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('idCiudad') ?> </label>
        <div class="col-sm-10">       
          <select class="form-control" id="<?php clienteTableClass::getNameField(clienteTableClass::ID, true) ?>" name="<?php echo clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true); ?>">
           <option><?php echo i18n::__('selectCiudad')?></option>
<?php foreach ($objCC as $C): ?>
              <option <?php echo (isset($objCliente[0]->$idCiudad) === true and $objCliente[0]->$idCiudad == $C->$idCiudaddes) ? 'selected' : '' ?> value="<?php echo $C->$idCiudaddes ?>"><?php echo $C->$descripcionciudad ?></option>
<?php endforeach; ?>
          </select>
        </div> 
      </div>

      <!--                  <div class="form-group">
               <label for="<?php echo clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true) ?>" class="col-sm-2"><?php echo i18n::__('idCiudad') ?>:  </label>     
               <div class="col-sm-10">
                 <input class="form-control" type="text" name="<?php echo clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true) ?>" list="nombres" placeholder="<?php echo i18n::__('ciudad') ?>" >
                 <datalist id="nombres">
<?php foreach ($objCC as $C): ?>
                     <option value="<?php echo $C->$idCiudaddes ?>"><?php echo $C->$descripcionciudad ?></option>
<?php endforeach; ?>
                 </datalist>
               </div>
          </div> -->



      <input class="btn btn-lg btn-primary btn-xs" type="submit" value="<?php echo i18n::__(((isset($objCliente)) ? 'update' : 'register')) ?>">
      <a class="btn btn-lg btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexCliente') ?>" ><?php echo i18n::__('atras') ?> </a>

    </form> 
  </article>
</div>