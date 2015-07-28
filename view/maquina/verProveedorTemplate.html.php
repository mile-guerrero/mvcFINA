<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = proveedorTableClass::ID ?>
<?php $nom = proveedorTableClass::NOMBREP ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $documento = proveedorTableClass::DOCUMENTO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
<?php $email = proveedorTableClass::EMAIL ?>
<?php $updated_at = proveedorTableClass::UPDATED_AT ?>
<?php $created_at = proveedorTableClass::CREATED_AT ?>
<?php $nombre_ciudad = proveedorTableClass::ID_CIUDAD ?>

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
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>" > <?php echo i18n::__('atras') ?></a>
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
<?php foreach ($objProveedor as $key): ?>
            <tr>
          <td><?php echo i18n::__('documento') ?></td>      
          <td><?php echo $key->$documento ?></td>
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
          <td><?php echo $key->$direccion . ' ' . ciudadTableClass::getNameCiudad($key->$nombre_ciudad) ?></td>
          </tr>
          <tr>
          <td><?php echo i18n::__('tel') ?></td>      
          <td><?php echo $key->$telefono ?></td>
          </tr>
          <tr>
           <td><?php echo i18n::__('email') ?></td>                   
            <td><?php echo $key->$email ?></td>
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