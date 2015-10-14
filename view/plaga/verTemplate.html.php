<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = plagaTableClass::ID ?>
<?php $nombre = plagaTableClass::NOMBRE ?>
<?php $descripcion = plagaTableClass::DESCRIPCION ?>
<?php $tratamiento = plagaTableClass::TRATAMIENTO ?>
<?php $updatedAt = plagaTableClass::UPDATED_AT ?>
<?php $createdAt = plagaTableClass::CREATED_AT ?>

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
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('plaga', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
      <br><br>
      
      <div class="rwd">
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objPlaga as $key): ?>
            <tr>
              <td><?php echo i18n::__('nom') ?></td>      
              <td><?php echo $key->$nombre ?></td>
            </tr>
            <tr>
          <td><?php echo i18n::__('des') ?></td>      
          <td><?php echo $key->$descripcion ?></td>
          </tr>
           <tr>
          <td><?php echo i18n::__('tratamiento') ?></td>      
          <td><?php echo $key->$tratamiento ?></td>
          </tr>
            

        <?php endforeach; ?>


        </tbody>
      </table>
      </div>
    </article>
 
</div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div> 