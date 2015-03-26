<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $trabajador = ordenServicioTableClass::TRABAJADOR_ID ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <h2 class="form-signin-heading"> <?php echo i18n::__('editar orden') ?> </h2>
<?php view::includePartial('ordenServicio/formularioPrincipal',array('objOS'=>$objOS, 'trabajador_id'=>$trabajador)) ?>
  </article>

</div>