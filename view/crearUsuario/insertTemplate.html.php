<?php mvc\view\viewClass::includePartial('crearUsuario/menuPrincipalCrear') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo2">
    
      <h2 class="form-signin-heading"><?php echo i18n::__('nuevo usuario') ?> </h2>
      <br><br>
   
  </div>
<?php view::includePartial('crearUsuario/formularioPrincipal') ?>
</div>