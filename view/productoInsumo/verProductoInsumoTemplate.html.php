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
<div class="container container-fluid" id="cuerpo">
  <header id="">
   
    </header>
	<nav id="">
</nav>
    <section id="contenido">
      
    </section>
    <article id='derecha'>
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexProductoInsumo') ?>" > <?php echo i18n::__('atras') ?></a>

      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            <th colspan="2"> <?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
              <?php foreach ($objPI as $key): ?>
                <tr>
                  <th><?php echo i18n::__('des') ?></th>      
                  <td><?php echo $key->$des ?></td>
                  </tr>
                  <tr>
                   <tr>
                  <th><?php echo i18n::__('iva') ?></th>      
                  <td><?php echo $key->$iva ?></td>
                  </tr>
                  </tr>
                  <th>fecha creacion</th> 
                       <th><?php echo $key->$created ?></th>
                       </tr>
                  <th>fecha modificacion</th> 
                       <th><?php echo $key->$updated ?></th>
                       </tr>
                  <?php endforeach; ?>
                  <?php foreach ($objPI as $key): ?>
                  <tr> 
                   <th><?php echo i18n::__('unidad') ?></th>                   
                   <td><?php echo unidadMedidaTableClass::getNameUnidadMedida($key->$unidad) ?></td>
                       </tr>
                    <?php endforeach; ?>
                       <?php foreach ($objPI as $key): ?>
                       <tr>
                       <th><?php echo i18n::__('tipoProducto') ?></th> 
                       <td><?php echo tipoProductoInsumoTableClass::getNameTipoProductoInsumo($key->$tipo) ?></td>
                            
                                              
                <?php endforeach; ?>
           </tbody>
	    </table>

	  </article>
    
</div>
