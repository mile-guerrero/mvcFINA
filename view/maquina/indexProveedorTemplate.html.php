<?php mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $nom = proveedorTableClass::NOMBREP ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
<?php $id = proveedorTableClass::ID ?>
<?php $idCiudad = ciudadTableClass::ID?>
<?php $nomCiu = ciudadTableClass::NOMBRE_CIUDAD?>
<div class="container container-fluid" id="cuerpo">
  <header id="">
    
  </header>
  <nav id="">
    
  </nav>
  <section id="">
    </section>
    <article id="derecha">
      
      <h1><?php echo i18n::__('nomProveedor') ?></h1>
      
      <ul>
      <a class="btn btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'insertProveedor') ?>"><i class="glyphicon glyphicon-plus-sign"><?php echo i18n::__('new') ?></i></a>
      <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" id="btnDeleteMasivo"><?php echo i18n::__('removeSelection') ?></a>             
      <button type="button" class="btn btn-primary btn btn-xs" data-toggle="modal" data-target="#myModalFilters"><?php echo i18n::__('filters') ?></button>
      <a href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor') ?>" class="btn btn-default btn btn-xs"><?php echo i18n::__('removeFilters') ?></a>
      <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filters') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="filterForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor')?>">
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
        <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary btn btn-xs"><?php echo i18n::__('filters') ?></button>
      </div>
    </div>
  </div>
</div>
    </ul> 
      <form class="form-signin" id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteSelectProveedor') ?>" method="POST">        
        <?php view::includeHandlerMessage()?>
        <br>
        <table class="table table-bordered table-responsive">
          <tr>
          <thead>
          <th>
            <input type="checkbox" id="chkAll">
          </th>
          <th>
            <?php echo i18n::__('name') ?>
          </th>
          <th>
            <?php echo i18n::__('lastName') ?>
          </th>
          <th>
            <?php echo i18n::__('streetAddress') ?>
          </th>
          <th>
            <?php echo i18n::__('phone') ?>
          </th>
          <th>
<?php echo i18n::__('actions') ?>
          </th>
          </tr>
          </thead>
          <tbody>
<?php foreach ($objProveedor as $key): ?>
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
                  <a class="btn btn-warning btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'verProveedor', array(proveedorTableClass::ID => $key->$id)) ?>"><i class="glyphicon glyphicon-eye-open"><?php echo i18n::__('see') ?></i></a> 
                  <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('maquina', 'editProveedor', array(proveedorTableClass::ID => $key->$id)) ?>"><i class="glyphicon glyphicon-edit"><?php echo i18n::__('modify') ?></i></a>
                  <a href="#" data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"><?php echo i18n::__('takeOut') ?></i></a>
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
        <button type="button" class="btn btn-danger btn-xs" onclick="eliminar( <?php echo $key->$id ?>,'<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true)?>','<?php echo routing::getInstance()->getUrlWeb('maquina', 'deleteProveedor')?>')"> <?php echo i18n::__('takeOut') ?></button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
          </tbody>
        </table>
      </form> 
      <div class="text-right">
       <?php echo i18n::__('page') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('maquina', 'indexProveedor')?>')">
         <?php for($x = 1; $x <= $cntPages; $x++):?>
           <option <?php echo (isset($page) and $page == $x) ? 'selected': '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php endfor;?>
        </select>  <?php echo i18n::__('de') ?> <?php echo $cntPages ?>
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
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('configEliMas') ?></h4>
      </div>
      <div class="modal-body">
        <?php echo i18n::__('eliminarMas') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
        <button type="button" class="btn btn-danger btn-xs" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('takeOut') ?></button>
      </div>
    </div>
  </div>
</div>