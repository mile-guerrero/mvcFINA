<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = usuarioCredencialTableClass::ID ?>
<?php $usua = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $cred = usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $created_at = usuarioCredencialTableClass::CREATED_AT ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
   
    </header>
	<nav id="">
</nav>
    <section id="contenido">
      
       </section>
    <article id='derecha'>
       
    <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>" > <?php echo i18n::__('atras') ?></a>

      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            <th colspan="2"> <?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
      <?php foreach ($objUC as $key): ?>
                  <tr> 
                   <th><?php echo i18n::__('fecha crear') ?></th>                   
                   <th><?php echo $key->$created_at ?></th>
                  </tr>
                  <?php endforeach; ?>
              <?php foreach ($objUC as $ko): ?>
                <tr>
                  <th><?php echo i18n::__('user') ?></th>      
                  <td><?php echo usuarioTableClass::getNameUsuario($ko->$usua)?></td>
                  </tr>
                  <?php endforeach; ?>
                  
                  <?php foreach ($objUC as $key): ?>
                  <tr>
                  <th><?php echo i18n::__('credencial') ?></th>      
                  <td><?php echo credencialTableClass::getNameCredencial($key->$cred) ?></td>
                  </tr>                           
                <?php endforeach; ?>
                  
                  
           </tbody>
	    </table>
	  </article>
   
</div>