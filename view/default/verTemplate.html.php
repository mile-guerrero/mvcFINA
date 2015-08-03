<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
  <?php  use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
  <?php $usu = usuarioTableClass::USUARIO ?>
 <?php $actived = usuarioTableClass::ACTIVED ?>
 <?php $created_at = usuarioTableClass::CREATED_AT ?>
 <?php $updated_at = usuarioTableClass::UPDATED_AT ?>
  <?php $id = usuarioTableClass::ID ?>
<?php $hash = usuarioTableClass::HASH_IMAGEN ?>
<?php $extencion = usuarioTableClass::EXTENCION_IMAGEN ?>

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
       <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>" ><?php echo i18n::__('atras') ?></a>   
   <br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
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
               <td><?php echo $key->$usu ?></td>
    
                   <td>
                   <?php
              if($key->$extencion == 'jpg'){//para poner icono 
           echo '<img id="margenImagen" src="' . routing::getInstance()->getUrlImg('../imgUsuario/' . $key->$hash) . '"/>' ;          
                   }
                   ?>    
                  </td>
                  </tr>
                  <tr>
                   <td>fecha creacion</td>                   
                   <td><?php echo $key->$created_at ?></td>
                       </tr>
                       <tr>
                       <td>fecha modificacion</td> 
                       <td><?php echo $key->$updated_at ?></td>
                       </tr>
                       <tr>  
                       <td><?php echo i18n::__('estado') ?></td>
                       <td><?php echo $key->$actived ?></td>
                       </tr>                         
                <?php endforeach; ?>
           </tbody>
	    </table>
      </div>
      </article>
   
</div>
	  <br><br><br><br>
</div>
  
 </div>
