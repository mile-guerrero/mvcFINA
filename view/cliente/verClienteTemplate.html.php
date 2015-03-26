<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = clienteTableClass::ID ?>
<?php $nom = clienteTableClass::NOMBRE ?>
<?php $apellido = clienteTableClass::APELLIDO ?>
<?php $direccion = clienteTableClass::DIRECCION ?>
<?php $telefono = clienteTableClass::TELEFONO ?>
<?php $updated_at = clienteTableClass::UPDATED_AT ?>
<?php $created_at = clienteTableClass::CREATED_AT ?>
<?php $descripcion = clienteTableClass::ID_TIPO_ID ?>
<?php $nombre_ciudad = clienteTableClass::ID_CIUDAD ?>
<div class="container container-fluid" id="cuerpo">
  <header id="encabezado">

   
  </header>
  <nav id="barramenu">
  </nav>
  <section id="contenido">
    
  </section>
    <article id='derecha'>
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexCliente') ?>" > <?php echo i18n::__('atras') ?></a>
 
      
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objCliente as $key): ?>
            <tr>
              <th>Nombre</th>      
              <th><?php echo $key->$nom ?></th>
            </tr>
          <th>Apellido</th>      
          <th><?php echo $key->$apellido ?></th>
          </tr>
          <th>direccion</th>      
          <th><?php echo $key->$direccion ?></th>
          </tr>
          <th>Telefono</th>      
          <th><?php echo $key->$telefono ?></th>
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

<?php foreach ($objCliente as $tipoId): ?>          
          <tr>
            <th>Tipo Identidad</th>                   
            <th><?php echo tipoIdTableClass::getNameTipoId($tipoId->$descripcion) ?></th>
          </tr>
        <?php endforeach; ?>


<?php foreach ($objCliente as $ciudad): ?>
          <tr>
          <th>Ciudad</th>      
          <th><?php echo ciudadTableClass::getNameCiudad($ciudad->$nombre_ciudad) ?></th>
          </tr>
<?php endforeach; ?>


        </tbody>
      </table>

    </article>
 
</div>
