<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $idReporte = reporteTableClass::ID ?>
<?php $nombre = reporteTableClass::NOMBRE ?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
    
<form enctype="multipart/form-data"  class="form-horizontal" role="form" class="form-horizontal" role="form"  method="post" action="<?php echo routing::getInstance()->getUrlWeb('reportes', ((isset($objReportes)) ? 'update' : 'ver')) ?>">
  <?php if(isset($objReportes)==true): ?>
  <input  name="<?php echo reporteTableClass::getNameField(reporteTableClass::ID,true) ?>" value="<?php echo $objReportes[0]->$idReporte ?>" type="hidden">
  <?php endif ?>
  
  <br><br><br><br>
 
  <br>
  
   <?php if (session::getInstance()->hasError('inputNombre')): ?>
                  <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                    <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?>
                  </div>
                <?php endif ?>
  
  <div class="form-group">
                  <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="filterNombre" name="filter[<?php echo reporteTableClass::getNameField(reporteTableClass::NOMBRE, true) ?>]" placeholder="buscar por nombre">
                  </div>
                </div>  
  
 
    
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objReportes)) ? 'update' : 'register')) ?>">
   
  <?php if (session::getInstance()->hasCredential('admin')): ?>
  <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
<?php endif ?>
  <br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
</div>
</div>