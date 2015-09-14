<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\request\requestClass as request ?>

<?php $idControlPlaga = controlPlagaTableClass::ID ?>
<?php $cantidad = controlPlagaTableClass::CANTIDAD ?>
<?php $lote = controlPlagaTableClass::LOTE_ID ?>
<?php $idLote = loteTableClass::ID ?>
<?php $nomLote = loteTableClass::UBICACION ?>

<?php $plaga = controlPlagaTableClass::PLAGA_ID ?>
<?php $idPlaga = plagaTableClass::ID ?>
<?php $nomPlaga = plagaTableClass::NOMBRE ?>

<?php $insumo = controlPlagaTableClass::PRODUCTO_INSUMO_ID ?>
<?php $idInsumo = tipoProductoInsumoTableClass::ID ?>
<?php $nomInsumo = tipoProductoInsumoTableClass::DESCRIPCION ?>

<?php $insumoInsumo = controlPlagaTableClass::PRODUCTO_INSUMO_ID  ?>
<?php $idInsumoInsumo = productoInsumoTableClass::ID ?>
<?php $nomInsumoInsumo = productoInsumoTableClass::DESCRIPCION ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo3">

    <!--<article id='derecha'>-->


    <!--<div class="row j1" >
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">&nbsp;</div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">&nbsp;</div>
    </div>-->

    <form class="form-horizontal julianlasso" role="form" method="post" action="<?php echo routing::getInstance()->getUrlWeb('controlPlaga', ((isset($objControlPlaga)) ? 'update' : 'create')) ?>">
      <?php if (isset($objControlPlaga) == true): ?>
        <input  name="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::ID, true) ?>" value="<?php echo $objControlPlaga[0]->$idControlPlaga ?>" type="hidden">
      <?php endif ?>

      <!--        &nbsp;-->
      <br><br><br><br><br>
      
      <?php if (session::getInstance()->hasError('selectLote')): ?>
            <div class=" alert alert-danger alert-dismissible" role="alert" id="error">
              <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectLote') ?>
            </div>
          <?php endif ?>
      
      <div class="form-group">
          <label class="col-sm-2" for="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true) ?>" >  <?php echo i18n::__('lote') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control"  name="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true); ?>" required>
              <option value="<?php echo (session::getInstance()->hasFlash('selectLote') or request::getInstance()->hasPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true))) ? request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)) : ((isset($objControlPlaga[0])) ? '' : '') ?>"><?php echo i18n::__('selectLote') ?></option>
              <?php  foreach ($objLote as $key): ?>
         
              <option <?php echo (request::getInstance()->hasPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)) === true and request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)) == $key->$idLote) ? 'selected' : (isset($objControlPlaga[0]->$lote) === true and $objControlPlaga[0]->$lote == $key->$idLote) ? 'selected' : ''  ?> value="<?php echo $key->$idLote  ?>"><?php echo $key->$nomLote  ?></option>
                <?php  endforeach; ?>
            </select>
          </div>
        </div>
        <br>
        
        <?php if (session::getInstance()->hasError('selectPlaga')): ?>
            <div class=" alert alert-danger alert-dismissible" role="alert" id="error">
              <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectPlaga') ?>
            </div>
          <?php endif ?>
        
        <div class="form-group">
          <label class="col-sm-2" for="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true) ?>" >  <?php echo i18n::__('plaga') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control" name="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true) ?>" required>
              <option value="<?php echo (session::getInstance()->hasFlash('selectPlaga') or request::getInstance()->hasPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true))) ? request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true)) : ((isset($objControlPlaga[0])) ? '' : '') ?>"><?php echo i18n::__('selectPlaga') ?></option>
              <?php  foreach ($objPlaga as $key): ?>         
              <option <?php echo (request::getInstance()->hasPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true)) === true and request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PLAGA_ID, true)) == $key->$idPlaga) ? 'selected' : (isset($objControlPlaga[0]->$plaga) === true and $objControlPlaga[0]->$plaga == $key->$idPlaga) ? 'selected' : ''  ?> value="<?php echo $key->$idPlaga  ?>"><?php echo $key->$nomPlaga  ?></option>
                <?php  endforeach; ?>
            </select>
          </div>
        </div>
        <br>
      
         
        
      <div class="form-group">
          <label class="col-sm-2"  for="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true) ?>">  <?php echo i18n::__('tipo insumo') ?>:   </label>
          <div class="col-sm-10"> 
            <select class="form-control" id="slcTipoDeInsumo" required onchange="cargarInsumo('<?php echo routing::getInstance()->getUrlWeb('@getInsumo') ?>')">
              <option value="">Seleccione el tipo de insumo</option>
              <?php foreach ($objTipo as $key): ?>
              <option <?php echo (isset($idTipoProducto) and $idTipoProducto == $key->$idInsumo ) ? 'selected' : '' ?> value="<?php echo $key->$idInsumo ?>"><?php echo $key->$nomInsumo ?></option>
              <?php endforeach; ?>
             
            </select>
          </div>
        </div>
        
                
        <?php if (session::getInstance()->hasError('selectProducto')): ?>
            <div class=" alert alert-danger alert-dismissible" role="alert" id="error">
              <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('selectProducto') ?>
            </div>
          <?php endif ?>
        
        <?php if (session::getInstance()->hasError('inputCantidad')): ?>
            <div class=" alert alert-danger alert-dismissible" role="alert" id="error">
              <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?>
            </div>
          <?php endif ?>
        
                        
        <div class="row j1" >
         <label class="col-sm-2" for="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true) ?>" >  <?php echo i18n::__('insumo') ?>:   </label>
         <div class="col-lg-5">
         <select class="form-control" id="slcInsumo" name="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true); ?>" required>
              <option value="<?php echo (session::getInstance()->hasFlash('selectProducto') or request::getInstance()->hasPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true))) ? request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true)) : ((isset($objControlPlaga[0])) ? '' : '') ?>"><?php echo i18n::__('selectInsumo') ?></option>
              <?php  foreach ($objProducto as $key): ?>
         
              <option <?php echo (request::getInstance()->hasPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true)) === true and request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID, true)) == $key->$idInsumoInsumo) ? 'selected' : (isset($objControlPlaga[0]->$insumoInsumo) === true and $objControlPlaga[0]->$insumoInsumo == $key->$idInsumoInsumo) ? 'selected' : ''  ?> value="<?php echo $key->$idInsumoInsumo  ?>"><?php echo $key->$nomInsumoInsumo  ?></option>
                <?php  endforeach; ?>
            </select>
        </div>
        
                 
         <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <input  class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputCantidad') or request::getInstance()->hasPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::CANTIDAD, true))) ? request::getInstance()->getPost(controlPlagaTableClass::getNameField(controlPlagaTableClass::CANTIDAD, true)) : ((isset($objControlPlaga[0])) ? $objControlPlaga[0]->$cantidad : '') ?>" type="text" name="<?php echo controlPlagaTableClass::getNameField(controlPlagaTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('cantidad') ?>" >
        </div>
      </div>
        
       
        <br>


      <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objControlPlaga)) ? 'update' : 'register')) ?>">
      <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('controlPlaga', 'index') ?>" ><?php echo i18n::__('atras') ?> </a>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
    </form> 
    <!--  </article>-->
  </div>
  </div>
</div>
 