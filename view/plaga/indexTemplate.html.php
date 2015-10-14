<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $nombre = plagaTableClass::NOMBRE ?>
<?php $descripcion = plagaTableClass::DESCRIPCION ?>
<?php $tratamiento = plagaTableClass::TRATAMIENTO ?>
<?php $id = plagaTableClass::ID ?>

<div class="container container-fluid" id="cuerpo">
  <div class="center-block" id="cuerpo4">
  <div class="center-block" id="cuerpo2">
  <header id="">
   
  </header>
  <nav id="barramenu">
    
  </nav>
  <section id="">
    
  </section>
    <article id='derecha'>
       <h1><?php echo i18n::__('plaga') ?></h1>
      <ul>
     <?php if (session::getInstance()->hasCredential('admin')):?>
        <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('plaga', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('registroPlaga') ?></a> 
        <?php endif?>
        <a type="button" class="btn  btn btn-xs" data-toggle="modal" data-target="#myModalFilters"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('plaga', 'deleteFilters') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
        <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>          
    </ul>
       
       
       
       
       <!--Filtros-->
      <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="filterForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('plaga', 'index')?>">
       
           <?php if (session::getInstance()->hasFlash('modalFilters') === true): ?>        
                    <script>
                      $('#myModalFilters').modal({
                        backdrop: 'static', //dejar avierta la ventana modal
                        keyboard: false//true para quitarla con escape 
                      })
                    </script>
                  <?php endif; ?>
                    
                    <?php if (session::getInstance()->hasError('inputFecha')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFecha') ?>
                    </div>
                  <?php endif ?>
                    
                        <div class="form-group">
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label"  for="<?php echo plagaTableClass::getNameField(plagaTableClass::CREATED_AT, true) . '_1' ?>"  ><?php echo i18n::__('fecha inicio') ?></label>
                        <input type="date" class="form-control-filtro1" id="<?php echo plagaTableClass::getNameField(plagaTableClass::CREATED_AT, true).'_1' ?>" name="filter[<?php echo plagaTableClass::getNameField(plagaTableClass::CREATED_AT, true).'_1' ?>]">

                    </div>
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label" for="<?php echo plagaTableClass::getNameField(plagaTableClass::CREATED_AT, true) . '_2' ?>" ><?php echo i18n::__('fecha fin') ?></label>
                            <input type="date" class="form-control-filtro2" id="<?php echo plagaTableClass::getNameField(plagaTableClass::CREATED_AT, true).'_2' ?>" name="filter[<?php echo plagaTableClass::getNameField(plagaTableClass::CREATED_AT, true).'_2' ?>]">
                  
                    </div>
                  </div>

               
                
                    <?php if (session::getInstance()->hasError('inputNombre')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                      <button type="button" class="close" data-dismiss="alert" id="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?>
                    </div>
                  <?php endif ?>
          <div class="form-group">
    <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterNombre" name="filter[<?php echo plagaTableClass::getNameField(plagaTableClass::NOMBRE, true) ?>]" placeholder="buscar por nombre">
    </div>
  </div>
 
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cancel') ?></button>
        <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn btn-xs"><?php echo i18n::__('filtros') ?></button>
      </div>
    </div>
  </div>
</div>
       
       

<!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
      </div>
      <div class="modal-body">
        <form target="_blank" class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('plaga', 'report')?>">
          
         
    
          <div class="form-group">
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label"><?php echo i18n::__('fecha inicio') ?></label>
                       <input type="date" class="form-control-filtro1" id="reportFecha1" name="report[fecha1]">  

                    </div>
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label"><?php echo i18n::__('fecha fin') ?></label>
                         <input type="date" class="form-control-filtro1" id="reportFecha2" name="report[fecha2]">
                 
                    </div>
                  </div>
          
              
          

          <div class="form-group">
    <label for="reportNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportNombre" name="report[nombre]" placeholder="buscar por nombre">
    </div>
  </div>
          
     
         
  <div class="form-group">
    <label for="reportDescripcion" class="col-sm-2 control-label"><?php echo i18n::__('des') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportDescripcion" name="report[descripcion]" placeholder="buscar por descripcion">
    </div>
  </div>
          
          <div class="form-group">
    <label for="reportTratamiento" class="col-sm-2 control-label"><?php echo i18n::__('tratamiento') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportTratamiento" name="report[tratamiento]" placeholder="buscar por tratamiento">
    </div>
  </div>
         
        </form>
      </div>
       
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cerrar') ?></button>
        <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
      </div>          
    </div>
  </div>
</div>
        
       
       
       
       
       
        
    
      
      <form class="form-signin">        
        <?php view::includeHandlerMessage()?>       
          <br>
        <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
          <tr>
          <thead>
          <th>
            <?php echo i18n::__('nom') ?>
          </th>
                    
          <th id="acciones">
            <?php echo i18n::__('acciones') ?>
          </th>
          </tr>
          </thead>
          <tbody>
<?php foreach ($objPlaga as $key): ?>
              <tr>
                <td>
                  <?php echo $key->$nombre ?>
                </td>
                
                
                <td>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('plaga', 'ver', array(plagaTableClass::ID => $key->$id)) ?>" > <?php echo i18n::__('ver') ?></a>
                  <?php if (session::getInstance()->hasCredential('admin')):?>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('plaga', 'edit', array(plagaTableClass::ID => $key->$id)) ?>"> <?php echo i18n::__('modificar') ?> </a>
                <?php endif?>
                </td>
       </tr>      
<?php endforeach; ?>
          </tbody>
        </table>
          </div>
      </form> 
      
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('plaga', 'index')?>')">
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