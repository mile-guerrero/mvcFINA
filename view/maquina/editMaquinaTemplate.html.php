<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?> 
<?php $nombre = maquinaTableClass::NOMBRE ?>
<div class="container container-fluid" id="cuerpo">
   <article id='derecha'>
    <h2 class="form-signin-heading">
 <?php echo i18n::__('editar maquina') ?>  <?php echo $objMaquina[0]->$nombre ?> </h2>
   </article>
   <?php view::includePartial('maquina/formularioPrincipalMaquina',array('objMaquina'=>$objMaquina, 'nombre'=>$nombre,'objMTUM' => $objMTUM,'objMP' => $objMP)) ?>
</div>