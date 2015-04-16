<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = ordenServicioTableClass::ID ?>
<?php $fecha_mantenimiento = ordenServicioTableClass::FECHA_MANTENIMIENTO ?>
<?php $cantidad = ordenServicioTableClass::CANTIDAD ?>
<?php $valor = ordenServicioTableClass::VALOR ?>
<?php $created_at = ordenServicioTableClass::CREATED_AT ?>
<?php $updated_at = ordenServicioTableClass::UPDATED_AT ?>
<?php $nombret = trabajadorTableClass::NOMBRET ?>
<?php $pro = productoInsumoTableClass::DESCRIPCION ?>
<?php $maq = maquinaTableClass::NOMBRE ?>

<div class="container container-fluid" id="cuerpo">
  <header id="">

    <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'index') ?>" > <?php echo i18n::__('atras') ?></a>

  </header>
  <nav id="">
  </nav>
  <section id="">
    <article id=''>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
            <?php foreach ($objOST as $tra): ?>
          <tr>
          <th>nombre</th>      
          <th><?php echo $tra->$nombret ?></th>
          </tr>
<?php endforeach; ?>
<?php foreach ($objOS as $key): ?>
            <tr>
              <th>Fecha Mantenimiento</th>      
              <th><?php echo $key->$fecha_mantenimiento ?></th>
            </tr>
            
            <tr> 
              <th>fecha creacion</th>                   
              <th><?php echo $key->$created_at ?></th>
            </tr>
            <tr>
              <th>fecha modificacion</th> 
              <th><?php echo $key->$updated_at ?></th>
            </tr>                    
<?php endforeach; ?>
            <?php foreach ($objOS as $key): ?>
            <tr>
              <th>cantidad</th>      
              <th><?php echo $key->$cantidad ?></th>
            </tr>
            <tr>
              <th> valor</th>      
              <th><?php echo $key->$valor ?></th>
            </tr>
<?php endforeach; ?>
            
             <?php foreach ($objOSPI as $key): ?>
            <tr>
              <th>Insumo</th>      
              <th><?php echo $key->$pro ?></th>
            </tr>
            
<?php endforeach; ?>
            
   
             <?php foreach ($objOSM as $key): ?>
            <tr>
              <th>Maquina</th>      
              <th><?php echo $key->$maq ?></th>
            </tr>
            
<?php endforeach; ?>
            
        </tbody>
      </table>

    </article>
  </section>
</div>
