<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = historialTableClass::ID ?>
<?php $insumo = historialTableClass::PRODUCTO_INSUMO_ID ?>
<?php $enfermedad = historialTableClass::ENFERMEDAD_ID ?>
<?php $desEnfermedad = enfermedadTableClass::DESCRIPCION ?>
<?php $createdAt = historialTableClass::CREATED_AT ?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo6">
  <div class="center-block" id="cuerpo2">
  <header id="">
   
    </header>
	<nav id="">
</nav>
    <section id="contenido">
      
       </section>
    <article id='derecha'>
       <br><br>
    <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('historial', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
    <br><br>
      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            <th colspan="2"> <?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
      <?php foreach ($objHistorial as $key): ?>
                  <tr> 
                   <th><?php echo i18n::__('fecha crear') ?></th>                   
                   <th><?php echo $key->$createdAt ?></th>
                  </tr>
                 
                <tr>
                  <th><?php echo i18n::__('insumo') ?></th>      
                  <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$insumo)?></td>
                  </tr>
                  
                  <tr>
                  <th><?php echo i18n::__('enfermedad') ?></th>      
                  <td><?php echo enfermedadTableClass::getNameEnfermedad($key->$enfermedad) ?></td>
                  </tr>                           
                
                                  
                  <tr>
                  <th><?php echo i18n::__('des') ?></th>      
                  <td><?php echo enfermedadTableClass::getNameDes($key->$enfermedad) ?></td>
                  </tr>  
                  
                  <tr>
                  <th><?php echo i18n::__('des') ?></th>      
                  <td><?php echo enfermedadTableClass::getNameTratamiento($key->$enfermedad) ?></td>
                  </tr>  
                <?php endforeach; ?>
                  
                  
           </tbody>
	    </table>
	  </article>
   
</div>
    <br><br>
</div>
  
 </div> 