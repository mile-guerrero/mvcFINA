<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $id = tipoIdTableClass::ID ?>
<?php $des = tipoIdTableClass::DESCRIPCION ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
   
    </header>
	<nav id="">
	 
</nav>
    <section id="">
      
      </section>
    <article id='derecha'>
 <h1><?php echo i18n::__('tipo id') ?></h1>
      <ul>
      
    <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'insertTipoId') ?>"><?php echo i18n::__('nuevo') ?></a>              
     </ul>
        <table class="table table-bordered table-responsive">
          <tr>
            <thead>
              
              <th>
                <?php echo i18n::__('des') ?>
              </th>
             
              <th>
               <?php echo i18n::__('acciones') ?>
              </th>
              
    </tr>
    </thead>
	<tbody>
              <?php foreach ($objTI as $key): ?>
                <tr>
                  <td>
                    <?php echo $key->$des ?>
                  </td>
                  <th>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'verTipoId', array(tipoIdTableClass::ID =>$key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> - 
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('cliente', 'editTipoId', array(tipoIdTableClass::ID=>$key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a>
                  </th>
                </tr>                                        
                                                        
                <?php endforeach; ?>
           </tbody>
	    </table>
      <div class="text-right">
        Pagina <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('cliente', 'indexTipoId')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      </article>
    
     
</div>
	 



