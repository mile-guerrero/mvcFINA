<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
  <?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
  <?php $des = tipoProductoInsumoTableClass::DESCRIPCION ?>
  <?php $id = tipoProductoInsumoTableClass::ID ?>
<?php $created_at = tipoProductoInsumoTableClass::CREATED_AT ?>
<?php $updated_at = tipoProductoInsumoTableClass::UPDATED_AT ?>

<div class="container container-fluid" id="cuerpo">
  <header id="">
   
    </header>
	<nav id="">
</nav>
    <section id="contenido">
    </section>
    <article id='derecha'>
       <a class="btn btn-danger btn-xs yo" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo') ?>" > <?php echo i18n::__('atras') ?></a>

      
      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            <th colspan="2"><?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
              <?php foreach ($objTPI as $key): ?>
                <tr>
                  <th><?php echo i18n::__('des') ?></th>      
                  <td><?php echo $key->$des ?></td>
                  </tr>
                                                
                <?php endforeach; ?>
           </tbody>
	    </table>

	  </article>
   
</div>
