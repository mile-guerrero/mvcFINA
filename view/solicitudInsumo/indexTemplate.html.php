<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = ordenServicioTableClass::ID ?>
<?php $nombreT = trabajadorTableClass::NOMBRET ?>
<?php $fecha_mantenimiento = ordenServicioTableClass::FECHA_MANTENIMIENTO ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
    <h1><?php echo i18n::__('orden') ?></h1>
  </header>
  <nav id="">
    <ul>

      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'insert') ?>"><?php echo i18n::__('nuevo') ?></a>              
    </ul> 
  </nav>
  <section id="">
    <article id=''>

      <table class="table table-bordered table-responsive">
        <tr>
        <thead>

        <th>
          <?php echo i18n::__('fechaMantenimiento') ?>
        </th>
        <th>
          <?php echo i18n::__('nombreTrabajador') ?>
        </th>
        <th>
<?php echo i18n::__('acciones') ?>
        </th>              
        </tr>
        </thead>
        <tbody>
<?php foreach ($objOS as $key): ?>
            <tr>
              <th>
  <?php echo $key->$fecha_mantenimiento ?>
              </th>
<?php endforeach; ?> 

<?php foreach ($objOST as $tra): ?> 
              <th>
  <?php echo $tra->$nombreT ?>
              </th> 
              <th>
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'ver', array(ordenServicioTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> - 
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenServicio', 'edit', array(ordenServicioTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a>
              </th>
<?php endforeach; ?>     


        </tbody>
      </table>
      
    </article>
  </section>
</div>

