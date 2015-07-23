<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
  <?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $tipo = ProductoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID ?>
<?php $unidad = productoInsumoTableClass::UNIDAD_MEDIDA_ID ?>
<?php $iva = productoInsumoTableClass::IVA ?>
<?php $des = productoInsumoTableClass::DESCRIPCION ?>
<?php $id = productoInsumoTableClass::ID ?>
<?php $updated = productoInsumoTableClass::UPDATED_AT ?>
<?php $created = productoInsumoTableClass::CREATED_AT ?>
<?php $hash = productoInsumoTableClass::HASH_IMAGEN ?>
<?php $extencion = productoInsumoTableClass::EXTENCION_IMAGEN ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
   
    </header>
	<nav id="">
</nav>
    <section id="contenido">
      
    </section>
    <article id='derecha'>
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexProductoInsumo') ?>" > <?php echo i18n::__('atras') ?></a>
       <br>
       <br>
       
      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            <th colspan="2"> <?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
     
              <?php foreach ($objPI as $key): ?>
                <tr>    
                  <th><?php echo $key->$des ?></th>
                 <td>
                   <?php
              if($key->$extencion == 'jpg'){//para poner icono 
           echo '<img id="margenImagen" src="' . routing::getInstance()->getUrlImg('../imgInsumo/' . $key->$hash) . '"/>' ;          
                   }
                   ?></td>
                  </tr>
                   <tr>
                  <th><?php echo i18n::__('iva') ?></th>      
                  <td><?php echo $key->$iva ?></td>
                  </tr>
                  <?php endforeach; ?>
                  <?php foreach ($objPI as $key): ?>
                  <tr> 
                   <th><?php echo i18n::__('unidad') ?></th>                   
                   <td><?php echo unidadMedidaTableClass::getNameUnidadMedida($key->$unidad) ?></td>
                       </tr>
                  
                       <tr>
                       <th><?php echo i18n::__('tipoProducto') ?></th> 
                       <td><?php echo tipoProductoInsumoTableClass::getNameTipoProductoInsumo($key->$tipo) ?></td>
                        </tr>    
                                              
                <?php endforeach; ?>
           </tbody>
	    </table>

	  </article>
    
</div>
