<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $idFactura = facturaCompraTableClass::ID?>
<div class="container container-fluid" id="cuerpo">
    <article id="derecha">
  <h2 class="form-signin-heading">
  </h2>
        </article>
   <?php view::includePartial('facturaCompra/formularioPrincipal', array('objFactura' => $objFactura, 'idFactura' => $idFactura)) ?>
</div>
  