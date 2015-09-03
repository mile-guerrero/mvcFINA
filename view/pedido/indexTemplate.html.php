<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session?>
<?php $idEmpresa = pedidoTableClass::EMPRESA_ID ?>
<?php $idEmp = empresaTableClass::ID ?>
<?php $nomEmpresa = empresaTableClass::NOMBRE ?>
<?php $idProveedor = pedidoTableClass::ID_PROVEEDOR ?>
<?php $idPro = proveedorTableClass::ID ?>
<?php $nomProveedor = proveedorTableClass::NOMBREP ?>
<?php $id = pedidoTableClass::ID ?>
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
      
      <h1><?php echo i18n::__('pedido') ?></h1> 
      <ul>
     
        <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('registroPedido') ?></a> 
        <?php if (session::getInstance()->hasCredential('admin')):?>
        <a href="javascript:eliminarMasivo()" class="btn  btn btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a> 
        <?php endif?>
        <a type="button" class="btn  btn btn-xs" data-toggle="modal" data-target="#myModalFilters"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'deleteFilters') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
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
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('pedido', 'report')?>">

           <div class="form-group">
                <label for="reportEmpresa" class="col-sm-2 control-label"><?php echo i18n::__('empresa') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="reportEmpresa" name="report[empresa]">
                    <option value=""><?php echo i18n::__('selectEmpresa') ?></option>
<?php foreach ($objEmpresa as $empresa): ?>
                      <option value="<?php echo $empresa->$idEmp ?>"><?php echo $empresa->$nomEmpresa ?></option>
<?php endforeach; ?>
                  </select>
                </div>
              </div>
            
            <div class="form-group">
    <label for="reportProveedor" class="col-sm-2 control-label"><?php echo i18n::__('nomProveedor') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="reportProveedor" name="report[proveedor]">
          <option value=""><?php echo i18n::__('selectProveedor') ?></option>
<?php foreach ($objProveedor as $proveedor): ?>
            <option value="<?php echo $proveedor->$idPro ?>"><?php echo $proveedor->$nomProveedor ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>
            
  <div class="form-group">
    <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
    <div class="col-sm-10">
      <input type="date" class="form-control-filtro1" id="reportFecha1" name="report[fecha1]">
      
       <input type="date" class="form-control-filtro2" id="reportFecha2" name="report[fecha2]">
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
    <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="filterForm" role="form" action="<?php echo routing::getInstance()->getUrlWeb('pedido', 'index') ?>" method="POST">
               
              
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
                      <label class="col-sm-4 control-label"  for="<?php echo pedidoTableClass::getNameField(pedidoTableClass::CREATED_AT, true) . '_1' ?>"  ><?php echo i18n::__('fecha inicio') ?></label>
                        <input type="date" class="form-control-filtro1" id="<?php echo pedidoTableClass::getNameField(pedidoTableClass::CREATED_AT, true).'_1' ?>" name="filter[<?php echo pedidoTableClass::getNameField(pedidoTableClass::CREATED_AT, true).'_1' ?>]">

                    </div>
                    <div class="col-sm-6">
                      <label class="col-sm-4 control-label" for="<?php echo pedidoTableClass::getNameField(pedidoTableClass::CREATED_AT, true) . '_2' ?>" ><?php echo i18n::__('fecha fin') ?></label>
                            <input type="date" class="form-control-filtro2" id="<?php echo pedidoTableClass::getNameField(pedidoTableClass::CREATED_AT, true).'_2' ?>" name="filter[<?php echo pedidoTableClass::getNameField(pedidoTableClass::CREATED_AT, true).'_2' ?>]">
                  
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
               <div class="form-group">
    <label for="filterProveedor" class="col-sm-2 control-label"><?php echo i18n::__('nomProveedor') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterProveedor" name="filter[proveedor]">
          <option value=""><?php echo i18n::__('selectProveedor') ?></option>
<?php foreach ($objProveedor as $proveedor): ?>
            <option value="<?php echo $proveedor->$idPro ?>"><?php echo $proveedor->$nomProveedor ?></option>
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
    
      
     <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('pedido', 'deleteSelect') ?>" method="POST">        
        <?php view::includeHandlerMessage()?> 
         <br>
    <div class="rwd">
      <table class="table table-bordered table-responsive rwd_auto">
          <thead>
            <tr>
          <th>
            <input type="checkbox" id="chkAll">
          </th>
               <th>
            <?php echo i18n::__('empresa') ?>
          </th> 
           <th>
            <?php echo i18n::__('nomProveedor') ?>
          </th>  
          <th>
<?php echo i18n::__('acciones') ?>
          </th> 
          </tr>
          </thead>
          <tbody>
<?php foreach ($objPedido as $key): ?>
              <tr>
                <td>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </td>
                 <td>
            <?php echo empresaTableClass::getNameEmpresa($key->$idEmpresa) ?>
          </td>
           <td>     
            <?php echo proveedorTableClass::getNameProveedor($key->$idProveedor) ?>
           </td>
                <td>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'ver', array(pedidoTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'edit', array(pedidoTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                  <?php if (session::getInstance()->hasCredential('admin')):?>
                  <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
                <?php endif?> 
                </td>
 </tr>
  <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmar eliminar') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('Desea  eliminar este campo') ?><?php echo i18n::__('?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>,'<?php echo pedidoTableClass::getNameField(pedidoTableClass::ID, true) ?>','<?php echo routing::getInstance()->getUrlWeb('pedido', 'delete') ?>')"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div> 
<?php endforeach; ?>
          </tbody>
        </table>
      </div>
      </form> 
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('pedido', 'index')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('pedido', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo pedidoTableClass::getNameField(pedidoTableClass::ID, true) ?>">
      </form>
    </article>
    </div>
    <br><br><br><br><br><br><br><br>
  </div>
</div>
<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('configEliMas') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('eliminarMas') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>



