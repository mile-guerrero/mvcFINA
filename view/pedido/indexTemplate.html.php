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
  <header id="">
   
  </header>
  <nav id="">
   
  </nav>
  <section id="">
    
      </section>
    <article id='derecha'>
      
      <h1><?php echo i18n::__('pedido') ?></h1> 
      <ul>
     <?php if (session::getInstance()->hasCredential('admin')):?>
        <a class="btn btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'insert') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
        <a href="javascript:eliminarMasivo()" class="btn  btn btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a> 
        <?php endif?>
        <a type="button" class="btn  btn btn-xs" data-toggle="modal" data-target="#myModalFilters"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'index') ?>" class="btn  btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a>
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
    <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
    <div class="col-sm-10">
      <input type="date" class="form-control-filtro1" id="reportFecha1" name="report[fecha1]">
      
       <input type="date" class="form-control-filtro2" id="reportFecha2" name="report[fecha2]">
    </div>
  </div>
</form>
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

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo i18n::__('fecha crear') ?></label>
                <div class="col-sm-10">
                  <input type="date" class="form-control-filtro1" id="filterFechaIni" name="filter[fechaIni]" >
                
                  <input type="date" class="form-control-filtro2" id="filterFechaFin" name="filter[fechaFin]" >
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
        <table class="table table-bordered table-responsive">
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
                <th>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </th>
                 <td>
            <?php echo empresaTableClass::getNameEmpresa($key->$idEmpresa) ?>
          </td>
           <td>     
            <?php echo proveedorTableClass::getNameProveedor($key->$idProveedor) ?>
           </td>
                <th>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'ver', array(pedidoTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pedido', 'edit', array(pedidoTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                  <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"> <?php echo i18n::__('eliminar') ?></a>
                </th>
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



