<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
  <?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
  <?php $id = tipoIdTableClass::ID ?>
  <?php $created = tipoIdTableClass::CREATED_AT ?>
  <?php $updated = tipoIdTableClass::UPDATED_AT ?>
  <?php $des = tipoIdTableClass::DESCRIPCION ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
     </header>
	<nav id="">
</nav>
    <section id="contenido">
    </section>
    <article id='derecha'>
       <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexTipoId') ?>" >Ir Paguina Anterior</a>
   
      <table class="table table-bordered table-responsive">
          <tr>
            <thead>
            <th colspan="2"><?php echo i18n::__('datos') ?></th>
    </thead>
    </tr>
	<tbody>
              <?php foreach ($objTI as $key): ?>
                <tr>
                  <th>Descripcion</th>      
                 <th><?php echo $key->$des ?></th>
                  </tr>
                 
                  <tr> 
                   <th>fecha creacion</th>                   
                   <th><?php echo $key->$created ?></th>
                       </tr>
                       <tr>
                       <th>fecha modificacion</th> 
                       <th><?php echo $key->$updated ?></th>
                       </tr>                    
                <?php endforeach; ?>
           </tbody>
	    </table>
      </article>
   
</div>
	  

