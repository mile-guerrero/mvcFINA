<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session?>

<?php $nombre = reporteTableClass::NOMBRE ?>
<?php $descripcion = reporteTableClass::DESCRIPCION ?>
<?php $id = reporteTableClass::ID ?>
<div class="container container-fluid" id="cuerpo">
   <div class="center-block" id="cuerpo4">
  <div class="center-block" id="cuerpo2">
  <header id="">
    
  </header>
  <nav id=""> 
   
  </nav>
  
    <article id='derecha'>
      
      <h1><?php echo i18n::__('reportes') ?></h1>
        
       <?php view::includeHandlerMessage()?>
    <br>
       <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">

          <tr>
          <thead>
         
          <th>
            <?php echo i18n::__('nom') ?>
          </th>
          <th>
            <?php echo i18n::__('des') ?>
          </th>
          <th id="acciones">
            <?php echo i18n::__('acciones') ?>
          </th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($objReportes as $key): ?>
              <tr>

                
                <td>
                  <?php echo $key->$nombre ?>
                </td>
                <td>
                  <?php echo $key->$descripcion ?>
                </td>
                <td>
                
                  <a class="btn btn-warning btn-xs" href="<?php  echo routing::getInstance()->getUrlWeb('reportes', 'insert', array(reporteTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> 
                </td>

              </tr>
                                        

          <?php endforeach; ?>
          </tbody>
        </table>
         </div>
      </form> 
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('reportes', 'index')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      
    </article>
 
    </div>
     <br><br><br><br><br><br><br><br>
</div>
</div>
