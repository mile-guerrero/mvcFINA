<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = laborTableClass::ID ?>
<?php $descripcion = laborTableClass::DESCRIPCION ?>
<?php $valor = laborTableClass::VALOR ?>

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
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('labor', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
      <br><br>
      
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objLabor as $key): ?>
            <tr>
              <th><?php echo i18n::__('des') ?></th>      
              <td><?php echo $key->$descripcion ?></td>
            </tr>
            <tr>
          <th><?php echo i18n::__('valor') ?></th>      
          <td><?php echo $key->$valor ?></td>
          </tr>
          <tr>
          <tr>
          


        <?php endforeach; ?>


        </tbody>
      </table>

    </article>
 
</div>

    <br><br><br><br><br><br><br><br>
</div>
  
 </div> 