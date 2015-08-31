<?php mvc\view\viewClass::includePartial('default/menuPrincipal2') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $nom = credencialTableClass::NOMBRE ?>
<?php $created_at = credencialTableClass::CREATED_AT ?>
<?php $updated_at = credencialTableClass::UPDATED_AT ?>
<?php $id = credencialTableClass::ID ?>

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
       <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>" > <?php echo i18n::__('atras') ?></a>
<br><br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <tr>
        <thead>
        <th colspan="2"><?php echo i18n::__('datos') ?></th>
        </thead>
        </tr>
        <tbody>
<?php foreach ($objCredencial as $key): ?>
            <tr>
              <td><?php echo i18n::__('nom') ?></td>      
              <td><?php echo $key->$nom ?></td>
            </tr>
            
            <tr> 
              <td>fecha creacion</td>                   
              <td><?php echo $key->$created_at ?></td>
            </tr>
            <tr>
              <td>fecha modificacion</td> 
              <td><?php echo $key->$updated_at ?></td>
            </tr>

<?php endforeach; ?>
        </tbody>
      </table>
      </div>
    </article>
  
</div>
 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
  
 </div>

