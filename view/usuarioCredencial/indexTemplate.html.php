<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session?>
<?php $id = usuarioCredencialTableClass::ID ?>
<?php $cred = usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $usuid = usuarioTableClass::ID ?>
<?php $usuariosid = usuarioTableClass::USUARIO ?>
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $credeid = credencialTableClass::ID ?>
<?php $nomcredeid = credencialTableClass::NOMBRE ?>


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
      <h1><?php echo i18n::__('usu cre') ?></h1> 
      
    <ul>
      <?php if(session::getInstance()->hasCredential('admin')):?>
      <a class="btn  btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('registroUsuCreden') ?></a> 
      <?php endif?>
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalFiltres"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'deleteFilters') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a> 
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>           
    </ul> 
      <br>
<!-- filtros -->
    <div class="modal fade" id="myModalFiltres" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>" method="POST">
              
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
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label"  for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('fecha inicio') ?></label>
                       <input type="date" class="form-control-filtro1" id="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true).'_1' ?>" name="filter[<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true).'_1' ?>]">

                    </div>
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label" for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true) . '_2' ?>" ><?php echo i18n::__('fecha fin') ?></label>
                            <input type="date" class="form-control-filtro2" id="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true).'_2' ?>" name="filter[<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREATED_AT, true).'_2' ?>]">
                 
                    </div>
                  </div>
          
         
              
              <div class="form-group">
                <label for="filterUsuario" class="col-sm-2 control-label"><?php echo i18n::__('user') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterUsuario" name="filter[<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>]">
                    <option value=""><?php echo i18n::__('fUsuario') ?></option>
              <?php foreach ($objUCU as $key): ?>  
              <option value="<?php echo $key->$usuid ?>"> <?php echo $key->$usuariosid ?></option>
              <?php endforeach; ?>
              </select>
                </div>
              </div>
              
              <div class="form-group">
           <label for="filterCredencial" class="col-sm-2 control-label"><?php echo i18n::__('credencial') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterCredencial" name="filter[<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>]">
                    <option value=""><?php echo i18n::__('fCredencial') ?></option>
              <?php foreach ($objUCC as $key): ?>  
              <option value="<?php echo $key->$credeid ?>"> <?php echo $key->$nomcredeid ?></option>
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
        <form target="_blank" class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'report')?>">
          
        
            
            
             <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control-filtro1" id="reportFechaIni" name="report[fechaIni]" >
               
<!--                <label  class="col-sm-2 control-label"><?php echo i18n::__('fecha fin') ?></label>-->
              
                  <input type="date" class="form-control-filtro2" id="reportFechaFin" name="report[fechaFin]" >
                </div>
              </div>
              
              <div class="form-group">  
    <label for="reportUsuario" class="col-sm-2 control-label"><?php echo i18n::__('user') ?></label>
    
    <div class="col-sm-10">
      
      <select class="form-control" id="reportUsuario" name="report[usuario]">
            <option value=""><?php echo i18n::__('fUsuario') ?></option>
              <?php foreach ($objUCU as $key): ?>  
              <option value="<?php echo $key->$usuid ?>"> <?php echo $key->$usuariosid ?></option>
              <?php endforeach; ?>
              </select>
                </div>
              </div>
           <div class="form-group">
    <label for="reportCredencial" class="col-sm-2 control-label"><?php echo i18n::__('credencial') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="reportCredencial" name="report[credencial]">
            <option value=""><?php echo i18n::__('fCredencial') ?></option>
              <?php foreach ($objUCC as $key): ?>  
              <option value="<?php echo $key->$credeid ?>"> <?php echo $key->$nomcredeid ?></option>
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

     
                <?php view::includeHandlerMessage()?>
      <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">

        <thead>
          <tr>
            <th>
              <?php echo i18n::__('user') ?>
            </th>
            <th>
              <?php echo i18n::__('credencial') ?>
            </th>
            <th id="acciones">
              <?php echo i18n::__('acciones') ?>
            </th>

          </tr>
        </thead>
        <tbody>

          <?php foreach ($objUC as $key): ?>
            <tr>

              <td>
                <?php echo usuarioTableClass::getNameUsuario($key->$usuario) ?>
              
              </td>
              <td>
                <?php echo credencialTableClass::getNameCredencial($key->$cred) ?>
              </td>
              <td>
                <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'ver', array(usuarioCredencialTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
               <?php if(session::getInstance()->hasCredential('admin')):?>
                <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'edit', array(usuarioCredencialTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a>
             <?php endif?>
              </td>                                        
            <?php endforeach; ?>
        </tbody>
      </table>
        </div>
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index')?>')">
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
