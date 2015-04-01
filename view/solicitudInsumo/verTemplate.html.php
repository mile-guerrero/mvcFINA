<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = solicitudInsumoTableClass::ID ?>
<?php $fecha_mantenimiento = solicitudInsumoTableClass::FECHA_HORA ?>
<?php $created_at = solicitudInsumoTableClass::CREATED_AT ?>
<?php $updated_at = solicitudInsumoTableClass::UPDATED_AT ?>
<?php $nombret = trabajadorTableClass::NOMBRET ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">

    <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('solicitudInsumo', 'index') ?>" > <?php echo i18n::__('atras') ?></a>

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
<?php foreach ($objS as $key): ?>
            <tr>
              <th>Fecha Hora</th>      
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
<?php foreach ($objST as $tra): ?>
          <tr>
          <th>nombre</th>      
          <th><?php echo $tra->$nombret ?></th>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>

    </article>
  </section>
</div>
