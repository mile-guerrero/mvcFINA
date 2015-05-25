<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = empresaTableClass::ID ?>
<?php $nombre = empresaTableClass::NOMBRE ?>
<?php $direccion = empresaTableClass::DIRECCION ?>
<?php $telefono = empresaTableClass::TELEFONO ?>
<?php $email = empresaTableClass::EMAIL ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">

   
  </header>
  <nav id="">
  </nav>
  <section id="contenido">
  </section>
    <article id='derecha'>
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('empresa', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
      <br>
      <br>
      
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objEmpresa as $key): ?>
            <tr>
              <th><?php echo i18n::__('nom') ?></th>      
              <td><?php echo $key->$nombre ?></td>
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
            <th><?php echo i18n::__('email') ?></th>      
          <td><?php echo $key->$email ?></td>
          </tr>
          <tr>
          


        <?php endforeach; ?>


        </tbody>
      </table>

    </article>
 
</div>
