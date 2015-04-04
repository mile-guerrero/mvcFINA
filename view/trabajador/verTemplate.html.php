<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = trabajadorTableClass::ID ?>
<?php $nom = trabajadorTableClass::NOMBRET ?>
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
  <header id="">
  </header>

  <nav id="">
  </nav>
  <section id="contenido">

  </section>

  <article id='derecha'>    
    <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
<br>
    <table class="table table-bordered table-responsive">
      <tr>
      <thead>
      <th colspan="2"> <?php echo i18n::__('datos') ?></th>
      </thead>
      </tr>
      <tbody>
<?php foreach ($objTrabajador as $key): ?>
          <tr>
            <th>Nombre</th>      
            <td><?php echo $key->$nom ?></td>
          </tr>
          <tr>
            <th>Apellido</th>      
            <td><?php echo $key->$apellido ?></td>
          </tr>
          <tr>
            <th>direccion</th>      
            <td><?php echo $key->$direccion ?></td>
          </tr>
          <tr>
            <th>Telefono</th>      
            <td><?php echo $key->$telefono ?></td>
          </tr>
          <tr>
            <th>Email</th>      
            <td><?php echo $key->$email ?></td>
          </tr>
          <tr>
            <th>fecha modificacion</th> 
            <td><?php echo $key->$updated_at ?></td>
          </tr> 
          <tr>
            <th>fecha creacion</th>                   
            <td><?php echo $key->$created_at ?></td>
          </tr>

<?php endforeach; ?>

<?php foreach ($objTrabajador as $tipoId): ?>          
          <tr>
            <th>Tipo Identidad</th>                   
            <td><?php echo tipoIdTableClass::getNameTipoId($tipoId->$descripcion) ?></td>
          </tr>
        <?php endforeach; ?>


<?php foreach ($objTrabajador as $ciudad): ?>
          <tr>
            <th>Ciudad</th>      
            <td><?php echo ciudadTableClass::getNameCiudad($ciudad->$nombreCiudad) ?></td>
          </tr>
<?php endforeach; ?>

<?php foreach ($objTrabajador as $credencial): ?>
          <tr>
            <th>Credencial</th>      
            <td><?php echo credencialTableClass::getNameCredencial($credencial->$nombreCredencial) ?></td>
          </tr>
<?php endforeach; ?>


      </tbody>
    </table>

  </article>
</div>
