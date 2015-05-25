<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = cooperativaTableClass::ID ?>
<?php $nombre = cooperativaTableClass::NOMBRE ?>
<?php $descripcion = cooperativaTableClass::DESCRIPCION ?>
<?php $direccion = cooperativaTableClass::DIRECCION ?>
<?php $telefono = cooperativaTableClass::TELEFONO ?>
<?php $nombre_ciudad = cooperativaTableClass::ID_CIUDAD ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">

   
  </header>
  <nav id="">
  </nav>
  <section id="contenido">
  </section>
    <article id='derecha'>
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cooperativa', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
      <br>
      <br>
      
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objCooperativa as $key): ?>
            <tr>
              <th><?php echo i18n::__('nom') ?></th>      
              <td><?php echo $key->$nombre ?></td>
            </tr>
            <tr>
          <th><?php echo i18n::__('des') ?></th>      
          <td><?php echo $key->$descripcion ?></td>
          </tr>
           <tr>
          <th><?php echo i18n::__('dir') ?></th>      
          <td><?php echo $key->$direccion ?></td>
          </tr>
          <tr>
          <th><?php echo i18n::__('tel') ?></th>      
          <td><?php echo $key->$telefono ?></td>
          </tr>
          <tr>
          


        <?php endforeach; ?>

<?php foreach ($objCooperativa as $ciudad): ?>
          <tr>
          <th><?php echo i18n::__('ciudad') ?></th>      
          <td><?php echo ciudadTableClass::getNameCiudad($ciudad->$nombre_ciudad) ?></td>
          </tr>
<?php endforeach; ?>


        </tbody>
      </table>

    </article>
 
</div>
