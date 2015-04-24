<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = maquinaTableClass::ID ?>
<?php $nombre = maquinaTableClass::NOMBRE ?>
<?php $descripcion = maquinaTableClass::DESCRIPCION?>
<?php $created_at = maquinaTableClass::CREATED_AT ?>
<?php $updated_at = maquinaTableClass::UPDATED_AT ?>
<?php $des_origen = maquinaTableClass::ORIGEN_MAQUINA ?>
<?php $descripcion_uso = maquinaTableClass::TIPO_USO_ID ?>
<?php $nombre_pro = maquinaTableClass::PROVEEDOR_ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
     </header>
  <nav id="">
  </nav>
  <section id="contenido">
    
  </section>
    <article id='derecha'>
      <a class="btn btn-danger btn-xs yo" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>" > <?php echo i18n::__('atras') ?></a>
      <br><br>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <td colspan="2"> <?php echo i18n::__('datos') ?></td>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objMaquina as $key): ?>
            <tr>
              <th><?php echo i18n::__('nom') ?></th>      
              <td><?php echo $key->$nombre ?></td>
            </tr>

            <tr>
              <th><?php echo i18n::__('des') ?></th>      
              <td><?php echo $key->$descripcion ?></td>
            </tr>
            
            <tr>
              <th><?php echo i18n::__('origenM') ?></th>      
              <td><?php echo $key-> $des_origen?></td>
            </tr>
          

<?php endforeach; ?>
          
          <?php foreach ($objMaquina as $TUM): ?>          
          <tr>
            <th><?php echo i18n::__('tipo uso') ?></th>                   
            <td><?php echo tipoUsoMaquinaTableClass::getNameTipoUsoMaquina($TUM->$descripcion_uso) ?></td>
          </tr>
        <?php endforeach; ?>


          
          
          <?php foreach ($objMaquina as $P): ?>
          <tr>
          <th><?php echo i18n::__('nomProveedor') ?></th>      
          <td><?php echo proveedorTableClass::getNameProveedor($P->$nombre_pro) ?></td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>

    </article>

</div>
