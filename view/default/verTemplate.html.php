<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
  <?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
  <?php $usu = usuarioTableClass::USUARIO ?>
 <?php $actived = usuarioTableClass::ACTIVED ?>
 <?php $created_at = usuarioTableClass::CREATED_AT ?>
 <?php $updated_at = usuarioTableClass::UPDATED_AT ?>
  <?php $id = usuarioTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
    
    </header>
	<nav id="">
      
</nav>
    <section id="contenido">
      
       </section>
    <article id='derecha'>
      
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>" ><?php echo i18n::__('atras') ?></a>   
   
      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            
              <tr>
            <th colspan="2"><?php echo i18n::__('datos') ?></th>
              </tr>
              </tr>
    </thead>
    
	<tbody>
              <?php foreach ($objUsuarios as $key): ?>
                <tr>
                  <th>Usuario</th>      
                 <th><?php echo $key->$usu ?></th>
                  </tr>
                  <tr>
                   <th>fecha creacion</th>                   
                   <th><?php echo $key->$created_at ?></th>
                       </tr>
                       <tr>
                       <th>fecha modificacion</th> 
                       <th><?php echo $key->$updated_at ?></th>
                       </tr>
                       <tr>  
                       <th>Estado</th>
                     <th><?php echo $key->$actived ?></th>
                       </tr>                         
                <?php endforeach; ?>
           </tbody>
	    </table>
      </article>
   
</div>
	  
