<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = trabajadorTableClass::ID ?>
<?php $nom = trabajadorTableClass::NOMBRET ?>
<?php $documento = trabajadorTableClass::DOCUMENTO ?>
<?php $apellido = trabajadorTableClass::APELLIDO ?>
<?php $direccion = trabajadorTableClass::DIRECCION ?>
<?php $telefono = trabajadorTableClass::TELEFONO ?>
<?php $email = trabajadorTableClass::EMAIL ?>
<?php $updated_at = trabajadorTableClass::UPDATED_AT ?>
<?php $created_at = trabajadorTableClass::CREATED_AT ?>
<?php $descripcion = trabajadorTableClass::ID_TIPO_ID ?>
<?php $nombreCiudad = trabajadorTableClass::ID_CIUDAD ?>
<?php $nombreCredencial = trabajadorTableClass::ID_CREDENCIAL ?>

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
    <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
    <br><br>
    <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
      <tr>
      <thead>
      <th colspan="2"> <?php echo i18n::__('datos') ?></th>
      </thead>
      </tr>
      <tbody>
        <?php foreach ($objTrabajador as $key): ?>
          <tr>
            <td><?php echo i18n::__('documento') ?></td>      
            <td><?php echo $key->$documento . ' ' .  tipoIdTableClass::getNameTipoId($key->$descripcion) ?></td>
          </tr> 
          <tr>
            <td><?php echo i18n::__('nom') ?></td>      
            <td><?php echo $key->$nom ?></td>
          </tr>
          <tr>
            <td><?php echo i18n::__('apell') ?></td>      
            <td><?php echo $key->$apellido ?></td>
          </tr>
          <tr>
            <td><?php echo i18n::__('dir') ?></td>      
            <td><?php echo $key->$direccion ?></td>
          </tr>
          <?php foreach ($objTrabajador as $ciudad): ?>
          <tr>
            <td><?php echo i18n::__('ciudad') ?></td>      
            <td><?php echo ciudadTableClass::getNameCiudad($ciudad->$nombreCiudad) ?></td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <td><?php echo i18n::__('tel') ?></td>      
            <td><?php echo $key->$telefono ?></td>
          </tr>
          <tr>
            <td><?php echo i18n::__('email') ?></td>      
            <td><?php echo $key->$email ?></td>
          </tr>
          <tr>
            <td><?php echo i18n::__('credencial') ?></td>      
            <td><?php echo credencialTableClass::getNameCredencial($key->$nombreCredencial) ?></td>
          </tr>

        <?php endforeach; ?>

      </tbody>
    </table>
</div>
  </article>
</div>
    <br><br>
</div>
  
 </div>
