<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idEmpresa = pagoTrabajadorTableClass::EMPRESA_ID?>
<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $created_at = pagoTrabajadorTableClass::CREATED_AT ?>
<?php $updated_at = pagoTrabajadorTableClass::UPDATED_AT ?>
<?php $id = pagoTrabajadorTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
   
  </header>
  <nav id="">
  </nav>
  <section id="contenido">
  </section>
    <article id='derecha'>
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" > <?php echo i18n::__('atras') ?></a>

      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objPT as $key): ?>
            <tr> 
              <th>fecha creacion</th>                   
              <td><?php echo $key->$created_at ?></td>
            </tr>
            <tr>
              <th>fecha modificacion</th> 
              <td><?php echo $key->$updated_at ?></td>
            </tr>

<?php endforeach; ?>
            
<?php foreach ($objPT as $empresa): ?>
          <tr>
          <th>Empresa</th>      
          <td><?php echo empresaTableClass::getNameEmpresa($empresa->$idEmpresa) ?></td>
          </tr>
          
<?php endforeach; ?>
        </tbody>
      </table>
    </article>
  
</div>

