<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

 <?php $value = session::getInstance()->getAttribute('idGrafica'); ?>
 
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpoReporte1">
    <div class="center-block" id="cuerpoReporte2"> 
    
      
  <?php if ($value == 1) : ?>   
      <h2 class="form-signin-heading rwd">
<!--<div id="chart3" style="width: 1400px; height: 3000px"></div>-->
<div id="info2c"></div>
<script>
  $(document).ready(function () {
    crearGrafica(<?php echo json_encode($cosPoints) ?>);  
  });
</script>
<?php if (count($cosPoints) >= 0 and count($cosPoints) <=8) : ?>
<div id="chart3" style="width: 1000px; height: 500px"></div>
<?php endif; ?>  

<?php if (count($cosPoints) >= 9 and count($cosPoints) <=17) : ?>
<div id="chart3" style="width: 2000px; height: 700px"></div>
<?php endif; ?> 

<?php if (count($cosPoints) >= 18 and count($cosPoints) <=25) : ?>
<div id="chart3" style="width: 3500px; height: 800px"></div>
<?php endif; ?> 

<?php if (count($cosPoints) >= 26 and count($cosPoints) <=38) : ?>
<div id="chart3" style="width: 3500px; height: 1100px"></div>
<?php endif; ?> 

<?php if (count($cosPoints) >= 39) : ?>
<div id="chart3" style="width: 6500px; height: 2800px"></div>
<?php endif; ?>
</h2>
 <?php endif; ?>
      
      
<?php if ($value == 2) : ?>
     
<h2 class="form-signin-heading rwd">
<script>
  $(document).ready(function () {
    crearGrafica2(<?php echo json_encode($cosPoints2) ?>);  
  });
</script>
<?php if (count($cosPoints2) >= 0 and count($cosPoints2) <=8) : ?>
<div id="chart2" style="width: 800px; height: 500px"></div>
<?php endif; ?>  

<?php if (count($cosPoints2) >= 9 and count($cosPoints2) <=17) : ?>
<div id="chart2" style="width: 1500px; height: 700px"></div>
<?php endif; ?> 

<?php if (count($cosPoints2) >= 18 and count($cosPoints2) <=25) : ?>
<div id="chart2" style="width: 1500px; height: 800px"></div>
<?php endif; ?> 

<?php if (count($cosPoints2) >= 26 and count($cosPoints2) <=38) : ?>
<div id="chart2" style="width: 1800px; height: 1100px"></div>
<?php endif; ?> 

<?php if (count($cosPoints2) >= 39) : ?>
<div id="chart2" style="width: 1800px; height: 1800px"></div>
<?php endif; ?>
<!--<div id="chart2" style="width: 1400px; height: 3000px"></div>-->
</h2>   
<?php endif; ?> 
      
      
    <?php if ($value == 3) : ?>
        <h2 class="form-signin-heading rwd">
<script>
  $(document).ready(function () {
    crearGrafica3(<?php echo json_encode($cosPoints3) ?>);  
  });
</script>
 <?php if (count($cosPoints3) >= 0 and count($cosPoints3) <=8) : ?>
<div id="chart4" style="width: 800px; height: 500px"></div>
<?php endif; ?>  

<?php if (count($cosPoints3) >= 9 and count($cosPoints3) <=17) : ?>
<div id="chart4" style="width: 1500px; height: 700px"></div>
<?php endif; ?> 

<?php if (count($cosPoints3) >= 18 and count($cosPoints3) <=25) : ?>
<div id="chart4" style="width: 1500px; height: 800px"></div>
<?php endif; ?> 

<?php if (count($cosPoints3) >= 26 and count($cosPoints3) <=38) : ?>
<div id="chart4" style="width: 1800px; height: 1100px"></div>
<?php endif; ?> 

<?php if (count($cosPoints3) >= 39) : ?>
<div id="chart4" style="width: 1800px; height: 1800px"></div>
<?php endif; ?>

</h2>   
     <?php endif; ?> 
      
      
      <?php if ($value == 4) : ?>
        <h2 class="form-signin-heading rwd">
<script>
  $(document).ready(function () {
    crearGrafica4(<?php echo json_encode($cosPoints) ?>, <?php echo json_encode($sinPoints) ?>); 
  });
</script>


<div id="chart5" style="width: 1050px; height: 400px"></div>

</h2> 
      <br><br><br>
      <h2 class="form-signin-heading rwd">
<script>
  $(document).ready(function () {
    crearGrafica5(<?php echo json_encode($pago1) ?>, <?php echo json_encode($pago2) ?>); 
  });
</script>
<div id="chart6" style="width: 1050px; height: 400px"></div>
 </h2>
      
   <br><br><br>
      <h2 class="form-signin-heading rwd">
<script>
  $(document).ready(function () {
    crearGrafica6(<?php echo json_encode($produccion1) ?>, <?php echo json_encode($produccion2) ?>); 
  });
</script>
<div id="chart7" style="width: 1050px; height: 400px"></div>
 </h2>    
     <?php endif; ?> 
      
      
     <?php if ($value == 5) : ?>
        
    <?php endif; ?>   
      
      <br>
 <a class="btn btn-lg btn-success btn-xs" target="_blank" href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'report') ?>" ><?php echo i18n::__('importar pdf') ?></a>
     <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'index') ?>" ><?php echo i18n::__('atras') ?></a>
       
 <br><br> <br><br>
       </div>    
  </div>    
</div>