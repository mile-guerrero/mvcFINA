<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php $idLote = loteTableClass::ID ?>
<?php $ubi = loteTableClass::UBICACION ?>
<?php $tamano = loteTableClass::TAMANO ?>
<?php $descripcion = loteTableClass::DESCRIPCION ?>
<?php $fecha = loteTableClass::FECHA_INICIO_SIEMBRA ?>
<?php $fechaRiego = loteTableClass::FECHA_RIEGO ?>
<?php $numero = loteTableClass::NUMERO_PLANTULAS ?>
<?php $presupuesto = loteTableClass::PRESUPUESTO ?>

<?php $produccion = loteTableClass::PRODUCCION ?>

<?php $idUnidadMedidaId = loteTableClass::UNIDAD_MEDIDA_ID ?>
<?php $idUnidadMedida = unidadMedidaTableClass::ID ?>
<?php $desUnidadMedida = unidadMedidaTableClass::DESCRIPCION ?>

<?php $idUni = loteTableClass::UNIDAD_DISTANCIA_ID ?>
<?php $idUnidad = unidadDistanciaTableClass::ID ?>
<?php $desUnidad = unidadDistanciaTableClass::DESCRIPCION ?>

<?php $idInsu = loteTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idInsumo = productoInsumoTableClass::ID ?>
<?php $desInsumo = productoInsumoTableClass::DESCRIPCION ?>

<?php $idCiudad = loteTableClass::ID_CIUDAD ?>
<?php $descripcionciudad = ciudadTableClass::NOMBRE_CIUDAD ?>
<?php $idCiudaddes = ciudadTableClass::ID ?>


<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
    
<form class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('lote', ((isset($objLote)) ? 'updateLoteMas' : 'createLote')) ?>">
  <?php if(isset($objLote)== true): ?>
  <input  name="<?php echo loteTableClass::getNameField(loteTableClass::ID,true) ?>" value="<?php echo $objLote[0]->$idLote ?>" type="hidden">
  <?php endif ?>
   
  <br><br><br><br><br>
  
  <div class="row j1" >
<label for="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" class="col-sm-2"> <?php echo i18n::__('ubicacion') ?>:</label>     
        <div class="col-lg-5">
          <input  class="form-control"  value="<?php echo (session::getInstance()->hasFlash('inputUbicacion') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::UBICACION, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true)) : ((isset($objLote[0])) ? $objLote[0]->$ubi : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" placeholder="<?php echo i18n::__('ubicacion') ?>" required readonly>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
          <select  class="form-control" id="<?php loteTableClass::getNameField(loteTableClass::ID, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true); ?>"readonly>
            <option  value="<?php echo (session::getInstance()->hasFlash('selectCiudad') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true)) : ((isset($objLote[0])) ? '' : '') ?>" ><?php echo i18n::__('selectCiudad') ?></option>
<?php foreach ($objLC as $C): ?>
              <option <?php echo (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true)) === true and request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID_CIUDAD, true)) == $C->$idCiudaddes) ? 'selected' : (isset($objLote[0]->$idCiudad) === true and $objLote[0]->$idCiudad == $C->$idCiudaddes) ? 'selected' : '' ?>  value="<?php echo $C->$idCiudaddes ?>"><?php echo $C->$descripcionciudad ?></option>
<?php endforeach; ?>
          </select>
        </div>
      </div>
  <br>
 
  
<!--  desde aqui empieza los campos a utilizar-->
  
<?php  date_default_timezone_set('America/Bogota'); ?>  
<?php if(session::getInstance()->hasError('inputFecha')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFecha') ?>
    </div>
    <?php endif ?>
  
<!--  readonly para bloquear campo-->
  
<div class="form-group">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true) ?>" class="col-sm-2"> <?php echo i18n::__('fecha siembra') ?>: </label>     
      <div class="col-sm-10">
        <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputFecha') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true)) : ((isset($objLote) == true) ? date('Y-m-d\TH:i:s') : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_INICIO_SIEMBRA, true) ?>" placeholder="<?php echo i18n::__('fecha siembra') ?>"required >
      </div>
 </div>  

<?php if(session::getInstance()->hasError('inputPlantulas')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputPlantulas') ?>
    </div>
    <?php endif ?>




<div class="row j1" >
        <label for="<?php echo loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true) ?>" class="col-sm-2"> <?php echo i18n::__('numero') ?>: </label>     
        <div class="col-lg-5">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputPlantulas') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true)) : ((isset($objLote[0])) ? $objLote[0]->$numero : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::NUMERO_PLANTULAS, true) ?>" placeholder="<?php echo i18n::__('numero') ?>" >
      
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
           <select  class="form-control" id="<?php loteTableClass::getNameField(loteTableClass::ID, true)?>" name="<?php echo loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID, true);?>">
  <option value="null"><?php echo i18n::__('seleccione insumo') ?></option>
       <?php foreach($objLPI as $C):?>
       <option <?php echo (isset($objLote[0]->$idInsu) === true and $objLote[0]->$idInsu == $C->$idInsumo) ? 'selected' : '' ?>  value="<?php echo $C->$idInsumo?>"><?php echo $C->$desInsumo?></option>
       <?php endforeach;?>
   </select>
        </div>
      </div>
  
 

<?php if(session::getInstance()->hasError('inputPresupuesto')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputPresupuesto') ?>
    </div>
    <?php endif ?>
  
<div class="form-group">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true) ?>" class="col-sm-2"> <?php echo i18n::__('presupuesto') ?>: </label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputPresupuesto') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true)) : ((isset($objLote[0])) ? $objLote[0]->$presupuesto : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::PRESUPUESTO, true) ?>" placeholder="<?php echo i18n::__('presupuesto') ?>" >
      </div>
 </div>   

<?php  date_default_timezone_set('America/Bogota'); ?>  
<?php if(session::getInstance()->hasError('inputFechaRiego')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFechaRiego') ?>
    </div>
    <?php endif ?>
  
  
  
<div class="form-group">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_RIEGO, true) ?>" class="col-sm-2"> <?php echo i18n::__('fecha riego') ?>: </label>     
      <div class="col-sm-10">
        <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputFechaRiego') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_RIEGO, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_RIEGO, true)) : ((isset($objLote) == true) ? date('Y-m-d\TH:i:s') : date('Y-m-d\TH:i:s')) ?>" type="datetime-local" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_RIEGO, true) ?>" placeholder="<?php echo i18n::__('fecha riego') ?>"required >
      </div>
 </div>  



<?php if(session::getInstance()->hasError('inputProduccion')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputProduccion') ?>
    </div>
    <?php endif ?>
  

<div class="row j1" >
        <label for="<?php echo loteTableClass::getNameField(loteTableClass::PRODUCCION, true) ?>" class="col-sm-2"> <?php echo i18n::__('produccion') ?>: </label>     
        <div class="col-lg-5">
         <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputProduccion') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::PRODUCCION, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PRODUCCION, true)) : ((isset($objLote[0])) ? $objLote[0]->$produccion : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::PRODUCCION, true) ?>" placeholder="<?php echo i18n::__('produccion') ?>" >
     
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
           <select  class="form-control" id="<?php loteTableClass::getNameField(loteTableClass::ID, true)?>" name="<?php echo loteTableClass::getNameField(loteTableClass::UNIDAD_MEDIDA_ID, true);?>">
      <option value="null" ><?php echo i18n::__('selectUnidadPeso') ?></option>
       <?php foreach($objLUMedida as $C):?>
       <option  <?php echo (isset($objLote[0]->$idUnidadMedidaId) === true and $objLote[0]->$idUnidadMedidaId == $C->$idUnidadMedida) ? 'selected' : '' ?>  value="<?php echo $C->$idUnidadMedida?>"><?php echo $C->$desUnidadMedida?></option>
       <?php endforeach;?>
   </select>
        </div>
      </div>

   
    <br>
<input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objLote)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'indexLote') ?>" ><?php echo i18n::__('atras') ?> </a>
<br><br>
</form>
  </div>
</div>
</div>