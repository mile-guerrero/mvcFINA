<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

 <?php $value = session::getInstance()->getAttribute('idGrafica'); ?>
 
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo4">
    <div class="center-block" id="cuerpo2"> 
    
      
  <?php if ($value == 1) : ?>   
  <h2 class="form-signin-heading">
<script>
  $(document).ready(function () {
    crearGrafica(<?php echo json_encode($cosPoints) ?>);  
  });
</script>
<div id="chart3" style="width: 600px; height: 400px"></div>
</h2>
 <?php endif; ?>
      
      
<?php if ($value == 2) : ?>
<h2 class="form-signin-heading">
<script>
  $(document).ready(function () {
    crearGrafica2(<?php echo json_encode($cosPoints2) ?>);  
  });
</script>
<div id="chart2" style="width: 600px; height: 400px"></div>
</h2>       
<?php endif; ?> 
      
      
      <br>
 <a class="btn btn-lg btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'report') ?>" ><?php echo i18n::__('importar pdf') ?></a>
      <br><br><br><br><br><br><br><br><br><br><br><br>
       </div>    
  </div>    
</div>