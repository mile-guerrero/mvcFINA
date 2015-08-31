<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = clienteTableClass::ID ?>
<?php $nom = clienteTableClass::NOMBRE ?>
<?php $apellido = clienteTableClass::APELLIDO ?>
<?php $documento = clienteTableClass::DOCUMENTO ?>
<?php $direccion = clienteTableClass::DIRECCION ?>
<?php $telefono = clienteTableClass::TELEFONO ?>
<?php $updated_at = clienteTableClass::UPDATED_AT ?>
<?php $created_at = clienteTableClass::CREATED_AT ?>
<?php $descripcion = clienteTableClass::ID_TIPO_ID ?>
<?php $nombre_ciudad = clienteTableClass::ID_CIUDAD ?>

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
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexCliente') ?>" > <?php echo i18n::__('atras') ?></a>
      <br>
      <br>
      
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objCliente as $key): ?>
            <tr>
              <td><?php echo i18n::__('nom') ?></td>      
              <td><?php echo $key->$nom ?></td>
            </tr>
            <tr>
          <td><?php echo i18n::__('apell') ?></td>      
          <td><?php echo $key->$apellido ?></td>
          </tr>
           <tr>
          <td><?php echo i18n::__('documento') ?></td>      
          <td><?php echo $key->$documento. ' ' .tipoIdTableClass::getNameTipoId($key->$descripcion) ?></td>
          </tr>
          <tr>
          <td><?php echo i18n::__('dir') ?></td>      
          <td><?php echo $key->$direccion . ' ' . ciudadTableClass::getNameCiudad($key->$nombre_ciudad)?></td>
          </tr>
          <tr>
          <td><?php echo i18n::__('tel') ?></td>      
          <td><?php echo $key->$telefono ?></td>
          </tr>

        <?php endforeach; ?>

        </tbody>
      </table>
      </div>
    </article>
 
</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div>
