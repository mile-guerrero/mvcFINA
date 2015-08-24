<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $idReporte = reporteTableClass::ID ?>
<?php $nombre = reporteTableClass::NOMBRE ?>
<?php $idLote = loteTableClass::ID ?>
<?php $ubi = loteTableClass::UBICACION ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo5">
  <div class="center-block" id="cuerpo2">
    
<form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('reportes', 'create') ?>" method="POST">
  <?php if(isset($objReportes)==true): ?>
  <input  name="<?php echo reporteTableClass::getNameField(reporteTableClass::ID,true) ?>" value="<?php echo $objReportes[0]->$idReporte ?>" type="hidden">
  <?php endif ?>
  
  <br><br><br><br>
 
  <br>
  
  <?php if(session::getInstance()->hasError('inputUbicacion')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputUbicacion') ?>
                    </div>              
                  <?php endif ?>
              
             
                    
              <div class="form-group">
                <label for="filterUbicacion" class="col-sm-2 control-label"><?php echo i18n::__('ubicacion') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filterUbicacion" name="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" placeholder="buscar por ubicacion">
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