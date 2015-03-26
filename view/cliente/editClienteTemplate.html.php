<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = clienteTableClass::NOMBRE ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <h2 class="form-signin-heading">
      <?php echo i18n::__('editar cliente') ?> <?php echo $objCliente[0]->$nombre ?> 
    </h2>
  </article>
<?php view::includePartial('cliente/formularioPrincipalCliente', array('objCliente' => $objCliente, 'nombre' => $nombre,'objCTI' => $objCTI,'objCC' => $objCC)) ?>

  
</div>