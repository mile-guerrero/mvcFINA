<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
  <?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
  <?php $des = tipoProductoInsumoTableClass::DESCRIPCION ?>
  <?php $id = tipoProductoInsumoTableClass::ID ?>
<?php $created_at = tipoProductoInsumoTableClass::CREATED_AT ?>
<?php $updated_at = tipoProductoInsumoTableClass::UPDATED_AT ?>

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
       <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('productoInsumo', 'indexTipoProductoInsumo') ?>" > <?php echo i18n::__('atras') ?></a>
       <br>
       <br>
      
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
          <tr>
            <thead>
            <th colspan="2"><?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
              <?php foreach ($objTPI as $key): ?>
                <tr>
                  <td><?php echo i18n::__('des') ?></td>      
                  <td><?php echo $key->$des ?></td>
                  </tr>
                                                
                <?php endforeach; ?>
           </tbody>
	    </table>
      </div>
	  </article>
   
</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div> 