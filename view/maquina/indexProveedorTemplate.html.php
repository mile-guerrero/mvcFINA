<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\session\sessionClass as session?>

<?php $id = proveedorTableClass::ID ?>
<?php $nombre = proveedorTableClass::NOMBREP ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $documento= proveedorTableClass::DOCUMENTO ?>
<?php $direccion= proveedorTableClass::DIRECCION ?>
<?php $idCiudad= ciudadTableClass::ID ?>
<?php $nomCiu= ciudadTableClass::NOMBRE_CIUDAD ?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
    
  </header>
  <nav id="">
               

  </nav>
  <section id="">
     </section>
     <article id='derecha'>
<h1><?php echo i18n::__('nomProveedor') ?></h1>
       <ul>
      <?php if(session::getInstance()->hasCredential('admin')):?>
      <a class="btn  btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'insertProveedor') ?>"><img class="img-responsive"  id="imgnuevo" src="" alt=" "><?php echo i18n::__('nuevo') ?></a> 
      <a href="javascript:eliminarMasivo()" class="btn  btn-xs" id="btnDeleteMasivo"><img class="img-responsive"  id="imgmasivo" src="" alt=" "><?php echo i18n::__('eliminar en masa') ?></a> 
      <?php endif?>
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalFilters"><img class="img-responsive"  id="imgfiltros" src="" alt=" "><?php echo i18n::__('filtros') ?></a>  
      <a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>" class="btn btn-xs" ><img class="img-responsive"  id="imgelifiltro" src="" alt=" "><?php echo i18n::__('eFiltros') ?></a> 
      <a type="button" class="btn  btn-xs" data-toggle="modal" data-target="#myModalReport" ><img class="img-responsive"  id="imgreporte" src="" alt=" "><?php echo i18n::__('informe') ?></a>           
   </ul> 


  <!-- filtros -->
     <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="filterForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor')?>">
          
          <div class="form-group">
    <label class="col-sm-2 control-label">Fecha Creacion</label>
    <div class="col-sm-10">
      <input type="date" class="form-control-filtro1" id="filterFecha1" name="filter[fecha1]">
      
       <input type="date" class="form-control-filtro2" id="filterFecha2" name="filter[fecha2]">
    </div>
  </div>
          
          
          <div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('idCiudad') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[ciudad]">
        <option value=""><?php echo i18n::__('selectCiudad') ?></option>
<?php foreach ($objCC as $ciudad): ?>
            <option value="<?php echo $ciudad->$idCiudad ?>"><?php echo $ciudad->$nomCiu ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>
          
          
          <div class="form-group">
    <label for="filterDocumento" class="col-sm-2 control-label"><?php echo i18n::__('documento') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterDocumento" name="filter[documento]" placeholder="buscar por documento">
    </div>
  </div>
          
        
          <div class="form-group">
    <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="buscar por nombre">
    </div>
  </div>
          
          
          <div class="form-group">
    <label for="filterApellido" class="col-sm-2 control-label"><?php echo i18n::__('apell') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterApellido" name="filter[apellido]" placeholder="buscar por apellido">
    </div>
  </div>
          
  
</form>
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
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'reportProveedor')?>">
          <div class="form-group">
    <label for="reportNombre" class="col-sm-2 control-label"><?php echo i18n::__('nom') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportNombre" name="report[nombre]" placeholder="Nombre">
    </div>
  </div>
           <div class="form-group">
    <label for="reportCiudad" class="col-sm-2 control-label"><?php echo i18n::__('idCiudad') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="reportCiudad" name="report[ciudad]">
        <option value=""><?php echo i18n::__('selectCiudad') ?></option>
<?php foreach ($objCC as $ciudad): ?>
            <option value="<?php echo $ciudad->$idCiudad ?>"><?php echo $ciudad->$nomCiu ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Fecha Creacion</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="reportFecha1" name="report[fecha1]">
      <br>
       <input type="date" class="form-control" id="reportFecha2" name="report[fecha2]">
    </div>
  </div>
</form>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn btn-xs" data-dismiss="modal">  <?php echo i18n::__('cancel') ?></button>
        <button type="button" onclick="$('#reportForm').submit()" class="btn btn-warning btn btn-xs"><?php echo i18n::__('informe') ?></button>
      </div>
    </div>
  </div>
</div>

  
      <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteSelectProveedor') ?>" method="POST">        
        <?php view::includeHandlerMessage()?>
          <br>
        <table class="table table-bordered table-responsive">
          <tr>
          <thead>
          <th id="cuadrito">
            <input type="checkbox" id="chkAll">
          </th>
          <th>
            <?php echo i18n::__('nom') ?>
          </th>
          <th>
            <?php echo i18n::__('apell') ?>
          </th>
          <th>
            <?php echo i18n::__('documento') ?>
          </th>
          <th id="acciones">
            <?php echo i18n::__('acciones') ?>
          </th>

          </tr>
          </thead>
          <tbody>
            <?php foreach ($objProveedor as $key): ?>
              <tr>

                <th>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </th>
                <td>
                  <?php echo $key->$nombre ?>
                </td>
                <td>
                  <?php echo $key->$apellido ?>
                </td>
                <td>
                  <?php echo $key->$documento ?>
                </td>

                <th>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'verProveedor', array(proveedorTableClass::ID => $key->$id)) ?>" ><?php echo i18n::__('ver') ?></a> 
                  <?php if(session::getInstance()->hasCredential('admin')):?>
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'editProveedor', array(proveedorTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?> </a> 
                  <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"><?php echo i18n::__('eliminar') ?></a>
                <?php endif?>
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
                    <?php echo i18n::__('Desea  eliminar este campo') ?> <?php echo $key->$nombre ?><?php echo i18n::__('?') ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                    <button type="button" class="btn btn-danger btn-xs" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteProveedor') ?>')"><?php echo i18n::__('eliminar') ?></button>
                  </div>
                </div>
              </div>
            </div>   
          <?php endforeach; ?>
          </tbody>
        </table>
      </form> 
      
      <div class="text-right">
        <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select> <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteProveedor') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true) ?>">
      </form>

    </article>
 
</div>


<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('eliminar en masa') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('eliminar en masa') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>