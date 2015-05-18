<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $cantidad = manoObraTableClass::CANTIDAD_HORA ?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
    <h2 class="form-signin-heading"> <?php echo i18n::__('editarMano') ?> </h2>
     </article>
<?php view::includePartial('manoObra/formularioPrincipal', array('objManoObra'=>$objManoObra, 'cantidad'=>$cantidad, 'objCooperativa'=>$objCooperativa, 'objLabor'=>$objLabor, 'objMaquina'=>$objMaquina)) ?>
</div>