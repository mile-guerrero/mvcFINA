<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = origenMaquinaTableClass::ID ?>
<?php $descripcion = origenMaquinaTableClass::DESCRIPCION ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
    
  </header>
  <nav id="">
     
  </nav>
  <section id="">
    
     </section>
   <article id='derecha'> 
     <h1><?php echo i18n::__('origen') ?></h1>
     <ul>

      <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'insertOrigenMaquina') ?>"><?php echo i18n::__('nuevo') ?></a>              
    </ul>
      <table class="table table-bordered table-responsive">
        <tr>
        <thead>
          
        <th>
           <?php echo i18n::__('des') ?>
        </th>  
        <th>
            <?php echo i18n::__('aciones') ?>
          </th>
        </tr>
        </thead>
        <tbody>
              <?php foreach ($objOM as $key): ?>
            <tr>
              <th>
              <?php echo $key->$descripcion ?>
              </th>
              <th>
              <a class="btn btn-danger btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'verOrigenMaquina', array(origenMaquinaTableClass::ID => $key->$id)) ?>" > <?php echo i18n::__('ver') ?></a>
              </th>
            </tr>
                <?php endforeach; ?>
        </tbody>
      </table>
      <div class="text-right">
        Pagina <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexOrigenMaquina')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
    </article>
 
</div>




