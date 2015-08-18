<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = maquinaTableClass::ID ?>
<?php $nombre = maquinaTableClass::NOMBRE ?>
<?php $descripcion = maquinaTableClass::DESCRIPCION ?>
<?php $created_at = maquinaTableClass::CREATED_AT ?>
<?php $updated_at = maquinaTableClass::UPDATED_AT ?>
<?php $des_origen = maquinaTableClass::ORIGEN_MAQUINA ?>
<?php $descripcion_uso = maquinaTableClass::TIPO_USO_ID ?>
<?php $nombre_pro = maquinaTableClass::PROVEEDOR_ID ?>

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
        <a class="btn btn-success btn-xs " href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexMaquina') ?>" > <?php echo i18n::__('atras') ?></a>
        <br><br>
        <div class="rwd">
          <table class="table table-bordered table-responsive rwd_auto">
            <tr>
            <thead>
            <th colspan="2"> <?php echo i18n::__('datos') ?></th>
            </thead>
            </tr>
            <tbody>
              <?php foreach ($objMaquina as $key): ?>
                <tr>
                  <td><?php echo i18n::__('nom') ?></td>      
                  <td><?php echo $key->$nombre ?></td>
                </tr>

                <tr>
                  <td><?php echo i18n::__('des') ?></td>      
                  <td><?php echo $key->$descripcion ?></td>
                </tr>

                <tr>
                  <td><?php echo i18n::__('origenM') ?></td>      
                  <td><?php echo $key->$des_origen ?></td>
                </tr>
                <tr>
                  <td><?php echo i18n::__('tipo uso') ?></td>                   
                  <td><?php echo tipoUsoMaquinaTableClass::getNameTipoUsoMaquina($key->$descripcion_uso) ?></td>
                </tr>
                <tr>
                  <td><?php echo i18n::__('nomProveedor') ?></td>      
                  <td><?php echo proveedorTableClass::getNameProveedor($key->$nombre_pro) ?></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </article>

    </div>
    <br><br><br><br><br><br><br><br><br>
  </div>

</div>
