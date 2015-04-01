<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $nom = trabajadorTableClass::NOMBRET ?>
<?php $apellido = trabajadorTableClass::APELLIDO ?>
<?php $direccion = trabajadorTableClass::DIRECCION ?>
<?php $telefono = trabajadorTableClass::TELEFONO ?>
<?php $id = trabajadorTableClass::ID ?>
<?php $idCiudad = ciudadTableClass::ID?>
<?php $nomCiu = ciudadTableClass::NOMBRE_CIUDAD?>
<div class="container container-fluid" id="cuerpo">
  <article id="derecha">
  <header id="">
    <h1><?php echo i18n::__('trabajador') ?></h1>
  </header>
  <nav id="">
    <ul>
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'insert') ?>"><?php echo i18n::__('nuevo') ?></a>
      <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" id="btnDeleteMasivo"><?php echo i18n::__('eliminar en masa') ?></a>             
      <button type="button" class="btn btn-primary btn btn-xs" data-toggle="modal" data-target="#myModalFilters"><?php echo i18n::__('filtros') ?></button>
      <a href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>" class="btn btn-default active btn btn-xs"><?php echo i18n::__('eFiltros') ?></a>
      <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('informe') ?></button>
      
      <!---Informes--->
       <div class="modal fade" id="myModalReport" tabindex="-1" role="modal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('informe') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="reportForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'reportTrabajador')?>">
          <div class="form-group">
    <label for="reportNombre" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="reportNombre" name="report[nombre]" placeholder="Nombre">
    </div>
  </div>
           <div class="form-group">
    <label for="reportCiudad" class="col-sm-2 control-label"><?php echo i18n::__('idCiudad') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="reportCiudad" name="report[ciudad]">
            <option><?php echo i18n::__('selectCiudad') ?></option>
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
      
      <!--Filtros-->
      <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filtros') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="filterForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>">
          <div class="form-group">
    <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="Nombre">
    </div>
  </div>
           <div class="form-group">
    <label for="filterCiudad" class="col-sm-2 control-label"><?php echo i18n::__('idCiudad') ?></label>
    <div class="col-sm-10">
      <select class="form-control" id="filterCiudad" name="filter[ciudad]">
            <option><?php echo i18n::__('selectCiudad') ?></option>
<?php foreach ($objCC as $ciudad): ?>
            <option value="<?php echo $ciudad->$idCiudad ?>"><?php echo $ciudad->$nomCiu ?></option>
<?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Fecha Creacion</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="filterFecha1" name="filter[fecha1]">
      <br>
       <input type="date" class="form-control" id="filterFecha2" name="filter[fecha2]">
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
    </ul> 
  </nav>
  <section id="">
      <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'deleteSelect') ?>" method="POST">        
        <?php view::includeHandlerMessage()?>
        <br>
        <table class="table table-bordered table-responsive">
          <tr>
          <thead>
          <th>
            <input type="checkbox" id="chkAll">
          </th>
          <th>
            <?php echo i18n::__('nom') ?>
          </th>
          <th>
            <?php echo i18n::__('apell') ?>
          </th>
          <th>
            <?php echo i18n::__('dir') ?>
          </th>
          <th>
            <?php echo i18n::__('tel') ?>
          </th>
          <th>
<?php echo i18n::__('acciones') ?>
          </th>
          </tr>
          </thead>
          <tbody>
<?php foreach ($objTrabajador as $key): ?>
              <tr>
                <td>
                  <input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>">
                </td>
                <td>
                  <?php echo $key->$nom ?>
                </td>
                <td>
  <?php echo $key->$apellido ?>
                </td>
                <td>
  <?php echo $key->$direccion ?>
                </td>
                <td>
  <?php echo $key->$telefono ?>
                </td>
                <td>
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'ver', array(trabajadorTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('ver') ?></a> 
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'edit', array(trabajadorTableClass::ID => $key->$id)) ?>"><?php echo i18n::__('modificar') ?></a>
                  <a href="#" data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"><?php echo i18n::__('eliminar') ?></a>
                </td>
              </tr>
<div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('configEliminar') ?></h4>
      </div>
      <div class="modal-body">
         <?php echo i18n::__('eliminarReg') ?> <?php echo $key->$nom ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar( <?php echo $key->$id ?>,'<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, true)?>','<?php echo routing::getInstance()->getUrlWeb('trabajador', 'delete')?>')"> <?php echo i18n::__('eliminar') ?></button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
          </tbody>
        </table>
      </form> 
      <div class="text-right">
       <?php echo i18n::__('paginas') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select>  <?php echo i18n::__('de') ?> 10
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, true) ?>">
      </form>
</section>
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