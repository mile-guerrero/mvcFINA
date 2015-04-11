<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = proveedorTableClass::ID ?>
<?php $nom = proveedorTableClass::NOMBREP ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
<?php $email = proveedorTableClass::EMAIL ?>
<?php $updated_at = proveedorTableClass::UPDATED_AT ?>
<?php $created_at = proveedorTableClass::CREATED_AT ?>
<?php $nombre_ciudad = proveedorTableClass::ID_CIUDAD ?>
<div class="container container-fluid" id="cuerpo">
  <header id="encabezado">

   
  </header>
  <nav id="barramenu">
  </nav>
  <section id="contenido">
    
  </section>
    <article id='derecha'>
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>" > <?php echo i18n::__('atras') ?></a>
 
      
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objProveedor as $key): ?>
            <tr>
              <th><?php echo i18n::__('nom') ?></th>      
              <td><?php echo $key->$nom ?></td>
            </tr>
          <th><?php echo i18n::__('apell') ?></th>      
          <td><?php echo $key->$apellido ?></td>
          </tr>
          <th><?php echo i18n::__('dir') ?></th>      
          <td><?php echo $key->$direccion ?></td>
          </tr>
          <th><?php echo i18n::__('tel') ?></th>      
          <td><?php echo $key->$telefono ?></td>
          </tr>
          <tr>
            <th>email</th>                   
            <td><?php echo $key->$email ?></td>
          </tr>
          <tr>
            <th>fecha modificacion</th> 
            <th><?php echo $key->$updated_at ?></th>
          </tr> 
          <tr>
            <th>fecha creacion</th>                   
            <th><?php echo $key->$created_at ?></th>
          </tr>

        <?php endforeach; ?>


<?php foreach ($objProveedor as $ciudad): ?>
          <tr>
          <th><?php echo i18n::__('ciudad') ?></th>      
          <td><?php echo ciudadTableClass::getNameCiudad($ciudad->$nombre_ciudad) ?></td>
          </tr>
<?php endforeach; ?>


        </tbody>
      </table>

    </article>
 
</div>