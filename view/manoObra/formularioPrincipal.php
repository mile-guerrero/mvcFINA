<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $id = manoObraTableClass::ID ?>
<?php $total = manoObraTableClass::TOTAL ?>
<?php $cantidad = manoObraTableClass::CANTIDAD_HORA ?>
<?php $valor = manoObraTableClass::VALOR_HORA ?>

<?php $labor = manoObraTableClass::LABOR_ID ?>
<?php $idLabor = laborTableClass::ID ?>
<?php $descLabor = laborTableClass::DESCRIPCION ?>

<?php $maquina = manoObraTableClass::MAQUINA_ID ?>
<?php $idMaquina = maquinaTableClass::ID ?>
<?php $descMaquina = maquinaTableClass::NOMBRE ?>

<?php $cooperativa = manoObraTableClass::COOPERATIVA_ID ?>
<?php $idCooperativa = cooperativaTableClass::ID ?>
<?php $descCooperativa = cooperativaTableClass::NOMBRE ?>




<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo3">
    
<script>
function fncTotal(){
caja=document.forms["sumar"].elements;
var <?php echo manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true) ?> = Number(caja["<?php echo manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true) ?>"].value);
var <?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?> = Number(caja["<?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?>"].value);

<?php echo manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true) ?> = (<?php echo manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true) ?>)*(<?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?>);
if(!isNaN(<?php echo manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true) ?>)){
caja["<?php echo manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true) ?>"].value=(<?php echo manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true) ?>)*(<?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?>) ;
}
}
</script> 
    
<form  name="sumar" class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('manoObra', ((isset($objManoObra)) ? 'update' : 'create')) ?>">
  <?php if(isset($objManoObra)== true): ?>
  <input  name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::ID, true) ?>" value="<?php echo $objManoObra[0]->$id ?>" type="hidden">
  <?php endif ?>
  
   <br><br><br><br>
  
<?php if(session::getInstance()->hasError('selectCooperativa')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert" id="error">
      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectCooperativa') ?>
    </div>
    <?php endif ?>
   
  

  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('cooperativa') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true)?>" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectCooperativa') or request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true))) ? request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true)) : ((isset($objManoObra[0])) ? '' : '') ?>"><?php echo i18n::__('selectCooperativa') ?></option>
<?php foreach ($objCooperativa as $key): ?>
               <option <?php echo (request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true)) === true and request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true)) == $key->$idCooperativa) ? 'selected' : (isset($objManoObra[0]->$cooperativa) === true and $objManoObra[0]->$cooperativa == $key->$idCooperativa) ? 'selected' : '' ?> value="<?php echo $key->$idCooperativa ?>"><?php echo $key->$descCooperativa ?></option>
            <?php endforeach; ?>
          </select>
      </div>
    </div> 
  
  <?php if(session::getInstance()->hasError('selectMaquina')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert" id="error">
      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectMaquina') ?>
    </div>
    <?php endif ?>
  
  <?php if(session::getInstance()->hasError('selectLabor')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert" id="error">
      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectLabor') ?>
    </div>
    <?php endif ?>
   
   
   <div class="row j1" >
<label for="" class="col-sm-2"> <?php echo i18n::__('maquina') ?> </label>
<div class="col-lg-5">
       <select class="form-control" id="<?php echo manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true)?>" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectMaquina') or request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true))) ? request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true)) : ((isset($objManoObra[0])) ? '' : '') ?>"><?php echo i18n::__('selectMaquina') ?></option>
<?php foreach ($objMaquina as $key): ?>
            <option <?php echo (request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true)) === true and request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true)) == $key->$idMaquina) ? 'selected' : (isset($objManoObra[0]->$maquina) === true and $objManoObra[0]->$maquina == $key->$idMaquina) ? 'selected' : '' ?> value="<?php echo $key->$idMaquina ?>"><?php echo $key->$descMaquina ?></option>
<?php endforeach; ?>
          </select>
</div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
           <select class="form-control" id="<?php echo manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true)?>" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true) ?>">
               <option value="<?php echo (session::getInstance()->hasFlash('selectLabor') or request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true))) ? request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true)) : ((isset($objManoObra[0])) ? '' : '') ?>"><?php echo i18n::__('selectLabor') ?></option>
<?php foreach ($objLabor as $key): ?>
            <option <?php echo (request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true)) === true and request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true)) == $key->$idLabor) ? 'selected' : (isset($objManoObra[0]->$labor) === true and $objManoObra[0]->$labor == $key->$idLabor) ? 'selected' : '' ?> value="<?php echo $key->$idLabor ?>"><?php echo $key->$descLabor ?></option>
<?php endforeach; ?>
          </select>
        </div>
      </div>
<br>
  
   
  <?php if(session::getInstance()->hasError('inputCantidad')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert" id="error">
      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?>
    </div>
    <?php endif ?>
  
  <?php if(session::getInstance()->hasError('inputValor')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert" id="error">
      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputValor') ?>
    </div>
    <?php endif ?>
  
   <div class="row j1" >
<label for="<?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?>" class="col-sm-2"> <?php echo i18n::__('valor hora') ?>:</label>     
           <div class="col-lg-5">
       <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputValor') or request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true))) ? request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true)) : ((isset($objManoObra[0])) ? $objManoObra[0]->$valor : '') ?>" type="text" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?>" placeholder="<?php echo i18n::__('valor hora') ?>" onKeyUp="fncTotal()" required>
    
            </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
           <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true))) ? request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true)) : ((isset($objManoObra[0])) ? $objManoObra[0]->$cantidad : '') ?>" type="text" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true) ?>" placeholder="<?php echo i18n::__('cantidad hora') ?>" onKeyUp="fncTotal()" required>
      
        </div>
      </div>
<br>

<div class="form-group">
          <label for="<?php echo manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true) ?>" class="col-sm-2"><?php echo i18n::__('totalPagar') ?>:</label>     
          <div class="col-sm-10">
            <input  class="form-control" value="<?php echo  (session::getInstance()->hasFlash('inputTotal') or request::getInstance()->hasPost(manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true))) ? request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true)) : ((isset($objManoObra[0])) ? $objManoObra[0]->$total : '') ?>" type="text" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::TOTAL, true) ?>" placeholder="<?php echo i18n::__('total') ?>" required readonly>
          </div>
        </div>
 
  
  <input  class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objManoObra)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('manoObra', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>


 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>