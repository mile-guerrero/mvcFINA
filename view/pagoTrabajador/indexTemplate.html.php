<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\session\sessionClass as session?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $idEmpresa = pagoTrabajadorTableClass::EMPRESA_ID ?>
<?php $fechaIni = pagoTrabajadorTableClass::FECHA_INICIAL ?>
<?php $fechaFin = pagoTrabajadorTableClass::FECHA_FINAL ?>
<?php $idTrabajador = pagoTrabajadorTableClass::TRABAJADOR_ID ?>
<?php $valor = pagoTrabajadorTableClass::VALOR_SALARIO ?>
<?php $cantidad = pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS?>
<?php $valorHoras = pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS ?>
<?php $horas = pagoTrabajadorTableClass::HORAS_PERDIDAS?>
<?php $total = pagoTrabajadorTableClass::TOTAL_PAGAR ?>
<?php $idEmp = empresaTableClass::ID ?>
<?php $nomEmpresa = empresaTableClass::NOMBRE ?>
<?php $id = pagoTrabajadorTableClass::ID ?>

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

    <h1><?php echo i18n::__('pagoTrabajador') ?></h1> 
    <ul>      
      <?php if(session::getInstance()->hasCredential('admin')):?>
      <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
    <?php endif?> 
      
      <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'deleteFilters') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>             
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>
    </ul> 

    <!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'report')?>">

                    
 <div class="form-group">
    <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
    <div class="col-sm-10">
      <input type="date" class="form-control-filtro1" id="reportFecha1" name="report[fecha1]">
      
       <input type="date" class="form-control-filtro2" id="reportFecha2" name="report[fecha2]">
    </div>
  </div>
          
           <div class="form-group">
                <label for="filterEmpresa" class="col-sm-2 control-label"><?php echo i18n::__('empresa') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterEmpresa" name="filter[empresa]">
                    <option value=""><?php echo i18n::__('selectEmpresa') ?></option>
<?php foreach ($objEmpresa as $empresa): ?>
                      <option value="<?php echo $empresa->$idEmp ?>"><?php echo $empresa->$nomEmpresa ?></option>
<?php endforeach; ?>
                  </select>
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
    

    <!-- Modal -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index') ?>" method="POST">
              
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
                  <label class="col-sm-2 control-label" for="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha crear') ?></label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control-filtro1" id="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true).'_1' ?>" name="filter[<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true).'_1' ?>]">

                    <input type="date" class="form-control-filtro2" id="<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true).'_2' ?>" name="filter[<?php echo pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CREATED_AT, true).'_2' ?>]">
                  </div>
                </div>
                    
              <div class="form-group">
                <label for="filterEmpresa" class="col-sm-2 control-label"><?php echo i18n::__('empresa') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterEmpresa" name="filter[empresa]">
                    <option value=""><?php echo i18n::__('selectEmpresa') ?></option>
<?php foreach ($objEmpresa as $empresa): ?>
                      <option value="<?php echo $empresa->$idEmp ?>"><?php echo $empresa->$nomEmpresa ?></option>
<?php endforeach; ?>
                  </select>
                </div>
              </div>

              
              

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn btn-xs"><?php echo i18n::__('filtros') ?></button>
          </div>
        </div>
      </div>
    </div>             


    <form class="form-signin">        
<?php view::includeHandlerMessage() ?> 
        <br>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
        <thead>
          <tr>
            <th>
              <?php echo i18n::__('empresa') ?>
            </th>
            <th id="acciones">
          <?php echo i18n::__('acciones') ?>
            </th> 
          </tr>
        </thead>
        <tbody>
            <?php foreach ($objPT as $key): ?>
            <tr>
                <td>
                  <?php echo empresaTableClass::getNameEmpresa($key->$idEmpresa) ?>
                 </td>
              <td>
               
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'ver', array(pagoTrabajadorTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                 <?php if(session::getInstance()->hasCredential('admin')):?>
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'edit', array(pagoTrabajadorTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
               <?php endif?> 
              </td>
            </tr>
<?php endforeach; ?>
        </tbody>
      </table>
        </div>
    </form> 
    <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('pagoTrabajador', 'index')?>')">
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
