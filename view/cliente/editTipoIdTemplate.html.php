<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $descripcion = tipoIdTableClass::DESCRIPCION ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
    <h2 class="form-signin-heading">
      EDITAR TIPO ID <?php echo $objTI[0]->$descripcion ?>
    </h2>
  </article>
<?php view::includePartial('cliente/formularioPrincipalTipoId',array('objTI'=>$objTI, 'descripcion'=>$descripcion)) ?>
</div>