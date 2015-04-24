<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = ordenServicioTableClass::ID ?>
<?php $nombreT = ordenServicioTableClass::TRABAJADOR_ID ?>
<?php $fecha_mantenimiento = ordenServicioTableClass::FECHA_MANTENIMIENTO ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
    
  </header>
  <nav id="">
    
     
  </nav>
  <section id=""></section>
    
    <article id='derecha'>
<h1><?php echo i18n::__('orden') ?></h1>
    <ul>

      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'insert') ?>"><?php echo i18n::__('nuevo') ?></a>              
    </ul>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>

        <th>
          <?php echo i18n::__('nombreTrabajador') ?>
        </th>
        <th id="acciones">
<?php echo i18n::__('acciones') ?>
        </th>              
        
        </thead>
        <tbody>
<?php foreach ($objOS as $key): ?>
          <tr>
           <td>
  <?php echo trabajadorTableClass::getNameTrabajador($key->$nombreT) ?> 
              </td> 
              <th>
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'ver', array(ordenServicioTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> - 
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'edit', array(ordenServicioTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a>
              </th>
<?php endforeach; ?>   
        </tbody>
      </table>
      
    </article>
  
</div>

