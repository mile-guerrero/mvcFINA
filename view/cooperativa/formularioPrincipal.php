<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php $idCooperativa = cooperativaTableClass::ID ?>
<?php $nom = cooperativaTableClass::NOMBRE?>
<?php $descripcion = cooperativaTableClass::DESCRIPCION ?>
<?php $direccion = cooperativaTableClass::DIRECCION ?>
<?php $telefono = cooperativaTableClass::TELEFONO?>
<?php $idCiudaddes = ciudadTableClass::ID ?>
<?php $idCiudad = cooperativaTableClass::ID_CIUDAD ?>
<?php $descripcionciudad = ciudadTableClass::NOMBRE_CIUDAD ?>

<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('cooperativa', ((isset($objCooperativa)) ? 'update' : 'create')) ?>">
  <?php if(isset($objCooperativa)==true): ?>
  <input  name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::ID,true) ?>" value="<?php echo $objCooperativa[0]->$idCooperativa ?>" type="hidden">
  <?php endif ?>
 <?php view::includeHandlerMessage()?>
  <div class="form-group">
      <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::NOMBRE, true) ?>" class="col-sm-2"> <?php echo i18n::__('nom') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control" value="<?php echo ((isset($objCooperativa)==true) ? $objCooperativa[0]->$nom : '') ?>"  type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE, true) ?>" placeholder="<?php echo i18n::__('nom') ?>" required>
     </div>
  </div>  
  
  <div class="form-group">
      <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::DESCRIPCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('des') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo ''?>" value="<?php echo ((isset($objCooperativa)==true) ? $objCooperativa[0]->$descripcion : '') ?>" type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION, true) ?>" placeholder="<?php echo i18n::__('des') ?>" required>
      </div>
  </div>   
  
  <div class="form-group">
      <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::DIRECCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('dir') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo ''?>" value="<?php echo ((isset($objCooperativa)==true) ? $objCooperativa[0]->$direccion : '') ?>" type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::DIRECCION, true) ?>" placeholder="<?php echo i18n::__('dir') ?>" required>
      </div>
  </div>
  
  <div class="form-group">
      <label for="<?php echo cooperativatableClass::getNameField(cooperativaTableClass::TELEFONO, true) ?>" class="col-sm-2"> <?php echo i18n::__('tel') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo ''?>" value="<?php echo ((isset($objCooperativa)==true) ? $objCooperativa[0]->$telefono : 'telefono') ?>" type="text" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::TELEFONO, true) ?>" placeholder="<?php echo i18n::__('telefono') ?>" required>
      </div>
  </div>
       
      <div class="form-group">
      <label for="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true) ?>" class="col-sm-2"> <?php echo i18n::__('idCiudad') ?>: </label>     
      <div class="col-sm-14">             

     	  <select class="form-control-gonza2" id="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::ID, true)?>" name="<?php echo cooperativaTableClass::getNameField(cooperativaTableClass::ID_CIUDAD, true) ?>">
            <option><?php echo i18n::__('selectCiudad') ?></option>
<?php foreach ($objCC as $C): ?>
              <option <?php echo (isset($objCooperativa[0]->$idCiudad) === true and $objCooperativa[0]->$idCiudad == $C->$idCiudaddes) ? 'selected' : '' ?> value="<?php echo $C->$idCiudaddes ?>"><?php echo $C->$descripcionciudad ?></option>
<?php endforeach; ?>
          </select>
        </div> 
      </div>
  
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objCooperativa)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cooperativa', 'index') ?>" ><?php echo i18n::__('atras') ?></a>

  </form>
  </article>
  </div>