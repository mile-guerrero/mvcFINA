<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session?>
<?php $id = historialTableClass::ID ?>

<?php $lote = historialTableClass::LOTE_ID ?>
<?php $loteId = loteTableClass::ID ?>
<?php $desLote = loteTableClass::UBICACION ?>

<?php $insumoId = productoInsumoTableClass::ID ?>
<?php $productoIdsid = productoInsumoTableClass::DESCRIPCION ?>
<?php $productoId = historialTableClass::PRODUCTO_INSUMO_ID ?>

<?php $enfermedadIdeid = enfermedadTableClass::ID ?>
<?php $desEnfermedad = enfermedadTableClass::NOMBRE ?>


<div class="container container-fluid" id="cuerpo">
   <div class="center-block" id="cuerpo4">
  <div class="center-block" id="cuerpo2">
  <header id="">
   
  </header>
  <nav id="">
    
  </nav>
  <section id="">
    </section>
    <article id='derecha'>
      <h1><?php echo i18n::__('historial') ?></h1> 
      
    <ul>
      <?php if(session::getInstance()->hasCredential('admin')):?>
      <a class="btn  btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('historial', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
      <?php endif?>
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('historial', 'deleteFilters') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a> 
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>           
    </ul> 
      
<!-- filtros -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('historial', 'index') ?>" method="POST">
              
               <?php if (session::getInstance()->hasFlash('modalFilters') === true): ?>        
                    <script>
                      $('#myModalFiltres').modal({
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
                  <label class="col-sm-2 control-label" for="<?php echo historialTableClass::getNameField(historialTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha crear') ?></label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control-filtro1" id="<?php echo historialTableClass::getNameField(historialTableClass::CREATED_AT, true).'_1' ?>" name="filter[<?php echo historialTableClass::getNameField(historialTableClass::CREATED_AT, true).'_1' ?>]">

                    <input type="date" class="form-control-filtro2" id="<?php echo historialTableClass::getNameField(historialTableClass::CREATED_AT, true).'_2' ?>" name="filter[<?php echo historialTableClass::getNameField(historialTableClass::CREATED_AT, true).'_2' ?>]">
                  </div>
                </div>
                    
              <div class="form-group">
           <label for="filterLote" class="col-sm-2 control-label"><?php echo i18n::__('lote') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterLote" name="filter[<?php echo historialTableClass::getNameField(historialTableClass::LOTE_ID, true)?>]">
                    <option value=""><?php echo i18n::__('selectLote') ?></option>
              <?php foreach ($objHistorialLote as $key): ?>  
              <option value="<?php echo $key->$loteId ?>"> <?php echo $key->$desLote ?></option>
              <?php endforeach; ?>
              </select>
                </div>
              </div>      
              
              <div class="form-group">
                <label for="filterInsumo" class="col-sm-2 control-label"><?php echo i18n::__('insumo') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterInsumo" name="filter[<?php echo historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID, true)?>]">
                    <option value=""><?php echo i18n::__('seleccione insumo') ?></option>
              <?php foreach ($objHistorialProducto as $key): ?>  
              <option value="<?php echo $key->$insumoId ?>"> <?php echo $key->$productoIdsid ?></option>
              <?php endforeach; ?>
              </select>
                </div>
              </div>
            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn-xs"><?php echo i18n::__('filtrar') ?></button>
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
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('historial', 'report')?>">
          
        
            
            
             <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control-filtro1" id="reportFechaIni" name="report[fechaIni]" >
               
<!--                <label  class="col-sm-2 control-label"><?php echo i18n::__('fecha fin') ?></label>-->
              
                  <input type="date" class="form-control-filtro2" id="reportFechaFin" name="report[fechaFin]" >
                </div>
              </div>
              
             
    
    <div class="form-group">
                <label for="reportInsumo" class="col-sm-2 control-label"><?php echo i18n::__('insumo') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="reportInsumo" name="report[insumo]">
                    <option value=""><?php echo i18n::__('seleccione insumo') ?></option>
              <?php foreach ($objHistorialProducto as $key): ?>  
              <option value="<?php echo $key->$insumoId ?>"> <?php echo $key->$productoIdsid ?></option>
              <?php endforeach; ?>
              </select>
                </div>
              </div>
              
              <div class="form-group">
           <label for="reportEnfermedad" class="col-sm-2 control-label"><?php echo i18n::__('enfermedad') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="reportEnfermedad" name="report[enfermedad]">
                    <option value=""><?php echo i18n::__('selectEnfermedad') ?></option>
              <?php foreach ($objHistorialEnfermedad as $key): ?>  
              <option value="<?php echo $key->$enfermedadIdeid ?>"> <?php echo $key->$desEnfermedad ?></option>
              <?php endforeach; ?>
              </select>
                </div>
              </div>
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cerrar') ?></button>
        <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
      </div>
    </div>
  </div>
</div>

     
                <?php view::includeHandlerMessage()?>
<br>
     <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">

        <thead>
          <tr>
            <th>
              <?php echo i18n::__('lote') ?>
            </th>
            <th>
              <?php echo i18n::__('insumo') ?>
            </th>
            <th id="acciones">
              <?php echo i18n::__('acciones') ?>
            </th>

          </tr>
        </thead>
        <tbody>

          <?php foreach ($objHistorial as $key): ?>
            <tr>

             
              <td>
                <?php echo loteTableClass::getNameLote($key->$lote) ?>
              </td>
               <td>
                <?php echo productoInsumoTableClass::getNameProductoInsumo($key->$productoId) ?>              
              </td>
              
              <td>
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('historial', 'ver', array(historialTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
               <?php if(session::getInstance()->hasCredential('admin')):?>
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('historial', 'edit', array(historialTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a>
             <?php endif?>
              </td>                                        
            <?php endforeach; ?>
        </tbody>
      </table>
</div>
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('historial', 'index')?>')">
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

