<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = solicitudInsumoTableClass::ID ?>
<?php $nombreT = solicitudInsumoTableClass::TRABAJADOR_ID ?>
<?php $fecha = solicitudInsumoTableClass::FECHA_HORA ?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
  <header id="">
    <h1><?php echo i18n::__('solicitudInsumo') ?></h1>
  </header>
  <nav id="">
    <ul>

      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'insert') ?>"><?php echo i18n::__('nuevo') ?></a>              
    </ul> 
  </nav>
  <section id="">
    

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
<?php foreach ($objS as $key): ?>
          <tr>
            
            <td>
  <?php echo $key->$fecha_mantenimiento ?>
            </td>
         
              <td>
  <?php echo trabajadorTableClass::getNameTrabajador($key->$nombreT) ?> 
              </td> 
              <th>
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'ver', array(solicitudInsumoTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> - 
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'edit', array(solicitudInsumoTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a>
              </th>
<?php endforeach; ?>   
        </tbody>
      </table>
      
    </section>
    </article>
</div>

