<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
  <?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
  <?php $usu = usuarioTableClass::USUARIO ?>
 <?php $actived = usuarioTableClass::ACTIVED ?>
 <?php $created_at = usuarioTableClass::CREATED_AT ?>
 <?php $updated_at = usuarioTableClass::UPDATED_AT ?>
  <?php $id = usuarioTableClass::ID ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo6">
  <div class="center-block" id="cuerpo2">
  <header id="">
    
    </header>
	<nav id="">
      
</nav>
    <section id="contenido">
      
       </section>
    <article id='derecha'>
      <br><br>
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>" ><?php echo i18n::__('atras') ?></a>   
   <br><br>
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
                  <th><?php echo i18n::__('user') ?></th>      
                  <td><?php echo $key->$usu ?></td>
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
                       <th><?php echo i18n::__('estado') ?></th>
                       <td><?php echo $key->$actived ?></td>
                       </tr>                         
                <?php endforeach; ?>
           </tbody>
	    </table>
      </article>
   
</div>
	  <br><br><br><br>
</div>
  
 </div>
