<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $fecha = facturaVentaTableClass::FECHA ?>
<?php $created_at = facturaVentaTableClass::CREATED_AT ?>
<?php $updated_at = facturaVentaTableClass::UPDATED_AT ?>
<?php $id = facturaVentaTableClass::ID ?>

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
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('facturaVenta', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
<br><br>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objFactura as $key): ?>
            <tr>
              <th>fecha</th> 
              <td><?php echo $key->$fecha ?></td>
            </tr>
            <tr> 
              <th>fecha creacion</th>                   
              <td><?php echo $key->$created_at ?></td>
            </tr>
            

<?php endforeach; ?>
        </tbody>
      </table>
    </article>
</div>

    <br><br><br><br><br><br>
</div>
  
 </div> 