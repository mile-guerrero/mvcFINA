<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = manoObraTableClass::ID ?>
<?php $cantidad = manoObraTableClass::CANTIDAD_HORA ?>
<?php $valor = manoObraTableClass::VALOR_HORA ?>
<?php $cooperativa = manoObraTableClass::COOPERATIVA_ID ?>
<?php $labor = manoObraTableClass::LABOR_ID ?>
<?php $maquina = manoObraTableClass::MAQUINA_ID ?>
<?php $idCooperativa = cooperativaTableClass::ID?>
<?php $descCooperativa = cooperativaTableClass::DESCRIPCION?>
<?php $idLabor = laborTableClass::ID ?>
<?php $descLabor = laborTableClass::DESCRIPCION ?>
<?php $idMaquina = maquinaTableClass::ID ?>
<?php $descMaquina = maquinaTableClass::NOMBRE ?>
<?php use mvc\request\requestClass as request ?>

<div class="container container-fluid" id="cuerpo">
   <article id='derecha'>
<form  class="form-horizontal" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('manoObra', ((isset($objManoObra)) ? 'update' : 'create')) ?>">
  <?php if(isset($objManoObra)== true): ?>
  <input  name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::ID, true) ?>" value="<?php echo $objManoObra[0]->$id ?>" type="hidden">
  <?php endif ?>
  
  <?php if(session::getInstance()->hasError('inputCantidad')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?>
    </div>
    <?php endif ?>
  
  <br>
  <div class="form-group">
      <label for="<?php echo manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true) ?>" class="col-sm-2"> <?php echo i18n::__('cantidad') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad')) ? request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true)) : ((isset($objManoObra[0])) ? $objManoObra[0]->$cantidad : '') ?>" type="text" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>">
      </div>
  </div>
  
  
  <div class="form-group">
      <label for="<?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?>" class="col-sm-2"> <?php echo i18n::__('valor') ?>:</label>     
      <div class="col-sm-10">
          <input  class="form-control" value="<?php echo ((isset($objManoObra)== true) ? $objManoObra[0]->$valor : '') ?>" type="text" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true) ?>" placeholder="<?php echo i18n::__('valor') ?>">
      </div>
  </div>
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('cooperativa') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true)?>" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true) ?>">
            <option><?php echo i18n::__('selectCooperativa') ?></option>
<?php foreach ($objCooperativa as $coope): ?>
            <option <?php echo (isset($objManoObra[0]->$cooperativa) === true and $objManoObra[0]->$cooperativa == $coope->$idCooperativa) ? 'selected' : '' ?> value="<?php echo $coope->$idCooperativa ?>"><?php echo $coope->$descCooperativa ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div> 

  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('labor') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true)?>" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true) ?>">
            <option><?php echo i18n::__('selectLabor') ?></option>
<?php foreach ($objLabor as $lab): ?>
            <option <?php echo (isset($objManoObra[0]->$labor) === true and $objManoObra[0]->$labor == $lab->$idLabor) ? 'selected' : '' ?> value="<?php echo $lab->$idLabor ?>"><?php echo $lab->$descLabor ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>
  
  <div class="form-group">
         <label for="" class="col-sm-2"> <?php echo i18n::__('maquina') ?> </label>
         <div class="col-sm-10">
           <select class="form-control" id="<?php echo manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true)?>" name="<?php echo manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true) ?>">
            <option><?php echo i18n::__('selectMaquina') ?></option>
<?php foreach ($objMaquina as $maq): ?>
            <option <?php echo (isset($objManoObra[0]->$maquina) === true and $objManoObra[0]->$maquina == $maq->$idMaquina) ? 'selected' : '' ?> value="<?php echo $maq->$idMaquina ?>"><?php echo $maq->$descMaquina ?></option>
<?php endforeach; ?>
          </select>
      </div>
    </div>

  
  <input  class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objManoObra)) ? 'update' : 'register')) ?>">
<a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('manoObra', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>

</form>
   </article>
</div>