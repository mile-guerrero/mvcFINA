<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = historialTableClass::ID ?>
<?php $insumo = historialTableClass::PRODUCTO_INSUMO_ID ?>
<?php $enfermedad = historialTableClass::ENFERMEDAD_ID ?>
<?php $lote = historialTableClass:: LOTE_ID ?>
<?php $plaga = historialTableClass:: PLAGA_ID ?>
<?php $createdAt = historialTableClass::CREATED_AT ?>
<?php $parrafo = '/\.([\n\r]|<\/p>)/' ?>
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
    <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('historial', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
    <br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
          <tr>
            <thead>
            <th colspan="2"> <?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
      <?php foreach ($objHistorial as $key): ?>
                  <tr>
                    <td><p><?php echo i18n::__('lote') ?></p></td>      
                  <td><?php echo loteTableClass::getNameLote($key->$lote) ?></td>
                  </tr>
                  
                  <tr>
                    <td><p><?php echo i18n::__('fecha riego') ?></p></td>      
                  <td><?php echo loteTableClass::getNameFechaRiego($key->$lote) ?></td>
                  </tr>
                 
                <tr>
                  <td><?php echo i18n::__('insumo') ?></td>      
                  <td><?php echo productoInsumoTableClass::getNameProductoInsumo($key->$insumo)?></td>
                  </tr>
                  
                  <tr>
                  <td><?php echo i18n::__('enfermedad') ?></td>      
                  <td><?php echo enfermedadTableClass::getNameEnfermedad($key->$enfermedad) ?></td>
                  </tr>                           
                
                                  
                  <tr>
                  <td><?php echo i18n::__('des') ?></td>      
                  <td><?php echo enfermedadTableClass::getNameDes($key->$enfermedad) ?></td>
                  </tr>  
                  
                  <tr>
                  <td><?php echo i18n::__('tratamiento') ?></td>      
                  <td><?php echo enfermedadTableClass::getNameTratamiento($key->$enfermedad) ?></td>
                  </tr>  
                  
                   <tr>
                  <td><?php echo i18n::__('plaga') ?></td>      
                  <td><?php echo plagaTableClass::getNamePlaga($key->$plaga) ?></td>
                  </tr>                           
                
                                  
                  <tr>
                  <td><?php echo i18n::__('des') ?></td>      
                  <td><?php echo plagaTableClass::getNameDes($key->$plaga) ?></td>
                  </tr>  
                  
                  <tr>
                  <td><?php echo i18n::__('tratamiento') ?></td>      
                  <td><?php echo plagaTableClass::getNameTratamiento($key->$plaga) ?></td>
                  </tr> 
                <?php endforeach; ?>
                  
                  
           </tbody>
	    </table>
      </div>
	  </article>
   
</div>
    <br><br>
</div>
  
 </div> 