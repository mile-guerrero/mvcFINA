<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
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
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexCliente') ?>" > <?php echo i18n::__('atras') ?></a>
      <br>
      <br>
      
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objCliente as $key): ?>
            <tr>
              <th><?php echo i18n::__('nom') ?></th>      
              <td><?php echo $key->$nom ?></td>
            </tr>
            <tr>
          <th><?php echo i18n::__('apell') ?></th>      
          <td><?php echo $key->$apellido ?></td>
          </tr>
           <tr>
          <th><?php echo i18n::__('documento') ?></th>      
          <td><?php echo $key->$documento ?></td>
          </tr>
          <tr>
          <th><?php echo i18n::__('dir') ?></th>      
          <td><?php echo $key->$direccion ?></td>
          </tr>
          <tr>
          <th><?php echo i18n::__('tel') ?></th>      
          <td><?php echo $key->$telefono ?></td>
          </tr>
<!--          <tr>
            <th>fecha modificacion</th> 
            <th><?php echo $key->$updated_at ?></th>
          </tr> 
          <tr>
            <th>fecha creacion</th>                   
            <th><?php echo $key->$created_at ?></th>
          </tr>-->

        <?php endforeach; ?>

<?php foreach ($objCliente as $tipoId): ?>          
          <tr>
            <th><?php echo i18n::__('tipo id') ?></th>                   
            <td><?php echo tipoIdTableClass::getNameTipoId($tipoId->$descripcion) ?></td>
          </tr>
        <?php endforeach; ?>


<?php foreach ($objCliente as $ciudad): ?>
          <tr>
          <th><?php echo i18n::__('ciudad') ?></th>      
          <td><?php echo ciudadTableClass::getNameCiudad($ciudad->$nombre_ciudad) ?></td>
          </tr>
<?php endforeach; ?>


        </tbody>
      </table>

    </article>
 
</div>
    <br><br>
</div>
  
 </div>
