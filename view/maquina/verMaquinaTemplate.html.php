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
<?php $des_origen = maquinaTableClass::ORIGEN_ID ?>
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
      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>" > <?php echo i18n::__('atras') ?></a>
 
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
        <th colspan="2"> <?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objMaquina as $key): ?>
            <tr>
              <th>Nombre</th>      
              <th><?php echo $key->$nombre ?></th>
            </tr>

            <tr>
              <th>Descripcion</th>      
              <th><?php echo $key->$descripcion ?></th>
            </tr>
                         
          <th>fecha creacion</th>                   
          <th><?php echo $key->$created_at ?></th>
          </tr>
          <tr>
            <th>fecha modificacion</th> 
            <th><?php echo $key->$updated_at ?></th>
          </tr>

<?php endforeach; ?>
          
          <?php foreach ($objMaquina as $TUM): ?>          
          <tr>
            <th>Tipo Uso Maquina</th>                   
            <th><?php echo tipoUsoMaquinaTableClass::getNameTipoUsoMaquina($TUM->$descripcion_uso) ?></th>
          </tr>
        <?php endforeach; ?>


<?php foreach ($objMaquina as $OM): ?>
          <tr>
          <th>origen maquina</th>      
          <th><?php echo origenMaquinaTableClass::getNameOrigenMaquina($OM->$des_origen) ?></th>
          </tr>
<?php endforeach; ?>
          <?php foreach ($objMaquina as $P): ?>
          <tr>
          <th>proveedor</th>      
          <th><?php echo proveedorTableClass::getNameProveedor($P->$nombre_pro) ?></th>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>

    </article>

</div>
