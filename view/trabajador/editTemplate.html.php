<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = trabajadorTableClass::NOMBRET ?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
    <h2 class="form-signin-heading">
      <?php echo i18n::__('editarTrabajador') ?> <?php echo $objTrabajador[0]->$nombre ?> 
    </h2>
    </article>
<?php view::includePartial('trabajador/formularioPrincipal', array('objTrabajador' => $objTrabajador, 'nombre' => $nombre, 'objCTI' => $objCTI, 'objCC' => $objCC, 'objCredencial' => $objCredencial)) ?>
</div>